<?php

namespace App\Helpers;

use App\Models\Seo\GlobalMeta as Model;
use App\Models\Seo\Templates;
use App\Models\Catalog\Sizes;
use App\Models\Catalog\Category;
use App\Models\Catalog\Properties;
use App\Models\Catalog\PropertiesValues;
class Seo {

    protected static $meta = [];
    protected static $canonical = null;

    public static function loadMeta($data = null, $meta = null) {
 
       // dd($meta,$data);
       if(is_null($meta)){
         $meta=$data['meta'];
       }
     
//dd($meta);       
//       if(!empty($data) && !empty($meta)){
//       $template = self::prepareMeta($data, $meta);
//     //  dd($meta);
//       if(!empty($meta['meta_title']) && !empty($meta['meta_description'])) {
//         $data = $meta; 
//        // dd($data);
//       } else {
//           $meta['meta_title'] = $template['meta_title'];
//           $meta['meta_description'] = $template['meta_description'];
//           $data = $meta;
//       //    dd($data);
//       }
//        }
 //    dd($data);
      $data=$meta;

        $uri = $_SERVER['REQUEST_URI'];
        
        $local = Model::where('url', $uri)->get()->first();
        $return = null;
        if ($local) {
            $local = $local->toArray();
           // dd($local);
            $return = [];

            $return['meta_title'] = $local['meta_title'] ?? $data['meta_title'] ?? null;
            $return['meta_keywords'] = $local['meta_keywords'] ?? $data['meta_keywords'] ?? null;
            $return['meta_description'] = $local['meta_description'] ?? $data['meta_description'] ?? null;
            $return['seo_text'] = $local['seo_text'] ?? $data['seo_text'] ?? null;
        } else {
            if (!is_null($data)) {
                $return = $data;
            //    dd($return);
            }
        }



        $robots = [];

        if(isset($return['noindex'])&&$return['noindex']) {
            $robots[] = 'noindex';
        }
        if(isset($return['nofollow'])&&$return['nofollow']) {
            $robots[] = 'nofollow';
        }
        if(count($robots)) {
            $return['robots'] = implode(',', $robots);
        }
         $check = explode('/', trim(parse_url(request()->server->get('REQUEST_URI'), PHP_URL_PATH), '/'));
         $page = in_array('page',$check);

     //    dd($data);

      if($page && isset($return['meta_title']) && isset($return['meta_description'])) {
          $staticPage = ' Страница №';
           $paginatePage = array_pop($check);
          $return['meta_title'] .= $staticPage.' '. $paginatePage;
          $return['meta_description'] .= $staticPage.' '. $paginatePage;
      }
        \View::share('metaData', $return);
        self::$meta = $return;
       
    }

    public static function seoText() {
        return self::$meta['seo_text'];
    }

    public static function __callStatic($name, $arguments) {
        return self::$meta[$name] ?? $arguments[0] ?? null;
    }

    public static function aliasPrepare($alias) {
        return preg_replace('/\.html?$/iu', '', $alias);
    }

    /**
     * 
     * @param string $link - relative URL. NOT absolute.
     */
    public static function setCanonical($link) {
        $server = request()->server;
        $protocol = $server->get('HTTPS') == 'on' || $server->get('HTTP_X_FORWARDED_PROTO') == 'https' ? 'https' : 'http';
        //$link = $protocol . '://' . $server->get('HTTP_HOST') . $link;
        self::$canonical = (string) $link;
    }

    public static function canonical() {
        if (!is_null(self::$canonical)) {
            return '<link rel="canonical" href="' . self::$canonical . '" />';
        }
        return;
    }

    public static function head($data = null) {
        return view('system.head_meta', ['data' => $data]);
    }

}
