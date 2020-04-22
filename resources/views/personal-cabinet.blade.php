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
                            <div class="order--list__cell">{{$order->payment_status}}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
