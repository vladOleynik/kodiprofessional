<?php

namespace App\Models\Catalog;

use http\Cookie;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model;

class Product extends Model
{

    use SoftDeletes;

    const TYPE = 'catalog_products';

    protected $casts = ['data' => 'object', 'images' => 'object'];
    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

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

    public function scopeProductSort($query) {

        $filter = request()->cookie('sortBy');

        switch ($filter) {

            case 'Minimum Price':
                return $query->orderBy('price','asc');
                break;
            case 'Maximum Price':
                return $query->orderBy('price','desc');
                break;
            case 'Popular':
                return $query->orderBy('data->popular','desc');
                break;
            case 'New':
                return $query->orderBy('order_by','asc');
                break;
            default:
                return $query->orderBy('order_by','asc');

        }

    }


}