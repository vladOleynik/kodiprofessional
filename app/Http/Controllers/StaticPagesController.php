<?php

namespace App\Http\Controllers;

use App\Helpers\OrderHelper;
use App\Mail\PaymentUnsuccessful;
use App\Mail\PaymentSuccessful;
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
                Log::info('amount '.$amount.' user '.$user->email);
                $login = 'kodiprofessional@kodiprofessional.com'; // замените test@domain.tld на адрес электронной почты, с которого производится отправка. Поскольку логин совпадает с адресом отправителя - данная переменная используется и как логин, и как адрес отправителя.

                $password = 'Ojn5752zGRsO';  // Замените 'password' на пароль от почтового ящика, с которого производится отправка.
                $to = 'kodiprofessional2016@gmail.com';  // замените to@domain.tld на адрес электронной почты получателя письма.
                $text="Новый заказ на сайте kodiprofessional.com";  // Содержимое отправляемого письма
                function get_data($smtp_conn)  // функция получения кода ответа сервера.
                {
                    $data="";
                    while($str = fgets($smtp_conn,515))
                    {
                        $data .= $str;
                        if(substr($str,3,1) == " ") { break; }
                    }
                    return $data;
                }
// формируем служебный заголовок письма.
                $header="Date: ".date("D, j M Y G:i:s")." +0700\r\n";
                $header.="From: =?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode('Новый заказ')))."?= <$login>\r\n";
                $header.="X-Mailer: Test script hosting Ukraine.com.ua \r\n";
                $header.="Reply-To: =?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode('Новый заказ')))."?= <$login>\r\n";
                $header.="X-Priority: 3 (Normal)\r\n";
                $header.="Message-ID: <12345654321.".date("YmjHis")."@ukraine.com.ua>\r\n";
                $header.="To: =?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode('Получателю тестового письма')))."?= <$to\r\n";
                $header.="Subject: =?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode('заказ')))."?=\r\n";
                $header.="MIME-Version: 1.0\r\n";
                $header.="Content-Type: text/plain; charset=UTF-8\r\n";
                $header.="Content-Transfer-Encoding: 8bit\r\n";
                $smtp_conn = fsockopen("mail.ukraine.com.ua", 25,$errno, $errstr, 10); //соединяемся с почтовым сервером mail.ukraine.com.ua , порт 25 .
                if(!$smtp_conn) {print "соединение с серверов не прошло"; fclose($smtp_conn); exit;}
                $data = get_data($smtp_conn);
                fputs($smtp_conn,"EHLO mail.ukraine.com.ua\r\n"); // начинаем приветствие.
                $code = substr(get_data($smtp_conn),0,3); // проверяем, не возвратил ли сервер ошибку.
                if($code != 250) {print "ошибка приветсвия EHLO"; fclose($smtp_conn); exit;}
                fputs($smtp_conn,"AUTH LOGIN\r\n"); // начинаем процедуру авторизации.
                $code = substr(get_data($smtp_conn),0,3);
                if($code != 334) {print "сервер не разрешил начать авторизацию"; fclose($smtp_conn); exit;}

                fputs($smtp_conn,base64_encode("$login")."\r\n"); // отправляем серверу логин от почтового ящика (на хостинге "Украина" он совпадает с именем почтового ящика).
                $code = substr(get_data($smtp_conn),0,3);
                if($code != 334) {print "ошибка доступа к такому юзеру"; fclose($smtp_conn); exit;}

                fputs($smtp_conn,base64_encode("$password")."\r\n");       // отправляем серверу пароль.
                $code = substr(get_data($smtp_conn),0,3);
                if($code != 235) {print "неправильный пароль"; fclose($smtp_conn); exit;}

                fputs($smtp_conn,"MAIL FROM:$login\r\n"); // отправляем серверу значение MAIL FROM.
                $code = substr(get_data($smtp_conn),0,3);
                if($code != 250) {print "сервер отказал в команде MAIL FROM"; fclose($smtp_conn); exit;}

                fputs($smtp_conn,"RCPT TO:$to\r\n"); // отправляем серверу адрес получателя.
                $code = substr(get_data($smtp_conn),0,3);
                if($code != 250 AND $code != 251) {print "Сервер не принял команду RCPT TO"; fclose($smtp_conn); exit;}

                fputs($smtp_conn,"DATA\r\n"); // отправляем команду DATA.
                $code = substr(get_data($smtp_conn),0,3);
                if($code != 354) {print "сервер не принял DATA"; fclose($smtp_conn); exit;}

                fputs($smtp_conn,$header."\r\n".$text."\r\n.\r\n"); // отправляем тело письма.
                $code = substr(get_data($smtp_conn),0,3);
                if($code != 250) {print "ошибка отправки письма"; fclose($smtp_conn); exit;}

                fputs($smtp_conn,"QUIT\r\n");   // завершаем отправку командой QUIT.
                fclose($smtp_conn); // закрываем соединение.
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
