<li @if(count($item['children']) > 0)class="has-ul" @endif>    
     @if($blockType=='post')
     <input type="radio" name="parent_id" value="{{$item['id']}}" @if($item['data_id']==$category)checked="checked"@endif >{{$item['title']}}
     @else
     <input type="radio" name="parent_id" value="{{$item['id']}}" @if($item['data_id']==$model->parent_id)checked="checked"@endif @if($item['id']==$model->id)disabled="disabled"@endif>{{$item['title']}}
       @endif
       @if (count($item['children']) > 0)
       <ul>
        @foreach($item['children'] as $item)
        @include('admin.blog_posts.menus_rubrics_children', $item)
        @endforeach
    </ul>
    @endif
</li>
