<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FundamentalSetting
 *
 * @property int $id
 * @property string $name
 * @property string $var
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FundamentalSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FundamentalSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FundamentalSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FundamentalSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FundamentalSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FundamentalSetting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FundamentalSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FundamentalSetting whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FundamentalSetting whereVar($value)
 * @mixin \Eloquent
 */
class FundamentalSetting extends Model
{
    protected $table = 'fundamentalsettings';
    protected $fillable = [
        'name', 'var', 'value', 'description',
    ];
}
