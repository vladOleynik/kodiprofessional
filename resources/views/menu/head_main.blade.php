@if (count($items) > 0)
    <ul>
        @foreach($items['tree'] as $item)
            @if(count($item['children']) === 0)
                <li class="root-list"><a href="{{ $items['urls'][$item->meta->data_id]}}">{{$item->title}}</a></li>
            @else
                <li class="menu-item-has-children"><a
                            @if(!$item['children']) href="{{ $items['urls'][$item->meta->data_id]}}" @endif>{{$item->title}}</a>
                    <div class="sub-menu" style="top:10px;">
                        <ul>
                            @foreach($item['children'] as $child)
                                @include('menu.head_childs', $child)
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endif
        @endforeach
        <div style="display: none" id="mobileOptionalMenu">
        <li class="menu-item-has-children"><a href="{{route('shipping')}}">Shipping and Payments</a></li>
        <li class="menu-item-has-children"><a href="{{route('purchase')}}">Purchase returns</a></li>
        <li class="menu-item-has-children"><a href="{{route('contact')}}">Contacts</a></li>
        <li class="menu-item-has-children"><a href="/">Home</a></li>
        @if(auth()->user())
            <li class="menu-item-has-children"><a class="phone" href="{{route('cabinet')}}">My orders</a></li>
        @endif
        @if(auth()->user())
            <li class="menu-item-has-children"><a href="">Welcome, {{auth()->user()->name}}</a></li>
            <li class="menu-item-has-children"><a href="/logout" >Logout</a></li>
        @else
            <li class="menu-item-has-children"><a href="/login">My account</a></li>
        @endif
        </div>
    </ul>
@endif
