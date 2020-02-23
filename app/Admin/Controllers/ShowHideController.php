<?php

namespace App\Admin\Controllers;

use App\Models\Sliders\Images;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;

class ShowHideController
{

    public function Show($model, $id)
    {

        switch ($model) {
            case $model === 'slider':
                $item = Images::find($id);
                break;
            case $model === 'category':
                $item = Category::find($id);
                break;
            case $model === 'product':
                $item = Product::find($id);
                break;
        }

        $item->published = !$item->published;
        $item->save();

        return redirect()->back();
    }

}

