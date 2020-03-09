<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Jobs\ForgetOrder;
use App\Models\Catalog\Product;
use App\User;
use Illuminate\Http\Request;
use App\Models\Shop\Order;
use App\Models\Shop\OrderStatus;
use App\Models\FundamentalSetting;

class Cart extends Controller
{

    public static function index()
    {

        $productsList = session('cart.items');

        if ($productsList) {
            $products = Product::whereIn('id', array_keys($productsList))->with('meta', 'categories')->get();
            $products->map(function ($item) use ($productsList) {
                $item['count'] = $productsList[$item->id];
            });
            $count = 0;
            $sum = 0;
            $url = \App\Helpers\Catalog\Categories::all();
            $urls = $url['urls'];
            foreach ($products as $k => $v) {
                $sum += $v['price'] * $v['count'];
                $count += $v['count'];
                $v['url'] = \App\Helpers\Catalog\Products::buildUrl($v->meta['alias'], $urls[$v->categories[0]->id]);
            }

            //      $view = \View::make("_partials/cartitem", ["products" => $products, 'urls'=>$url['urls']]);
            return ['sum' => $sum, 'products' => $products, 'urls' => $urls, 'count' => $count];
            // return ['view'=>$view->render(), 'sum'=>$sum->sum(), 'count'=>$products->count()];

        } else {
            return ['products' => [], 'urls' => [], 'sum' => 0, 'count' => 0];
        }
    }

    public function reload()
    {

        $productsList = session('cart.items');

        if ($productsList) {
            $products = Product::whereIn('id', array_keys($productsList))->with('meta', 'categories')->get();
            $products->map(function ($item) use ($productsList) {
                $item['count'] = $productsList[$item->id];
            });
            $count = 0;
            $sum = 0;
            foreach ($products as $k => $v) {
                $sum += $v['price'] * $v['count'];
                $count += $v['count'];
            }
            $url = \App\Helpers\Catalog\Categories::all();

            $view_cart = \View::make("_partials/cartitem", ["products" => $products, 'urls' => $url['urls']]);
            $view_cart_confirm = \View::make("_partials/cartorderitem", ["products" => $products, 'urls' => $url['urls']]);


            return ['view' => $view_cart->render(), 'view_confirm' => $view_cart_confirm->render(), 'sum' => number_format($sum, 2), 'products' => $products, 'urls' => $url['urls'], 'count' => $count];
        } else {
            return ['view' => '', 'view_cart' => '', 'products' => [], 'urls' => [], 'sum' => 0, 'count' => 0];
        }


    }


    public function order(Request $request)
    {
        $userdata = $request->except('_token');
        $data = self::index();
        $products = $data['products'];
        if (auth()->user()) {
            $user_id = auth()->user()->id;
        } elseif ($userdata['email']) {

            $user = User::whereEmail($userdata['email'])->first();
            if ($user) {
                $user_id = $user->id;
            } else {
                $pass = str_random(8);
                $userdata['password'] = bcrypt($pass);
                if (isset($userdata['shipping']['firstName']) && isset($userdata['shipping']['lastName'])) {
                    $userdata['name'] = $userdata['shipping']['firstName'] . ' - ' . $userdata['shipping']['lastName'];
                } else {
                    $userdata['name'] = 'anonim';
                }

                $user = User::create($userdata);
                \Auth::loginUsingId($user->id);
                $user_id = $user->id;
            }
        } else {
            $user_id = 1;
        }

        $user = auth()->user();
        if ($user && !$user->phone) {
            $user->phone = $userdata['phone'];
            $user->save();
        }

        if ($products) {
            $result = \DB::transaction(function () use ($userdata, $data, $products, $user_id) {

                try {
                    $order = new Order;
                    $order->user_id = $user_id;
                    $order->data = $userdata['shipping'];
                    $order->status_id = OrderStatus::whereIsDefault(1)->first()->id;
                    $order->save();
                    dispatch(new ForgetOrder($order))->delay(now()->addMinutes(15));
                    $sum = 0;
                    $items = [];
                    foreach ($products as $k => $v) {

                        $order->details()->insert([
                            'order_id' => $order->id,
                            'product_id' => $v->id,
                            'qty' => $v->count,
                            'price' => $v->price,
                            'options' => ''
                        ]);

                        $items[$k] = ['item_name_' . ++$k => $v->title, 'description_' . $k => $v->title,
                            'item_number_' . $k => $v->id, 'amount_' . $k => $v->price, 'quantity_' . $k => $v->count, 'url_' . $k => $v->url];
                        $sum = $sum + ($v->price * $v->count);
                        $order->details()->touch();

                    }
                    $sum = number_format($sum, 2, '.', '');
                    \DB::commit();
                    session(['cart.items' => null]);
                    session()->save();
                    unset($userdata['shipping']);
                    unset($userdata['password']);
                    return ['return' => 'https://kodiprofessional.com/pay/return',
                        'cancel_return' => 'https://kodiprofessional.com/pay/fail', 'notify_url' => 'https://kodiprofessional.com/pay/success/' . $order->id,
                        'res' => 'success', 'items' => $items, 'amount' => $sum, 'wb_login' => 'litvlitanto',
                        'invoice' => $order->id, 'wb_hash' => md5('litvlitantoH`^yPTY' . $sum . $order->id)];
                } catch (Exception $ex) {
                    return ['res' => 'error', 'order_id' => 'error'];
                    \DB::rollBack();
                }
            });
        } else {
            $result = ['res' => 'error', 'order_id' => 'error'];
        }

//        if ($result['res'] == 'success') {
//            $adminMail = FundamentalSetting::where('var', 'adminMail')->first();
//            $adminMail = $adminMail->value;
//            $order = Order::where('id', $result['order_id'])->with(['user', 'status', 'details' => function ($q) {
//                return $q->with(['product']);
//            }])->first();
//            $order->payment = isset($order->data->payment) ? Payment::find($order->data->payment) : null;
//            $order->delivery = isset($order->data->payment) ? Delivery::find($order->data->delivery) : null;
//            //  dd($order);
//
//            $customerMail = $order->user->email;
//
//            Mail::send('ordermail', ['order' => $order], function ($message) use ($adminMail, $customerMail) {
//
//                $message->to($adminMail)->subject('C�������� � ������');
//                if (!empty($customerMail)) {
//                    $message->to($customerMail)->subject('C�������� � ������');
//                }
//
//
//            });
//        }

        return response()->json($result);
    }

    public function pay(Request $request)
    {

        $result = $request->get('wb_result');

        if ($result && $result == 'VERIFIED') {
            return redirect(route('index'));
        } else {
            return redirect(route('wholesale'));
        }


    }


    public function remove()
    {
        $data = request()->except(['_token']);


        $count = $data['count'];
        $productId = $data['product_id'];

        $items = session('cart.items');
        $items[$productId] = $items[$productId] - $count;

        session(['cart.items' => $items]);
        session()->save();

        return response()->json(['res' => 'success', 'count' => $count]);
    }

    public function add()
    {

        $data = request()->except(['_token']);

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

        return response()->json(['res' => 'success', 'count' => $count]);
        //dd($this->order->get());
    }

    public function delete()
    {
        $id = request('product_id');
        $items = session('cart.items');
        $count = $items[$id];
        unset($items[$id]);
        session(['cart.items' => $items]);
        session()->save();

        return response()->json(['res' => 'success', 'count' => $count]);

    }

}
