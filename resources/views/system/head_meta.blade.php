<meta name="csrf-token" content="{{ csrf_token() }}">
{!!Seo::loadMeta(@$data,@$data->meta)!!}
<title>{{ Seo::meta_title() }}</title>
<meta name="description" content="{{ Seo::meta_description() }}">
<meta name="keywords" content="{{ Seo::meta_keywords() }}">
@if(null!== Seo::robots())
<meta name="robots" content="{{Seo::robots()}}">
@endif
{!!Seo::canonical()!!}