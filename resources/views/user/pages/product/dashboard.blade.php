@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Dashboard @stop
@section('main')

    <div class="wrapper payment-confirmation">
        @include('user.pages.product.sidebar')

        <div id="content">
            @include('user.pages.product.header')
            <div class="container-fluid dashboard">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-warning col-md-12">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row">
                    <div class="content">
                        <div class="col-md-6">
                            <h1>What do you want to do?</h1>
                        </div>
                        <div class="col-md-6">
                            <nav class='menu'>
                                <input checked='checked' class='menu-toggler' id='menu-toggler' type='checkbox'>
                                <!-- <label for='menu-toggler'></label> -->
                                <ul>
                                    <li class='menu-item'>
                                        <a href='{{route('traveller-checkout')}}' title="Travel" > <img class="img-responsive" src="{{asset('public/img/peerposted/images/dashboard/travel.svg')}}" > </a>
                                    </li>
                                    <li class='menu-item'>
                                        <a href='#' title="Confirmation"> <img class="img-responsive" src="{{asset('public/img/peerposted/images/dashboard/confirmation.svg')}}" > </a>
                                    </li>
                                    <li class='menu-item'>
                                        <a href='{{route('my-travels')}}' title="My Travel"> <img class="img-responsive" src="{{asset('public/img/peerposted/images/dashboard/my_travel.svg')}}" > </a>
                                    </li>
                                    <li class='menu-item'>
                                        <a href='{{route('buyer-search')}}' title="Request"> <img class="img-responsive" src="{{asset('public/img/peerposted/images/dashboard/request.svg')}}" > </a>
                                    </li>
                                    <li class='menu-item'>
                                        <a href='{{route('checkout')}}' title="Orders"> <img class="img-responsive" src="{{asset('public/img/peerposted/images/dashboard/orders.svg')}}" > </a>
                                    </li>
                                    <li class='menu-item'>
                                        <a href='{{route('product-lists')}}' title="Buy"> <img class="img-responsive" src="{{asset('public/img/peerposted/images/dashboard/buy.svg')}}" > </a>
                                    </li>
                                    <li class='menu-item'>
                                        <a href='#' > <img class="img-responsive" src="{{asset('public/img/peerposted/images/dashboard/ship.svg')}}" > </a>
                                    </li>
                                    <li class='menu-item'>
                                        <a href='#' > <img class="img-responsive" src="{{asset('public/img/peerposted/images/dashboard/company.svg')}}" > </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
@section('js')
    <script >
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip()

        })
    </script>
    <script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/dashboard.css') }}">
@endsection
