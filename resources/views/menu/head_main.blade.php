@if (count($items) > 0)
    <ul>
        @foreach($items['tree'] as $item)
            @if(count($item['children']) === 0)
                <li><a href="{{ $items['urls'][$item->meta->data_id]}}">{{$item->title}}</a></li>
            @else
                <li class="menu-item-has-children"><a @if(!$item['children']) href="{{ $items['urls'][$item->meta->data_id]}}" @endif>{{$item->title}}</a>
                    <div class="sub-menu">
                        <ul>
                            @foreach($item['children'] as $child)
                                @include('menu.head_childs', $child)
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
@endif
