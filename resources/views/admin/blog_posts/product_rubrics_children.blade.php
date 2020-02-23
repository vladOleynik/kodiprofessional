
<li @if(count($item['children']) > 0)class="has-ul" @endif>    

     <input @if(is_null($item['parent']))  @endif  type="checkbox" name="category_id[]" value="{{$item['id']}}" @if(count($category) > 0 &&  in_array($item['id'], $category)) checked="checked" @endif>{{$item['title']}}
     
       @if (count($item['children']) > 0)
       <ul>
        @foreach($item['children'] as $item)
        @include('admin.blog_posts.product_rubrics_children', $item)
        @endforeach
    </ul>
    @endif
</li>
