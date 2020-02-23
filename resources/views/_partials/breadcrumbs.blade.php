@if ($breadcrumbs)
	<ul>
		@foreach ($breadcrumbs as $breadcrumb)
				<li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
		@endforeach
	</ul>
@endif
