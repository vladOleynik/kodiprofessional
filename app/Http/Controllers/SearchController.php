<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Product;


class SearchController extends Controller
{

    public function index()
    {


        $search = request()->get('search');

        if ($search) {
            $result = Product::whereHas('categories')->with('categories.meta')->where('title', 'LIKE', '%' . $search . '%')
                ->productSort()->published()->paginate(12);


            $url = \App\Helpers\Catalog\Categories::all();

            foreach ($result as $res) {
                if (isset($url['urls'][$res->categories[0]->id])) {
                    $res['link'] = $url['urls'][$res->categories[0]->id];
                }
            }
            $wishlist = Product::wishlist();
            return view('search', ['products' => $result, 'query' => $search, 'wishlist' => $wishlist, 'urls' => $url['urls']]);
        } else {
            return abort('404');
        }
    }

}
