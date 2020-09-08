<?php


namespace App\Services;


use App\Models\Catalog\Product;

class DiscountProductService
{
    public function setDiscount($ids, $discount)
    {
        if(!is_array($ids)){
            throw new \Exception('Нужно заполнить редактируемый итем');
        }
        $products = Product::whereIn('id', $ids)->get();
        if (isset($discount)) {
            $this->removeDiscountInProduct($products);
            $this->updateDiscountInProducts($products, $discount);
        } else {
            $this->removeDiscountInProduct($products);
        }
    }

    private function updateDiscountInProducts($products, $discount)
    {
        session(['discount' => $discount]);
        foreach ($products as $product) {
            $oldPrice = $product->price;
            $newPrice = $oldPrice - $oldPrice * ($discount / 100);
            $newPriceFormatted = number_format($newPrice, 2, '.', '');
            $product->price = $newPriceFormatted;
            $product->old_price = $oldPrice;
            $product->discount = $discount;
            $product->save();
        }
    }

    private function removeDiscountInProduct($products)
    {
        foreach ($products as $product) {
            $price = $product->old_price ?? $product->price;
            $product->price = $price;
            $product->old_price = null;
            $product->discount = null;
            $product->save();
        }
    }
}
