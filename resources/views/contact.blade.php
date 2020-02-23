@extends('layouts.app')
@section('content')
    <style>
        .sending-contact-section {
            background-image: url(../img/4.jpg);
            background-repeat: no-repeat;
            background-position: center right;
            background-size: auto 100%
        }

        .sending-contact-section .col-md-6 {
            position: static
        }

        @media only screen and (max-width: 1023px) {
            .sending-contact-section {
                background-image: none
            }
        }

    </style>

    <div class="body-site-wrapper">

        <section class="section sending-contact-section">
            <div class="container">
                <div class="sending-block-top">

                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a>Contacts</a></li>
                        </ul>

                    </div>
                </div>
                <h1 style="padding-top: 20px; font-weight: bold" align="center">{!! $txt->contact_title ?? 'Our contacts' !!}</h1>
                <div class="row">
                    <div class="sending-block vca">
                        <div class="col-md-4">
                            <div class="sending-block-text" align="center">
                                <img src="../img/location64.png" alt="" style="padding-bottom: 20px">
                                {!! $txt->contact_block1 ?? '' !!}

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sending-block-text" align="center">
                                <img src="../img/email2.png" alt="" style="padding-bottom: 20px">
                                {!! $txt->contact_block2 ?? '' !!}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
@endsection