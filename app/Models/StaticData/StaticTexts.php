<?php

namespace App\Models\StaticData;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\StaticData\StaticTexts
 *
 * @property int $id
 * @property string|null $name
 * @property string $alias
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticTexts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticTexts newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaticData\StaticTexts onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticTexts query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticTexts whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticTexts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticTexts whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticTexts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticTexts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticTexts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticTexts whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaticData\StaticTexts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaticData\StaticTexts withoutTrashed()
 * @mixin \Eloquent
 */
class StaticTexts extends Model {

    use SoftDeletes;

    protected $table = 'statictexts';
    //что разрешаем править
    protected $fillable = [
        'name', 'alias', 'value',
    ];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

}
