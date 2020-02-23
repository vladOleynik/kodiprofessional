<div class="panel-group panel-gruop-custom" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <span>Категории</span>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <ul class="post_rubrics">
                    <li><label><input type="{{$type}}" name="parent_id" value="0"
                                      @if(empty($model->parent_id)) checked="checked" @endif>Нет</label></li>
                    @if (count($items) > 0)
                        @foreach($items['tree'] as $item)
                            @include('admin.catalog.categories_rubrics_children', ['item'=>$item, 'model'=>$model, 'category'=>$category])
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
