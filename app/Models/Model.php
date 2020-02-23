<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel { 
    
    public function setKeys(&$data, $field = 'id') {
        $ret = [];
        foreach ($data as $k => $v) {
            $ret[] = $v[$field];
        }
        $data = array_combine($ret, $data);
        return $data;
    }
    
    
}