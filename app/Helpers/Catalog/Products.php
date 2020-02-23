<?php

namespace App\Helpers\Catalog;
use App\Models\Catalog\Category;
class Products {

    protected static $suffix = '.html';

    public static function buildUrl($productAlias, $categoryUrl = '') {
        return rtrim($categoryUrl, '/') . '/' . $productAlias . self::$suffix;
    }


   

    public static function getSuffix() {
        return self::$suffix;
    }

    public static function setSuffix($suffix) {
        self::$suffix = (string) $suffix;
    }
    
    public static function getMainCategory($product) {
        $mainCategory = null;
        foreach($product['categories'] as $v) {
            if((bool)$v['pivot']['main'] === true) {
                $mainCategory = $v['pivot']['category_id'];
                break;
            }
        }
        if(is_null($mainCategory)) {
            throw new \Exception('No main category id provided for this product');
        }
        return (new \App\Models\Catalog\Category)->get($mainCategory);
    }

    
    public static function getCategoryUrl($id) {
        $category = Category::where('id',$id)->with('meta')->first();
        $categoryUrl = \App\Helpers\Catalog\Categories::buildUrl($category);
        return $categoryUrl;
    }
}
