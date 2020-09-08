<div class="col-md-3">
    <div data-id="3"
         @if(isset($item->sale)) data-min-order="{{$txt->wholesale_text}}" @endif class="card">
        <a href="{{\App\Helpers\Catalog\Products::buildUrl($item->meta['alias'],$active)}}" class="img">
            <img src="{{$item['images'][0] ?? ''}}" alt=""></a>
        <button data-product_id="{{$item->id}}" class="@if(in_array($item->id,$wishlist)) -added @endif wish-{{$item->id}} button-add-to-favorites -small">
            @if(in_array($item->id,$wishlist))remove from favorites @else add to favorites @endif</button>
        <div class="card-name h5">{{$item->title}}</div>
        <div class="card-bottom">
            <div class="card-prices">
               @if($item->old_price)
                    <div class="old-price strike accent dollar">{{$item->old_price}}</div>
               @endif
                <div class="price dollar">{{$item->price}}</div>
            </div>
            <div class="card-buttons">
                <a href="{{\App\Helpers\Catalog\Products::buildUrl($item->meta['alias'],$active)}}" class="card-button button-view">View</a>
                <a href="" data-product_id="{{$item->id}}" class="card-button button-buy">Buy</a>
            </div>
        </div>
    </div>
</div>
