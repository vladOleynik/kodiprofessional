<?php

namespace App\Models\Seo;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Seo\Counters
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\Counters newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\Counters newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo\Counters query()
 * @mixin \Eloquent
 */
class Counters extends Model {
    const SETTING = 'seo_counters';
    
    
    public static function get() {      

        $data = \App\Models\FundamentalSetting::where('var', 'seo_counters')->first()->value;
        return $data;
    }
}