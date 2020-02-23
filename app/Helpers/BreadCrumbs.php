<?php

namespace App\Helpers;

use App\Models\StaticData\StaticTexts;

class BreadCrumbs {
    
    public static function getTitle($alias) {
        
    return StaticTexts::where('alias',$alias)->where('lang',loc())->first()->value;
    
    
    
        
    }
    
    
}

