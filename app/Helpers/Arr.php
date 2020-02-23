<?php

namespace App\Helpers;

class Arr {
    public static function setKeys(&$arr, $field = 'id') {
        $ids = [];
        foreach($arr as $v) {
            $ids[] = $v[$field];
        }
        $arr = array_combine($ids, $arr);
        return $arr;
    }
}