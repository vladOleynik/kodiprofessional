<?php

namespace App\Models\Shop;

use App\Models\Model;

/**
 * App\Models\Shop\Transactions
 *
 * @property int $id
 * @property int $order_id
 * @property float $price
 * @property string $status
 * @property object $data
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Transactions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Transactions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Transactions query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Transactions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Transactions whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Transactions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Transactions whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Transactions wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Transactions whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Transactions whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Transactions extends Model {

    protected $table = 'shoptransactions';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = ['data'=>'object'];

    
}
