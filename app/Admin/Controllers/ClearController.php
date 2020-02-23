<?php

namespace App\Admin\Controllers;
 
class ClearController {
    
    public function index() {
   \Cache::forget('categoriesMenu');
 //  dd(\Cache::get('categoriesMenu'));
        return redirect()->back();
    }
    
}