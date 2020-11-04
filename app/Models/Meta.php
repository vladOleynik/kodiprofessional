<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Meta
 *
 * @property int $id
 * @property int $data_id
 * @property string|null $type
 * @property string|null $alias
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property int $noindex
 * @property int $nofollow
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereMetaTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereNofollow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereNoindex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Meta extends Model
{
    use \App\Traits\Sluggable;

}
