<?php

namespace App\Helpers;


use App\Models\Exchange;
use App\Models\FundamentalSetting;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class AdminUrl {
    
    public static function currentUrl () {
    
        $regex = '/^\/' . \Config::get('sleeping_owl.url_prefix') . '(.*)/';
        return preg_match($regex, request()->server->get('REQUEST_URI'));
     
        
    }

      

}