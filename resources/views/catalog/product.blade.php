@extends('layouts.app')
@section('content')
    <div class="body-site-wrapper">
        <section class="section single-section gray-section">
            <div class="container">
                <div class="single-block">
                    <div class="single-block-top">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="breadcrumbs">
                                    <ul>
                                        {!! Breadcrumbs::render('catalog') !!}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-block-main">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="single-block-main-thumb">
                                    <div class="img"><img src="{{$data['images'][0]}}" alt="thumb"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="single-block-main-info">
                                    <div class="text card-info">
                                        <div class="h3 semibold card-info-name">{{$data->title}}</div>
                                        <p class="card-info-sending">Fast worldwide shipping</p>
                                        <div class="h6 card-info-sending-desc">Free and fast international shipping
                                            anywhere in the world
                                        </div>
                                        <button data-product_id="{{$data->id}}" class="@if(in_array($data->id,$wishlist)) -added @endif  wish-{{$data->id}} button-add-to-favorites -big">
                                            @if(in_array($data->id,$wishlist))remove from favorites @else add to favorites @endif</button>
                                        <div class="h3 card-info-price dollar">{{$data->price}}</div>
                                        @if($data->old_price)
                                            @if($data->discount) - {{$data->discount}} %@endif
                                            <p class="card-info-price-regular strike dollar">{{$data->old_price}}</p>
                                        @endif
                                        <div data-max-count="1000" class="count-block -single">
                                            <button class="button-dec"></button>
                                            <div class="count cart-count">1</div>
                                            <button class="button-inc"></button>
                                        </div>
                                        <a href="" data-product_id="{{$data->id}}" data-href="{{route('shop.cart.order')}}"
                                           class="button card-info-button-cart">add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-block-desc">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="single-block-desc-header">
                                    <p>Description</p>
                                </div>
                                <div class="single-block-desc-content">
                                    {!!  $data->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-block-similar">
                        <div class="single-block-similar-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="fz45 semibold block-underline">Similar <span>products</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="single-block-similar-content">
                            <div class="row">
                                <div class="cards-wrapper">
                                    @foreach($similar as $k=>$v)
                                        @include('catalog.item', ['item'=>$v, 'active'=>$urls[$v->categories[0]->id], 'wishlist'=>$wishlist])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


@endsection
