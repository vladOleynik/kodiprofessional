<?php

namespace App\Models\Shop;

use App\Models\Model;

class OrderStatus extends Model {

    protected $table = 'shoporderstatuses';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = ['data'=>'object'];

}
