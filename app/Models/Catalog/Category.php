<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model;

/**
 * App\Models\Catalog\Category
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property object|null $images
 * @property string $type
 * @property int|null $published
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property object|null $data
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Catalog\Category[] $children
 * @property-read \App\Models\Meta $meta
 * @property-read \App\Models\Catalog\Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog\Product[] $products
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category d()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Category withoutTrashed()
 * @mixin \Eloquent
 */
class Category extends Model
{

    use SoftDeletes,
        \Kalnoy\Nestedset\NodeTrait;

    const TYPE = 'catalog_categories';

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    protected $casts = ['data' => 'object', 'images' => 'object'];

    public function meta()
    {
        return $this->hasOne(\App\Models\Meta::class, 'data_id')->where('type', self::TYPE);
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Catalog\Product');
    }
}
