<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;
use App\Models\StaticTexts;
use App\Http\Sections\Core\Section;
use SleepingOwl\Admin\Admin;

class AdminHelper extends Admin {

    private $_accessAllowed = false;
    private static $_instance = null;
    protected $_useModels = [
            //'App\Models\Seo\Robots'
    ];

    const ALLOWED_ACCESS_ROLE = 1;
    const PANEL_PATH = 'panel';

    public static function adminMenu() {
        

        return \App::make(__CLASS__);
    }

    public function appendModel($model) {
        $this->_useModels[] = (string) $model;
        return $this;
    }

    public function appendModels(array $models) {
        foreach ($models as $model) {
            $this->appendModel($model);
        }
        return $this;
    }

    /**
     * @todo Не забыть включить авторизацию обратно!1111
     * @return type
     */
    public function render() {
       
        if (\Auth::user() && ((int) \Auth::user()->role_id === self::ALLOWED_ACCESS_ROLE || (int) \Auth::user()->role_id === 2) ) {
            \Route::post('inline-auto-save', '\App\Core\InlineController@save')->name('static_texts_inline_edit');
            \Route::get('inline-meta/{data_id?}/{module?}/{type?}', '\App\Http\Controllers\Seo\Admin\MetaController@index')
                    ->name('meta_inline_edit');
            \Route::post('inline-meta', '\App\Http\Controllers\Seo\Admin\MetaController@save')->name('meta_inline_edit_save');
            $this->_accessAllowed = true;
            $allSections = \App::make(Admin::class)->navigation();
            //dd($allSections);
            //dd(get_class_methods(get_class($allSections)));
            return view('admin.quickpanel', ['items' => [], 'adminLink' => \Config::get('sleeping_owl.url_prefix'), 'useModels' => $this->_useModels, 'items' => $allSections->getPages()]);
            //return view('admin.quickpanel', ['items' => $allSections->getPages()]);
        }
    }

    public static function bootRoutes() {
        //if (\Auth::user() && (int) \Auth::user()->role_id === self::ALLOWED_ACCESS_ROLE) {
        //}
    }

    public static function allowed() {
        //return false;
        return \Auth::user() && (int) \Auth::user()->role_id === self::ALLOWED_ACCESS_ROLE;
    }

}
