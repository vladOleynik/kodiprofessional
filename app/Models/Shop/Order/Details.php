<?php

namespace App\Models\Shop\Order;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Details extends Model {

    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'shopordersdetails';
    protected $casts = ['options' => 'array'];
    protected $dates = ['updated_at', 'created_at', 'deleted_at'];

    public function product() {
        return $this->hasOne(\App\Models\Catalog\Product::class, 'id', 'product_id');
    }

}
