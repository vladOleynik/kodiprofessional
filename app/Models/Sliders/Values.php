<?php

namespace App\Models\Sliders;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Sliders\Values
 *
 * @property int $id
 * @property int $field_id
 * @property int $slider_id
 * @property int $data_id
 * @property string|null $value
 * @property string|null $deleted_at
 * @property-read \App\Models\Sliders\Fields $sliders_fields
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Values newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Values newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sliders\Values onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Values query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Values whereDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Values whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Values whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Values whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Values whereSliderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sliders\Values whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sliders\Values withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Sliders\Values withoutTrashed()
 * @mixin \Eloquent
 */
class Values extends Model {

    use SoftDeletes;

    protected $table = 'slidersfieldsvalues';
    protected $fillable = ['field_id', 'slider_id', 'data_id', 'value', 'lang', 'domain'];
    public $timestamps = false;

    public function sliders_fields() {
        return $this->hasOne('App\Models\Sliders\Fields', 'id', 'field_id');
    }

}
