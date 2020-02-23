<?php

namespace App\Models\Seo;
use Illuminate\Database\Eloquent\Model;

class Counters extends Model {
    const SETTING = 'seo_counters';
    
    
    public static function get() {      

        $data = \App\Models\FundamentalSetting::where('var', 'seo_counters')->first()->value;
        return $data;
    }
}