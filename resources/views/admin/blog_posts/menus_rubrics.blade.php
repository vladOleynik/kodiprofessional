<div class="panel-group panel-gruop-custom" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    @if($showRoot)
                    Родительская категория
                    @else
                    Рубрики
                    @endif
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <ul class="post_rubrics">
                    @if($showRoot)
                    <li><label><input type="{{$type}}" name="parent_id" value="0" @if(!isset($category)) checked="checked" @endif>Нет</label></li>
                    @endif                   
                    @if (count($items) > 0)
                    @foreach($items as $item)
                    @include('admin.blog_posts.menus_rubrics_children', ['item'=>$item, 'model'=>$model, 'category'=>$category??null, 'blockType'=>$blockType ?? null])
                    @endforeach
                    @endif


                </ul>
            </div>
        </div>
    </div>
</div>