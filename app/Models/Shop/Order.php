<?php

namespace App\Models\Shop;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model;

class Order extends Model {

    use SoftDeletes;

    protected $table = 'shoporders';
    protected $casts = ['data'=>'object', 'wb_request' => 'object'];
    protected $guarded = [];
    protected $dates = ['created_at','updated_at','deleted_at'];

    public function details() {
        return $this->hasMany(\App\Models\Shop\Order\Details::class, 'order_id');
    }

    public function status() {
        return $this->hasOne(\App\Models\Shop\OrderStatus::class, 'id', 'status_id');
    }
    public function transactions() {
        return $this->hasOne(\App\Models\Shop\Transactions::class, 'order_id', 'id');
    }

    public function user() {

        return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

    public function getTypeAttribute($value) {
        dump($value);
    }

    public function detailOrder()
    {
        return $this->hasOne(\App\Models\Shop\Order\Details::class, 'order_id');
    }

    public function getPaymentStatusAttribute()
    {
        return optional($this->wb_request)->payment_status;
    }


}
