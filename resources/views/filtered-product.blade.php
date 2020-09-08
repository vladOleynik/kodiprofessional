@if($products->count())
    @foreach($products as $product)
        <div class="olrder--list__row">
            <div class="order--list__cell"><input type="checkbox" class="discount-item" name="discountItems[]"
                                                  value="{{$product->id}}">
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
@else
    <div class="olrder--list__row" style="color: darkred">
        продуктов не найдено
    </div>
@endif

