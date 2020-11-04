<?php

namespace App\Models\Shop\Order;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Shop\Order\Details
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property array $options
 * @property int $qty
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Catalog\Product $product
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shop\Order\Details onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Order\Details whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shop\Order\Details withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Shop\Order\Details withoutTrashed()
 * @mixin \Eloquent
 */
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
