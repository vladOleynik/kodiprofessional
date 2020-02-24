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
        $orders = Auth::user()->shopOrders()->with('detailOrder', 'status')->get();
        return view('personal-cabinet', compact('orders'));
    }
}
