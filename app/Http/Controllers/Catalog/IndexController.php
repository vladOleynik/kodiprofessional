<?php

namespace App\Http\Controllers\Catalog;

use App\Models\Catalog\Product;
use App\Models\Catalog\Category;
use App\Models\Meta;
use function foo\func;

class IndexController
{

    public function category($guid)
    {
        $url = \App\Helpers\Catalog\Categories::all();
        //  \Cache::forget('categoriesMenu');
        //  dd(\Cache::get('categoriesMenu'));

        $active = $url['urls'][$guid];
        $category = Category::with(['meta'])->find($guid);
        $parent = Category::ancestorsOf($guid);
		$ids  = Category::descendantsAndSelf($guid)->pluck('id');
        $products = Product::whereHas('categories', function($q) use($ids) {
        return $q->whereIn('category_id', $ids);
    })->with(['meta', 'categories'])->published()->productSort()->paginate(12);

        \Breadcrumbs::register('catalog', function ($crumb) use ($url, $active, $category, $parent) {
            $crumb->parent('home');
            foreach ($parent as $k => $v) {

                $crumb->push($v->title, $url['urls'][$v->id]);
            }
            $crumb->push($category->title, $active);
        });

        $wishlist = Product::wishlist();

        return view('catalog.category', ['data' => $category, 'products'=>$products, 'active'=>$active, 'wishlist'=>$wishlist]);
    }

    public function product($id)
    {
        $url = \App\Helpers\Catalog\Categories::all();

        $product = Product::with('meta','categories')->find($id);
        $category = $product->categories[0];
        $active = $url['urls'][$category->id];
        $parent = Category::ancestorsOf($category->id);
        $similar = $category->products()->where('product_id','!=',$product->id)->take(4)->get();

        \Breadcrumbs::register('catalog', function ($crumb) use ($url, $active, $category, $parent) {
            $crumb->parent('home');
            foreach ($parent as $k => $v) {

                $crumb->push($v->title, $url['urls'][$v->id]);
            }
            $crumb->push($category->title, $active);
        });

        $wishlist = Product::wishlist();
        return view('catalog.product', ['data'=>$product, 'similar'=>$similar, 'urls'=>$url['urls'], 'wishlist'=>$wishlist]);

    }


}