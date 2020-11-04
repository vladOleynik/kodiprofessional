<?php

namespace App\Http\Controllers;

use App\Helpers\OrderHelper;
use App\Mail\PaymentUnsuccessful;
use App\Mail\PaymentSuccessful;
use App\Mail\SenderAdmin;
use App\Models\Catalog\Product;
use App\Models\Shop\Order;
use Illuminate\Support\Facades\Mail;
use App\Models\FundamentalSetting;
use App\Models\StaticData\StaticPages;
use Illuminate\Support\Facades\Log;

class StaticPagesController extends Controller
{

    public function shipping() {

        $data = StaticPages::find(4);

        return view('shipping', ['data' => $data]);
    }

    public function purchase()
    {
        $data = StaticPages::find(5);

        return view('shipping', ['data' => $data]);
    }

    public function wholesale() {

        $result = Product::whereHas('categories')->with('categories.meta')->whereNotNull('sale')->productSort()->published()->paginate(12);

        $url = \App\Helpers\Catalog\Categories::all();

        foreach ($result as $res) {

            $res['link'] = $url['urls'][$res->categories[0]->id];
        }
        $wishlist = Product::wishlist();
        return view('wholesale', ['products' => $result, 'wishlist' => $wishlist, 'urls'=>$url['urls']]);



    }

	public function paySuccess(Order $order)
    {

        $data = request()->all();
		$status_id = 6;
        if ($data) {
            if (isset($data['payment_status'])) {
                if ($data['payment_status'] == 'Completed') {
                    $status_id = 4;
                }
                if ($data['payment_status'] == 'Failed') {
                    $status_id = 5;
                }
                if ($data['payment_status'] == 'Pending') {
                    $status_id = 6;
                }
            }
            if ($data) {
                $order->wb_request = $data;
            } else {
                $order->wb_request = 'empty';
            }
            $order->status_id = $status_id;
            if ($order->save()) {
                $amount = OrderHelper::getAmountOrder($order);
                $user = OrderHelper::getUser($order);
                Mail::to($user->email)->send(new PaymentSuccessful($amount));
                Mail::to('kodiprofessional2016@gmail.com')->send(new SenderAdmin($user->email, $order));
                return response()->json(['res' => 'Order successful saved']);
            } else {
                return response()->json(['res' => 'Order failed saved']);
            }
        } else {
            return response()->json(['res' => 'Request empty']);
        }
    }

    public function payReturn()
    {
        return view('pay_success');
    }

    public function payFail(Order $order)
    {
        $user = OrderHelper::getUser($order);
        Mail::to($user->email)->send(new PaymentUnsuccessful());
        return view('pay_fail');
    }
	 public function contact() {

        return view('contact');
    }

    protected function sendMail() {

    }
}
