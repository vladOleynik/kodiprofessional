<?php

namespace App\Helpers;

class Translate {

    protected static $_urls = [];
    protected static $_locales = [];

    public static function set(array $urls) {
     //   dd($urls);
        if (!count(self::$_locales)) {
            //$data = \App\Models\Languages::get();
        }
        self::$_urls = $urls;
    }

    public static function lst() {
        return self::$_urls;
    }

    public static function get($locale) {
        
        return self::$_urls[$locale] ?? null;
    }
    
    public static function curr() {
        
        return locale();
    }

}
