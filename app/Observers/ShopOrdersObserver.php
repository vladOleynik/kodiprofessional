<?php

namespace App\Observers;

use App\Models\Shop\Order;

class ShopOrdersObserver
{
    /**
     * Handle the models shop order "created" event.
     *
     * @param \App\Models\Shop\Order $modelsShopOrder
     * @return void
     */
    public function created(Order $modelsShopOrder)
    {
        //
    }

    /**
     * Handle the models shop order "updated" event.
     *
     * @param \App\Models\Shop\Order $modelsShopOrder
     * @return void
     */
    public function updating(Order $modelsShopOrder)
    {
        //2 это id статуса "отправлен"
        if ($modelsShopOrder->status_id == 2){
            $modelsShopOrder->time_set_delivery = now();
        }
    }

    /**
     * Handle the models shop order "deleted" event.
     *
     * @param \App\Models\Shop\Order $modelsShopOrder
     * @return void
     */
    public function deleted(Order $modelsShopOrder)
    {
        //
    }

    /**
     * Handle the models shop order "restored" event.
     *
     * @param \App\Models\Shop\Order $modelsShopOrder
     * @return void
     */
    public function restored(Order $modelsShopOrder)
    {
        //
    }

    /**
     * Handle the models shop order "force deleted" event.
     *
     * @param \App\Models\Shop\Order $modelsShopOrder
     * @return void
     */
    public function forceDeleted(Order $modelsShopOrder)
    {
        //
    }
}
