<ul>
    @if($products)
        @foreach($products as $k=>$v)
            <li>
                <div class="product"><a
                        href="{{\App\Helpers\Catalog\Products::buildUrl($v->meta['alias'],$urls[$v->categories[0]->id])}}"
                        class="product-thumb">
                        <img src="{{$v->images[0]}}"
                             alt=""></a>
                    <div class="text">
                        <div class="product-name">{{$v->title}}</div>
                        <div class="product-count">
                            <div data-max-count="100500" class="count-block -cart">
                                <button data-price="{{$v->price}}" data-product_id="{{$v->id}}"  class="button-dec"></button>
                                <div  class="count">{{$v->count}}</div>
                                <button data-price="{{$v->price}}" data-product_id="{{$v->id}}" class="button-inc"></button>
                            </div>
                        </div>
                        <div class="product-price">
                            @if($v->old_price)
                                <div class="old-price strike dollar">{{$v->old_price}}</div>
                            @endif
                            <div class="price dollar">{{$v->price}}</div>
                        </div>
                    </div>
                    <div class="product-delete" data-product_id="{{$v->id}}">
                        <div class="close-icon"></div>
                    </div>
                </div>
            </li>
        @endforeach
    @endif
</ul>
