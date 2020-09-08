<?php

namespace App\Models\Catalog;

use http\Cookie;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model;

/**
 * App\Models\Catalog\Product
 *
 * @property int $id
 * @property string|null $ean
 * @property string $title
 * @property string|null $description
 * @property object|null $images
 * @property object|null $data
 * @property int|null $published
 * @property float $price
 * @property float|null $old_price
 * @property int|null $sale
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $order_by
 * @property string|null $discount
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Catalog\Category[] $categories
 * @property-read \App\Models\Meta $meta
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product productSort()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product published()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product unpublished()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereEan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereOrderBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereSale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Catalog\Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{

    use SoftDeletes;

    const TYPE = 'catalog_products';

    protected $casts = ['data' => 'object', 'images' => 'object'];
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];
    protected $guarded = ['id'];
    protected $fillable = ['discount'];

    public function meta()
    {
        return $this->hasOne("App\Models\Meta", 'data_id')->where('type', self::TYPE);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Catalog\Category');
    }

    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', 0);
    }

    public static function wishlist()
    {
        $items = request()->cookie('products');
        if ($items) {
            $items = explode(',', $items);
        } else {
            $items = [];
        }
        return $items;
    }

    public static function getWishlist()
    {
        $items = self::wishlist();
        $products = Product::whereIn('id', $items)->with('meta', 'categories')->get();
        return $products;
    }

    public function scopeProductSort($query)
    {
        $filter = request()->cookie('sortBy');
        switch ($filter) {

            case 'Minimum Price':
                return $query->orderBy('price', 'asc');
                break;
            case 'Maximum Price':
                return $query->orderBy('price', 'desc');
                break;
            case 'Popular':
                return $query->orderBy('data->popular', 'desc');
                break;
            case 'New':
                return $query->orderBy('order_by', 'asc');
                break;
            default:
                return $query->orderBy('order_by', 'asc');
        }
    }
}
