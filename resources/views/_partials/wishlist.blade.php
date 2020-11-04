<ul>
    @foreach($wishlist as $k=>$v)
        <li>
            <div class="product"><a href="{{\App\Helpers\Catalog\Products::buildUrl($v->meta['alias'],$urls[$v->categories[0]->id])}}" class="product-thumb"><img
                            src="{{$v->images[0]}}"
                            alt=""></a>
                <div class="text">
                    <div class="product-name">{{$v->title}}</div>
                    <div class="product-price">
                        @if($v->old_price)
                            <div class="old-price strike dollar">{{$v->old_price}}</div>
                        @endif
                        <div class="price dollar">@if($v->discount) - {{$v->discount}} %@endif {{$v->price}}</div>
                    </div>
                </div>
                <div class="product-delete">
                    <div data-product-id="{{$v->id}}" class="close-icon remove-wishlist"></div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
