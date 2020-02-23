<?php

namespace App\Helpers;

use App\Models\Catalog\Category as CatalogCategories;
use App\Models\Meta;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class Tree {

    public static function all($model, $relations = []) {

        if (is_object($model)) {
            $class = get_class($model);
        } else {
            $class = $model;
        }
        $paths = [];
        $tree = $class::defaultOrder()->with('meta')->get()->toFlatTree();

        $urls = [];
        foreach ($tree as $v) {
     
          $urls = $class::defaultOrder()->with('meta')->whereAncestorOf($v['id'])->get()->toArray();
            $paths[$v['id']] = [];
          
            foreach ($urls as $url) {
                //dd($url);
                $paths[$v['id']][] = $url['meta']['alias'];
            }
            array_push($paths[$v->id], $v->meta->alias);
            $paths[$v->id] = '/' . implode('/', $paths[$v['id']]);
        }

        return ['tree' => $tree->toTree(), 'urls' => $paths];
    }

    public static function buildUrl($category) {
        if (!$category) {
            return [];
        }

        $tree = CatalogCategories::defaultOrder()->with('meta')->whereAncestorOf($category)->get()->toArray();

        $url = '';
        foreach ($tree as $v) {
            $url[] = $v['meta']['alias'];
        }

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
        $urls[] = $id;
        $data = (new CatalogCategories)->getCategories($urls);
        $crumbs = [];
        foreach ($data as $v) {
            $crumbs[] = [
                'title' => $v['properties']['title']['value'],
                'href' => self::buildUrl($v)
            ];
        }
        return $crumbs;
    }

}
