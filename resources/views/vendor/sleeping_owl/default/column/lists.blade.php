@foreach ($values as $value)
<span class="label label-info"><a href="?rubric={{$value->id}}">{{ $value->title }}</a></span>
@endforeach

{!! $append !!}