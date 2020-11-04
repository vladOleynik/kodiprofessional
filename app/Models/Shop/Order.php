<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model;

/**
 * App\Models\Shop\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $status_id
 * @property object $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property object|null $wb_request
 * @property \Illuminate\Support\Carbon|null $time_set_delivery
 * @property-read \App\Models\Shop\Order\Details $detailOrder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Shop\Order\Details[] $details
 * @property-read mixed $amount_order
 * @property-read mixed $payment_status
 * @property-read mixed $type
 * @property-read \App\Models\Shop\OrderStatus $status
 * @property-read \App\Models\Shop\Transactions $transactions
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shop\Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order whereTimeSetDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order whereWbRequest($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shop\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shop\Order withoutTrashed()
 * @mixin \Eloquent
 */
class Order extends Model
{

    use SoftDeletes;

    protected $table = 'shoporders';
    protected $casts = ['data' => 'object', 'wb_request' => 'object'];
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'time_set_delivery'
    ];

    public function details()
    {
        return $this->hasMany(\App\Models\Shop\Order\Details::class, 'order_id');
    }

    public function status()
    {
        return $this->hasOne(\App\Models\Shop\OrderStatus::class, 'id', 'status_id');
    }

    public function transactions()
    {
        return $this->hasOne(\App\Models\Shop\Transactions::class, 'order_id', 'id');
    }

    public function user()
    {

        return $this->hasOne(\App\User::class, 'id', 'user_id');
    }

    public function getTypeAttribute($value)
    {
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

    public function getAmountOrderAttribute()
    {
        return number_format($this->details->pluck('price')->sum(), 2, '.', '');
    }
}
