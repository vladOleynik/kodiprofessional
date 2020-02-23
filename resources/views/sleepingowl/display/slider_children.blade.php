
@foreach ($children as $entry)

<li class="dd-item dd3-item {{ $reorderable ? '' : 'dd3-not-reorderable' }} " data-id="{{ $entry->id }}">
    @if ($reorderable)
    <div class="dd-handle dd3-handle"></div>
    @endif
     
    <div class="dd3-content" style="height: 60px">
            
        <img class="images" style='max-width:60px' src="/{{ $entry->path }}" alt="">
        <span> </span>
        <div class="pull-right">

            <a class="btn btn-xs btn-{{$entry->published?'success':'danger'}}" href="{{route('admin_showhide', ['model'=>'slider','id'=>$entry->id])}}">
                <i class="glyphicon glyphicon-eye-{{$entry->published?'open':'close'}}"></i>
            </a>
            @foreach ($controls as $control)

            @if($control instanceof \SleepingOwl\Admin\Contracts\Display\ColumnInterface)
            <?php $control->setModel($entry); ?><?php
            $control->initialize();
            ?>
            @endif

            {!! $control->render() !!}
            @endforeach
        </div>
    </div>
  
</li>
@endforeach
