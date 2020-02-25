<?php


namespace App\Helpers;


class OrderHelper
{
    public static function getAmountOrder($order)
    {
        $orderDetails = $order->details;
        $amount = 0;
        foreach ($orderDetails as $orderDetail) {
            $amount += $orderDetail->price * $orderDetail->qty;
        }
        return $amount;
    }

    public static function getUser($order)
    {
        return $order->user;
    }
}