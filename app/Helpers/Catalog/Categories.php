<?php

namespace App\Helpers\Catalog;

use App\Models\Catalog\Category as CatalogCategories;
use App\Models\Ideas\Ideas;
use App\Models\Meta;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class Categories {

    private static function tree($category, $left = 0, $right = null) {
        \App\Helpers\Arr::setKeys($category);
        //dd($category);
        $tree = array();
        foreach ($category as $cat => $range) {
            if ($range['_lft'] == $left + 1 && (is_null($right) || $range['_rgt'] < $right)) {
                $tree[$cat] = self::tree($category, $range['_lft'], $range['_rgt']);
                $left = $range['_rgt'];
            }
        }
        return $tree;
    }
    public static function refresh() {
        self::buildTree();
    }

    public static function all() {
        if (!\Cache::has('categoriesMenu')) {
           
          return  self::buildTree();
      }
      
        return \Cache::get('categoriesMenu');
    }
    
    
    public static function mainMenu() {
           if (!\Cache::has('categoriesMainMenu')) {
           
          return  self::buildMainTree();
      }
      
        return \Cache::get('categoriesMainMenu');
        
    }

    public static function ruAlias($id) {
        
        $ru = self::buildLangTree();
        $ruCat = CatalogCategories::where('data_id',$id)->whereLang(1)->first();
        $ruAlias = $ru[data_get($ruCat,'id')] ?? '/error';
        return $ruAlias;
    }
    
    public static function uaAlias($id) {
        
        $ua = self::buildLangTree(2);
        $uaCat= CatalogCategories::where('data_id',$id)->whereLang(2)->first();
        $uaAlias = $ua[data_get($uaCat,'id')] ?? '/error';
        return $uaAlias;
    }

     public static function ruProdAlias($id,$alias) {
        
        $ru = self::buildLangTree();
        $ruCat = CatalogCategories::where('id',$id)->whereLang(1)->first();
        $ruAlias = $ru[data_get($ruCat,'id')].'/'.$alias.'.html' ?? '/error';
        return $ruAlias;
    }
    
    public static function uaProdAlias($id,$alias) {
       
        $ua = self::buildLangTree(2);
        $uaCat= CatalogCategories::where('id',$id)->whereLang(2)->first();
        $uaAlias = $ua[data_get($uaCat,'id')].'/'.$alias.'.html' ?? '/error';
      
        return $uaAlias;
    }
    
    
    
    public static function langCategories ($lang) {
        
        return self::buildLangTree($lang);
    }

        private static function buildLangTree($lang=1) {
        $paths = [];
        $tree = CatalogCategories::defaultOrder()->with(['meta'=>function($q) use($lang) {
           
            $q->whereLang($lang);
        }])->whereLang($lang)->where('published',1)->get()->toFlatTree();

        $urls = [];
        
        foreach ($tree as $v) {
            $urls = CatalogCategories::defaultOrder()->with(['meta'=>function($q) use($lang) {
            $q->whereLang($lang);
        }])->whereLang($lang)->whereAncestorOf($v['id'])->get()->toArray();
            
            $paths[$v['id']] = [];
            foreach ($urls as $url) {

                $paths[$v['id']][] = $url['meta']['alias'];
            }
            array_push($paths[$v->id], $v->meta->alias);
            $paths[$v->id] = '/' . implode('/', $paths[$v['id']]);
        }
      
          return $paths;
    }
    
    
    
    private static function buildTree() {
        $paths = [];
        $tree = CatalogCategories::defaultOrder()->with('meta')->where('published',1)->get()->toFlatTree();
        $urls = [];
        
        foreach ($tree as $v) {
            $urls = CatalogCategories::defaultOrder()->with('meta')->whereAncestorOf($v['id'])->get()->toArray();
            $paths[$v['id']] = [];
            foreach ($urls as $url) {

                $paths[$v['id']][] = $url['meta']['alias'];
            }
            array_push($paths[$v->id], $v->meta->alias);
            $paths[$v->id] = '/' . implode('/', $paths[$v['id']]);
        }

        \Cache::forever('categoriesMenu', ['tree' => $tree->toTree(), 'urls' => $paths]);
        return \Cache::get('categoriesMenu');
    }

    public static function buildUrl($category) {
        if (!$category) {
            return [];
        }
   
        //dd($category, $category['data_id']);
        $tree = CatalogCategories::defaultOrder()->whereLang(loc())->with(['meta'=>function($q) { return $q->whereLang(loc()); }])->whereAncestorOf($category['data_id'] ?? $category['id'])->get()->toArray();
        $url = [];
        //dd($tree);
        foreach ($tree as $v) {
            $url[] = $v['meta']['alias'] ?? $v['id'];
        }
        if (!in_array($category['alias'] ?? $category['meta']['alias'], $url)) {
            $url[] = $category['alias'] ?? $category['meta']['alias'];
        }
        //dump($tree);

        $url = array_unique($url);

        $url = implode('/', $url);

        return '/' . $url;
    }

    public static function getCurrent() {
        $suffix = \App\Helpers\Catalog\Products::getSuffix();
        $uri = parse_url(request()->server->get('REQUEST_URI'), PHP_URL_PATH);
        $uriParts = explode('/', $uri);
        if (substr($uri, -mb_strlen($suffix)) === $suffix) {
            array_pop($uriParts);
        }
        $currentCategory = array_pop($uriParts);
        $category = Meta::where('type', CatalogCategories::META_TYPE)
                        ->where('alias', $currentCategory)->where('module', CatalogCategories::MODULE_NAME)->first();
        return $category;
    }

    public static function breadcrumbs($id) {
        $paths = [];
        $urls = [];
        $urls = CatalogCategories::defaultOrder()->with('meta')->whereAncestorOf($id)->get()->pluck('id');
        //dd($id);
        $urls[] = $id;
        return $urls;
        $data = (new CatalogCategories)->getCategories($urls);
        //dd($data);
        $crumbs = [];
        foreach ($data as $v) {
            $v['data_id'] = $v['id'];
            $crumbs[] = [
                'title' => $v['title'],
                'href' => self::buildUrl($v)
            ];
        }
        return $crumbs;
    }

    public static function getParents() {
      return $all = CatalogCategories::defaultOrder()->where('parent_id',null)->with('meta','main_image')->get();
                
    }
    
    
    
    
    
    
    

}
