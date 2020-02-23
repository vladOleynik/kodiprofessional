<?php

namespace App\Http\Controllers;

use App\Models\Catalog\Feed;
use App\Models\Catalog\Feed2;
use App\Models\Catalog\Feed3;
use App\User;
use Illuminate\Http\Request;
use Excel;
use App\Imports\UsersImport;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //     $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function show()
    {

        return view('excel');
    }

    public function store(Request $request)
    {

        $arr = [];
        $file = $request->file('excel');

        $data = Excel::toArray($arr, $file);
        $data = array_collapse($data[0]);
        $result = User::whereIn('name', $data)->get();
        dd($result);
    }

    public function feed()
    {
        $xml = Feed::getXMLFeedData();
        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
    public function feed2()
    {
        $xml = Feed2::getXMLFeedData();
        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
    public function feed3()
    {
        $xml = Feed3::getXMLFeedData();
        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

}
