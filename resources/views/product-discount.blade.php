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
                    <span class="orders--list__title">Product Discount</span>
                    <input type="number" id="countDiscount" placeholder="Введите скидку %"
                           style="border: 1px solid black; border-radius: 5px" value="{{session('discount')}}"><br>
                    <input type="button" value="Сохранить скидку" id="saveDiscountAmount"><br><br>
                    <hr>
                    <span>Начните писать название продукта для поиска</span><br><br>
                    <input type="text" id="findProduct" placeholder="Поле ввода имени продукта для поиска"  style="border: 1px solid black; border-radius: 5px">
                    <hr>
                    <div class="orders--user">
                        <div class="orders--user__info">
                            <input type="button" id="applyDiscount" value="Применить скидку к выбранным товарам"><br>
                            <input type="button" id="removeDiscount" value="Отменить скидку у выбранных товаров"><br>
                        </div>
                    </div>
                    <div class="order--list__table">
                        <div class="olrder--list__row order--table__header">
                            <div class="order--list__cell">Выбрать все элементы на этой странице:
                                <input type="checkbox" id="chekAllItems">
                            </div>
                            <div class="order--list__cell">Product name</div>
                            <div class="order--list__cell">Products image</div>
                            <div class="order--list__cell ">Price</div>
                            <div class="order--list__cell ">Discount</div>
                        </div>
                        <form action="#" id="inputsForDiscount">
                            @foreach($products as $product)
                                <div class="olrder--list__row">
                                    <div class="order--list__cell"><input type="checkbox" class="discount-item" name="discountItems[]" value="{{$product->id}}">
                                    </div>
                                    <div class="order--list__cell">
                                        {{$product->title}}
                                    </div>
                                    <div class="order--list__cell ">
                                        @if(isset($product->images))
                                            @foreach($product->images as $image)
                                                <img src="{{asset($image)}}" alt="" width="50px">
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="order--list__cell ">
                                        {{$product->price}}
                                    </div>
                                    <div class="order--list__cell ">
                                        @if($product->discount)
                                            {{$product->discount}} %
                                        @else
                                            Скидка не установлена
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                                {{ $products->links() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

