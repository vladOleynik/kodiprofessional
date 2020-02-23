@foreach ($children as $entry)
    <li class="dd-item dd3-item {{ $reorderable ? '' : 'dd3-not-reorderable' }}" data-id="{{ $entry->id }}">
        @if ($reorderable)
            <div class="dd-handle dd3-handle"></div>
        @endif
        <div class="dd3-content">
            <span>{{ $entry->{$value} }}</span>

            <div class="pull-right">
                <a class="btn btn-xs btn-{{$entry->published?'success':'danger'}}"
                   href="{{route('admin_showhide', ['model'=>'category','id'=>$entry->id])}}">
                    <i class="glyphicon glyphicon-eye-{{$entry->published?'open':'close'}}"></i>
                </a>
                <?php $controls[0]->setModel($entry);
                $controls[0]->initialize();?>
                {!! $controls[0]->render() !!}

            </div>
        </div>
        @if ($entry->children->count() > 0)
            <ol class="dd-list">
                @include('sleepingowl.display.category_children', ['children' => $entry->children])
            </ol>
        @endif
    </li>
@endforeach
