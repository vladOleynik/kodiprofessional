@extends('layouts.app')
@section('content')
    <div class="body-site-wrapper">
        <section class="section catalogue-section gray-section">
            <div class="container">
                <div class="catalogue-block">
                    <div class="catalogue-block-top">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="sort-block">
                                    <div class="select-input">
                                        <select id="sortby" name="sortby">
                                            <option class="sortbyoption" value="0">Minimum Price</option>
                                            <option class="sortbyoption" value="1">Maximum Price</option>
                                            <option class="sortbyoption" value="2">Popular</option>
                                            <option class="sortbyoption" value="3">New</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="catalogue-block-search">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="h4 semibold">On request "{{$query}}" found {{$products->total()}} products
                                </div>
                            </div>
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
