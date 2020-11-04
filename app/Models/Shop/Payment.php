<?php

namespace App\Models\Shop;

use App\Models\Model;

/**
 * App\Models\Shop\Payment
 *
 * @property int $id
 * @property string $title
 * @property string|null $data
 * @property int|null $enabled
 * @property string|null $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shop\Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Payment extends Model {

    protected $table = 'shoppaymentmethods';

}
