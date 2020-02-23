@extends('layouts.app')
@section('content')
    <div class="body-site-wrapper">
        <section class="section catalogue-section gray-section">
            <div class="container">
                <div class="catalogue-block">
                    <div class="catalogue-block-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="breadcrumbs">
                                    <ul>
                                        <li><a href="/">Home</a></li>
                                        <li><a>Wholesale</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="sort-block">
                                    <div class="select-input">
                                        <select id="sortby" name="sortby">
                                            <option value="0">Minimum Price</option>
                                            <option value="1">Maximum Price</option>
                                            <option value="2">Popular</option>
                                            <option value="3">New</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="catalogue-block-message">
                        <div class="catalogue-block-message-text">
                            <p>Here you can see products with wholesale prices.</p>
                            <p class="light">The minimum order <span class="semibold">shown on the product</span></p>
                        </div>
                        <div class="catalogue-block-message-button">
                            <button class="button">ok</button>
                        </div>
                    </div>
                    <div class="catalogue-block-cards">
                        <div class="row">
                            <div class="cards-wrapper">
                                @foreach($products as $k=>$v)
                                    @include('catalog.item', ['item'=>$v, 'active'=>$urls[$v->categories[0]->id], 'wishlist'=>$wishlist])
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{ $products->links('vendor.pagination.bootstrap-4', ['paginator' => $products]) }}
                </div>
            </div>
        </section>
    </div>
@endsection
