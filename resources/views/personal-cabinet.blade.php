<?php
use \App\Helpers\Catalog\Products;

?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="main-page-header-img"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="orders--list">
                    <span class="orders--list__title">Orders list</span>
                    <div class="orders--user">
                           <div class="orders--user__photo">
                               <img src="{{asset('img/man.png')}}" alt="">
                           </div>
                           <div class="orders--user__info">
                               <div class="user__info--filed">
                                <span class="field--name">Name: </span>
                                   <span class="field--res">{{Auth::user()->name}}</span>
                               </div>
                               <div class="user__info--filed">
                                   <span class="field--name">E-mail: </span>
                                   <span class="field--res">{{Auth::user()->email}}</span>
                               </div>
                           </div>
                    </div>
                    <div class="order--list__table">
                        <div class="olrder--list__row order--table__header">
                            <div class="order--list__cell">Products list</div>
                            <div class="order--list__cell">Products image</div>
                            <div class="order--list__cell ">Price</div>
                            <div class="order--list__cell ">Quantity</div>
                            <div class="order--list__cell ">Payment Status</div>
                        </div>
                        @foreach($orders as $order)
                        <div class="olrder--list__row">
                            <div class="order--list__cell ">
                                <ul>
                                    @foreach($order->details as $detail)
                                    <li class="item-product">{{optional($detail->product)->title}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="order--list__cell ">
                                <ul>

                                    @foreach($order->details as $detail)
                                        <li>
                                            @if(isset($detail->product->images))
                                                @foreach($detail->product->images as $image)
                                                <img src="{{asset($image)}}" alt="" width="50px">
                                                @endforeach
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="order--list__cell ">
                                <ul>
                                    @foreach($order->details as $detail)
                                        <li class="item-product">{{$detail->price}} $</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="order--list__cell ">
                                <ul>
                                    @foreach($order->details as $detail)
                                        <li class="item-product">{{$detail->qty}} pс.</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="order--list__cell">
                                {{$order->payment_status}}
                                @if($order->payment_status!='Completed')
                                    <form action="https://shop.westernbid.info" method="post">
                                       <input type="hidden" name="wb_hash" value="{{ md5('litvlitantoH`^yPTY' . $order->amountOrder. $order->id) }}">
                                       <input type="hidden" name="wb_login" value="litvlitanto">
                                       <input type="hidden" name="invoice" value="{{$order->id}}">
                                       <input type="hidden" name="amount" value="{{$order->amountOrder}}">
                                       <input type="hidden" name="return" value="https://kodiprofessional.com/pay/return">
                                       <input type="hidden" name="cancel_return" value="https://kodiprofessional.com/pay/fail">
                                       <input type="hidden" name="notify_url" value="https://kodiprofessional.com/pay/success/{{$order->id}}">
                                        <input type="hidden" name="currency_code" value="USD">
                                        @foreach($order->details as $key => $detail)
{{--                                            western bid не принимает названия инпутов с нулем в конце--}}
                                            @php $numberItem  = $key+1 @endphp
                                            <input type="hidden" name="item_name_{{$numberItem}}" value="{{optional($detail->product)->title ?? 'product'.optional($detail->product)->id}}">
                                            <input type="hidden" name="description_{{$numberItem}}" value="{{optional($detail->product)->title ?? 'product'.optional($detail->product)->id}}">
                                            <input type="hidden" name="item_number_{{$numberItem}}" value="{{optional($detail->product)->id}}">
                                            <input type="hidden" name="amount_{{$numberItem}}" value="{{$detail->price}}">
                                            <input type="hidden" name="quantity_{{$numberItem}}" value="{{$detail->qty}}">
                                            <input type="hidden" name="url_{{$numberItem}}" value="{{Products::buildUrl(optional($detail->product)->meta['alias'], optional($detail->product)->categories[0] ? optional($detail->product)->categories[0]->id : 0)}}">
                                        @endforeach
                                        <input type="submit"  class="btn btn-primary" value="Pay">
                                    </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
