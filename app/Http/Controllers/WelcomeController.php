<?php

namespace App\Http\Controllers;


use App\Models\Catalog\Category;
use App\Models\Catalog\Product;

class WelcomeController extends Controller
{

    public function index() {

        $categories = Category::where('data->main', true)->wherePublished(1)->with('meta')->take(9)->orderBy('data->number')->get();

        $url = \App\Helpers\Catalog\Categories::all();


        return view('welcome', ['categories' => $categories, 'urls' => $url['urls'] ]);
    }

    public function wishlist(){


        $url = \App\Helpers\Catalog\Categories::all();
        $products = Product::getWishlist();


        return \View::make("_partials/wishlist", ["wishlist" => $products, 'urls'=>$url['urls']]);
    }


}