<?php

namespace App\Http\Controllers\Shop;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Core\ClientController;
use App\Models\Shop\Order\Details;

class OrderDeleteController extends ClientController { 
    
    public function index() {
       $data = request()->all();
       
       $item = Details::find(key($data));
       $item->delete();
       return response()->json(['res' => 'success']);
    }
    
}

