@if(count($child['children']) === 0)
    <li><a href="{{ $items['urls'][$child->meta->data_id]}}">{{$child->title}}</a></li>
@else
    <li class="menu-item-has-children"><a @if(!$child['children']) href="{{ $items['urls'][$child->meta->data_id]}}" @endif>{{$child->title}}</a>
        <div class="sub-menu">
            <ul>
                @foreach($child['children'] as $child)
                    @include('menu.head_childs', $child)
                @endforeach
            </ul>
        </div>
    </li>
@endif
