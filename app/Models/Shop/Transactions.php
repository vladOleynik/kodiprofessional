<?php

namespace App\Models\Shop;

use App\Models\Model;

class Transactions extends Model {

    protected $table = 'shoptransactions';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = ['data'=>'object'];

    
}
