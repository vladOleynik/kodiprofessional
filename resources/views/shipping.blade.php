@extends('layouts.app')
@section('content')
    <div class="body-site-wrapper">
        <section class="section sending-section gray-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="sending-block vca">
                            <div class="sending-block-top">
                                <div class="breadcrumbs">
                                    <ul>
                                        <li><a href="/">Home</a></li>
                                        <li><a>{{ $data->title}}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sending-block-text">
                                    <!-- <div class="h4 semibold ttu">{!!  $txt->shipping_text ?? '' !!}</div> -->
                                {!! $data->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
