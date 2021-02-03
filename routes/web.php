<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index')->name('index');

Route::get('logout', function () {
    \Auth::logout();
    return redirect('/');
})->name('profile.logout');

Auth::routes();


Route::paginate('search', 'SearchController@index')->name('search');
Route::get('shipping', 'StaticPagesController@shipping')->name('shipping');
Route::get('purchase', 'StaticPagesController@purchase')->name('purchase');
Route::paginate('wholesale', 'StaticPagesController@wholesale')->name('wholesale');
Route::post("generatewishlist", "WelcomeController@wishlist")->name('wishlist.get');
Route::post('formsend', "FormController@store")->name('form.save');
Route::get('/contacts', 'StaticPagesController@contact')->name('contact');
Route::get('/google-merchant.xml', 'HomeController@feed')->name('xml.feed');
Route::get('/google-merchant-2.xml', 'HomeController@feed2')->name('xml.feed2');
Route::get('/google-merchant-3.xml', 'HomeController@feed3')->name('xml.feed3');
Route::get('/personal-cabinet', 'PersonalCabinet\IndexController@index')->name('cabinet')->middleware('auth');
Route::get('/product-discount', 'ProductDiscount@getListProducts')->middleware('auth','admin');
Route::get('/get-disk-size', 'PersonalCabinet\IndexController@size')->middleware('auth','admin');
Route::get('/get-last-backup', 'PersonalCabinet\IndexController@backup')->middleware('auth','admin');
Route::post('/save-discount', 'ProductDiscount@saveDiscount')->middleware('auth','admin')->name('saveDiscount');
Route::post('/find-product', 'ProductDiscount@getProductByTitle')->middleware('auth','admin');
Route::post('/save-dicsount', 'ProductDiscount@setDiscount')->middleware('auth','admin');
Route::post('/remove-dicsount', 'ProductDiscount@setDiscount')->middleware('auth','admin');
Route::get('/export', 'WelcomeController@export')->middleware('auth','admin');
Route::group(['prefix' => 'shop'], function() {
    Route::post('cart/add', 'Shop\Cart@add')->name('shop.cart.add');
    Route::post('cart/delete', 'Shop\Cart@delete')->name('shop.cart.delete');
    Route::post('cart', 'Shop\Cart@reload')->name('shop.cart');
    Route::get('cart/count', 'Shop\Cart@count')->name('shop.cart.count');
    Route::post('cart/remove', 'Shop\Cart@remove')->name('shop.cart.remove');
    Route::post('cart/order', 'Shop\Cart@order')->name('shop.cart.order');
    Route::post('cart/order/pay/', 'Shop\Cart@pay')->name('shop.cart.pay');

});

Route::get('/pay/fail', 'StaticPagesController@payFail')->name('pay.fail');
Route::get('/pay/return', 'StaticPagesController@payReturn')->name('pay.return');
Route::post('/pay/success/{order}', 'StaticPagesController@paySuccess')->name('pay.success');

$regex = '/^\/' . \Config::get('sleeping_owl.url_prefix') . '(.*)/';
if (!preg_match($regex, request()->server->get('REQUEST_URI'))) {

    Route::paginate('{any?}', '\App\Http\Call@url')->where('any', '.*(?=.page)|.*');

}

