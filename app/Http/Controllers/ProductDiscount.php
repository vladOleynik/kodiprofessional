<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Product;
use \Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProductDiscount extends Controller
{
    public function getListProducts()
    {
        $products = Product::simplePaginate(50);

        return view('product-discount', compact('products'));
    }

    public function saveDiscount(Request $request)
    {
        try {
            if (!$request->discount) {
                throw new \Exception('Нужно ввести скидку');
            }
            session(['discount' => $request->discount]);
        } catch (\Throwable $exception) {
            return response(['message' => $exception->getMessage()], Response::HTTP_CONFLICT);
        }
        return response(['message' => 'ok']);
    }
}
