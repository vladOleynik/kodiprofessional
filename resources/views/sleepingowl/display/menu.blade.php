<div class="panel panel-default">
    <div class="panel-heading">
        @if ($creatable)
        <a class="btn btn-primary" href="{{ $createUrl }}">
            <i class="fa fa-plus"></i> @lang('sleeping_owl::lang.table.new-entry')
        </a>
        @endif
    </div>

    
  <div class="panel-body-titles">
            <div>Заголовок</div>
  </div>
    <div class="panel-body">
        <div class="dd nestable" data-url="{{ $url }}/reorder">
            <ol class="dd-list">
                @include('sleepingowl.display.menu_children', ['children' => $items])
            </ol>
        </div>
        <div id='productTable'></div>
    </div>
</div>

