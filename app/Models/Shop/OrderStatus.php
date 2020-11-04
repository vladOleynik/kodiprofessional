<?php

namespace App\Models\Shop;

use App\Models\Model;

/**
 * App\Models\Shop\OrderStatus
 *
 * @property int $id
 * @property string $title
 * @property int $is_default
 * @property int $enabled
 * @property object $data
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\OrderStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\OrderStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\OrderStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\OrderStatus whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\OrderStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\OrderStatus whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\OrderStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\OrderStatus whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\OrderStatus whereTitle($value)
 * @mixin \Eloquent
 */
class OrderStatus extends Model {

    protected $table = 'shoporderstatuses';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = ['data'=>'object'];

}
