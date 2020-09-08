<?php

namespace App\Models\Sliders;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Sliders\Fields
 *
 * @property int $id
 * @property int $slider_id
 * @property string $alias
 * @property string $title
 * @property string $field_type
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Fields newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Fields newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sliders\Fields onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Fields query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Fields whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Fields whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Fields whereFieldType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Fields whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Fields whereSliderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Fields whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sliders\Fields withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sliders\Fields withoutTrashed()
 * @mixin \Eloquent
 */
class Fields extends Model {
    
    use SoftDeletes;

    protected $table = 'slidersfields';
    protected $fillable = ['alias', 'slider_id', 'title', 'class', 'lang', 'domain'];
    public $timestamps = false;

}
