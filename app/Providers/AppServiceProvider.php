<?php

namespace App\Providers;

use App\Models\Shop\Order;
use App\Observers\ShopOrdersObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\StaticData\StaticTexts;

class AppServiceProvider extends ServiceProvider
{

    protected $_staticTexts = [];
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootStaticText();
        Order::observe(ShopOrdersObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\Shop\OrderRepositoryInterface', \App\Repositories\Shop\OrderRepository::class);
        $this->app->bind('App\Repositories\Contracts\Shop\OrderStorageRepositoryInterface');
    }

    private function bootStaticText() {

        if (!count($this->_staticTexts)) {
            $txt = StaticTexts::all();

            foreach ($txt as $v) {

                    $this->_staticTexts[$v['alias']] = $v['value'];

            }
        }
        \View::share('txt', (object) $this->_staticTexts);
    }

}
