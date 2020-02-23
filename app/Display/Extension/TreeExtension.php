<?php

namespace App\Display\Extension;

use Illuminate\Support\Facades\Input;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomCollection
 *
 * @author php-jun
 */
class TreeExtension implements \SleepingOwl\Admin\Contracts\Display\DisplayExtensionInterface {

    public function getDisplay() {
        
    }

    public function getOrder() {
        
    }

    public function modifyQuery(\Illuminate\Database\Eloquent\Builder $query) {
        $query->where('menu_id', Input::get('menu_id'));
    }

    public function setDisplay(\SleepingOwl\Admin\Contracts\Display\DisplayInterface $display) {
        
    }

    public function setOrder($order) {
        
    }

    public function toArray() {
        
    }

}