@extends('layouts.app')
@section('content')
    <section class="section thanks-section">
        <div class="thanks-block">
            <div class="h3">{!! $txt->success_title ?? '' !!}</div>
            <div class="h4">{!! $txt->success_text ?? '' !!}</div>
            <a href="/" class="button"> <i class="fa fa-caret-left"></i><span>Go Back Home</span></a>
        </div>
    </section>
@endsection