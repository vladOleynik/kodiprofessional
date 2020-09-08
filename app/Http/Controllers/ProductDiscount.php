<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Product;
use App\Services\DiscountProductService;
use \Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProductDiscount extends Controller
{
    public function getListProducts()
    {
        $products = Product::simplePaginate(50);
        return view('product-discount', compact('products'));
    }

    public function getProductByTitle(Request $request)
    {
        $products = Product::where('title', 'like', '%' . $request->title . '%')->limit(200)->get();
        return view('filtered-product', compact('products'));
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

    public function setDiscount(Request $request)
    {
        try {
            $discountProductService = app(DiscountProductService::class);
            $discountProductService->setDiscount($request->ids, $request->discount);
        } catch (\Throwable $exception) {
            return response(['message' => $exception->getMessage()], Response::HTTP_CONFLICT);
        }
        return response(['message' => 'ok']);
    }
}
