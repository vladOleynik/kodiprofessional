<li @if(count($item['children']) > 0)class="has-ul" @endif>
    <label><input @if($item['id'] == $model['id']) disabled @endif type="radio" name="parent_id" value="{{$item['id']}}"
                  @if($item['id']==$category)checked="checked"@endif ></label>{{$item['title']}}
    @if (count($item['children']) > 0)
        <ul>
            @foreach($item['children'] as $item)
                @include('admin.catalog.categories_rubrics_children', $item)
            @endforeach
        </ul>
    @endif
</li>
