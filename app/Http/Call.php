<?php

namespace App\Http;

use Illuminate\Http\Request;
use App\Models\Meta;

class Call {

    protected $callControllers = [
        'general' => [
            'catalog' => [
                'catalog_categories' => '\App\Http\Controllers\Catalog\IndexController@category',
                'catalog_products' => '\App\Http\Controllers\Catalog\IndexController@product',
            ],
        ],
        'custom' => [
            'catalog' => [
            ]
        ]
    ];
    private $nonHtmlTypes = ['catalog_categories'];

    public function url(Request $request) {
        $check = explode('/', trim(parse_url($request->server->get('REQUEST_URI'), PHP_URL_PATH), '/'));

        if(in_array('page', $check)) {
           array_pop($check);
           array_pop($check);
           }

        $alias = end($check);
        $tmpAlias = $alias;
        $alias = \App\Helpers\Seo::aliasPrepare($alias);

        if (is_numeric($alias)) {
            $check = Meta::where('data_id', '=', $alias)->first();
        } else {
            $check = Meta::where('alias', '=', $alias)->first();
        }

        if (!is_null($check) && $check->exists) {
           
            $check = $check->toArray();
        
            $isValid = true;
            if (ends_with($tmpAlias, '.html') && in_array($check['type'], $this->nonHtmlTypes)) {
                  
                $isValid = false;
                abort(404);
            }
            
            if (isset($this->callControllers['general']['catalog'][$check['type']])) {
                $callString = $this->callControllers['general']['catalog'][$check['type']];

                   
                return \App::call($callString, ['id' => $check['data_id'], 'alias' => $check['alias']]);
            } else {
            
                if (isset($this->callControllers['custom']['catalog'][$check['type']])) {
                    switch ($this->callControllers['custom']['catalog'][$check['type']]) {
                        case 'App\Http\Controllers\Catalog\IndexController@product':

                            return \App\Custom\Catalog::productPage(trim($request->server->get('REQUEST_URI'), '/'), $check);
                            break;
                    }
                }
            }
        } else {
            abort(404);
        }
    }

}
