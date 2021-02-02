<?php

namespace App\Http\Controllers\PersonalCabinet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        //подгружаем у вложенного отношения несколько отношений
        $orders = Auth::user()->shopOrders()->with(['status', 'details.product' => function ($query) {
            $query->with(['categories', 'meta']);
        }])->get();
        //загружаем урлы для формирования ссылок на продукты
        $url = \App\Helpers\Catalog\Categories::all()['urls'];
        return view('personal-cabinet', compact('orders', 'url'));
    }

    public function size()
    {
        $df = round(disk_free_space("/") / 1024 / 1024 / 1024);
        print("Free space: $df GB");
    }
}
