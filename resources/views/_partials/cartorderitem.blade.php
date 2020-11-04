<ul>
    @foreach($products as $k=>$v)
        <li>
            <div class="product"><a href="{{\App\Helpers\Catalog\Products::buildUrl($v->meta['alias'],$urls[$v->categories[0]->id])}}" class="product-thumb"><img
                        src="{{$v->images[0]}}" alt=""></a>
                <div class="text">
                    <div data-count="1000" class="product-name">{{$v->title}}</div>
                    <div class="product-price">
                        @if($v->old_price)
                            <div class="old-price strike dollar">{{$v->old_price}}</div>
                        @endif
                        <div class="price dollar">@if($v->discount) - {{$v->discount}} %@endif {{$v->price}}</div>
                    </div>
                    <div class="product-count">
                        <div data-max-count="100500" class="count-block -order">
                            <button data-total="{{$v->count * $v->price}}" data-price="{{$v->price}}" data-product_id="{{$v->id}}" class="button-dec"></button>
                            <div class="count">{{$v->count}}</div>
                            <button data-total="{{$v->count * $v->price}}" data-price="{{$v->price}}" data-product_id="{{$v->id}}" class="button-inc"></button>
                        </div>
                    </div>
                    <div  class="product-price-total">
                        <div class="total-{{$v->id}} price dollar">{{$v->count * $v->price}}</div>
                    </div>
                </div>
                <div class="product-delete" data-product_id="{{$v->id}}">
                    <div class="close-icon"></div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
