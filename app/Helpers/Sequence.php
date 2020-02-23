<?php

namespace App\Helpers;
use App\Models\Core\Sequence as ModelSequence;

class Sequence {
    public static function next($model) {
       // dd($type);
      $model = $model->max('data_id');
      
        if(null === $model) {
      $data_id = 1;
            return $data_id; }
        else {
            $data_id = ++$model;
            return $data_id;
        }
    }
}