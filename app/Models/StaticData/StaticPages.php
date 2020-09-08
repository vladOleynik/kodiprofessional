<?php

namespace App\Models\StaticData;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model;
use App\Helpers\AdminUrl;

/**
 * App\Models\StaticData\StaticPages
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int|null $published
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Meta $meta
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticPages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticPages newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaticData\StaticPages onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticPages query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticPages whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticPages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticPages whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticPages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticPages wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticPages whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StaticData\StaticPages whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaticData\StaticPages withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StaticData\StaticPages withoutTrashed()
 * @mixin \Eloquent
 */
class StaticPages extends Model
{
    use SoftDeletes;
    const TYPE = 'static_pages';
    const MODULE = 'static';

    protected $table = 'staticpages';
    protected $casts = ['data' => 'object'];
    protected $guarded = ['id'];

    public function meta()
    {

        return $this->hasOne(\App\Models\Meta::class, 'data_id')->where('type', self::TYPE);
    }

}
