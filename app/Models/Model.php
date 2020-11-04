<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * App\Models\Model
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model query()
 * @mixin \Eloquent
 */
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