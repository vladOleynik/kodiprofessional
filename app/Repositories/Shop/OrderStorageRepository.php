<?php

namespace App\Repositories\Shop;

use App\Repositories\Contracts\Shop\OrderRepositoryInterface;
use App\Repositories\Contracts\Shop\OrderStorageInterface;
use App\Models\Shop\Order;
use \Illuminate\Http\Request;

class OrderStorageRepository implements OrderStorageInterface
{

    protected $storage = null;

    public function __construct()
    {

        if (is_null(session('cart.items'))) {
            session(['cart.items' => []]);
        }

    }

    public function addItem($data)
    {

        $this->saveItem($data);
    }

    public function removeItem($id)
    {

        unset($this->storage->items[$id]);
    }

    public function get()
    {
        //dd(session('cart.items'));
        return session('cart.items');
    }

    private function saveItem($data)
    {
        $count = $data['count'];
        $productId = $data['product_id'];

        $items = session('cart.items');
        if (isset($items[$productId])) {
            $items[$productId] = $items[$productId] + $count;
        } else {
            $items[$productId] = $count;
        }
        session(['cart.items' => $items]);
        session()->save();

    }

    public function set($items)
    {
        //   dd($items);
        session(['cart.items' => $items]);
        session()->save();
    }

    public function clear()
    {
        session(['cart.items' => []]);
        session()->save();
    }

}
