<?php

namespace App\Helpers;

class Admin {
    public static function lang($langId = null) {
                if(!is_null($langId)) {
            session(['admin_language'=>$langId]);
        }
        return session('admin_language');
    }
}