@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Payout @stop
@section('main')

    <div class="wrapper payment-confirmation">
        @include('user.pages.product.sidebar')

        <div id="content">
            @include('user.pages.product.header')
            <div class="container-fluid travel setting-payment">
                <div class="col-md-12">
                    <div class="row layer-1">
                        <a href="#" class="pull-left">My Settings</a>
                        <a href="#" class="pull-right">Refer a friend</a>
                    </div>

                    @if(Session::has('msg'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('msg') }}</p>
                    @endif
                    <div class="row layer-2">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('user-settings')}}" class="{{ Request::is('user/profile') ? 'active' : '' }}">Profile</a></li>
                            <li><a href="{{route('password-update')}}" class="{{ Request::is('user/account/update-password') ? 'active' : '' }}">Change Password</a></li>
                            <li><a href="{{route('payout')}}" class="{{ Request::is('user/payout') ? 'active' : '' }}">Payment</a></li>
                        </ul>
                    </div>

                    <div class="row board">
                        <div class="layer-3">
                            <span>Traveller Board</span>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="content left">
                                    <div class="col-md-6">
                                        <span>Pending Amount</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span class="dollar"><b>BDT {{$pending_price}}</b></span>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="content right">
                                    <div class="col-md-4">
                                        <span>Available Amount</span>
                                    </div>
                                    <div class="col-md-4">
                                        <span class="dollar"> <b>BDT {{$available_amount}}</b> </span>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a href="{{route('withdraw-payment')}}" class="btn btn-common btn-round payout">Pay Out</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row board">
                        <div class="layer-3">
                            <span>Buyer Board </span>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="content left">
                                    <div class="col-md-6">
                                        <span>Purchased Amount</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span class="dollar"><b>BDT {{$purchasedAmount}}</b></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="content right">
                                    <div class="col-md-4">
                                        <span>XXXXX Amount</span>
                                    </div>
                                    <div class="col-md-4">
                                        {{--<span class="dollar"> <b>BDT 0</b> </span>--}}
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a href="#" class="btn btn-common btn-round payout">Contact</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{--<div class="row">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<p><b>General Setting</b></p>--}}
                            {{--<div class="details  layer-3">--}}
                                {{--<span>Payment Action</span>--}}
                                {{--<a href="#" class="active pull-right">Cancel</a>--}}
                                {{--<a href="#" class="active pull-right">Save</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                    {{--<div class="row final-layer">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<div class="row">--}}
                                {{--<div class="content">--}}
                                    {{--<div class="col-md-3 left">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="card">--}}
                                                {{--<div class="col-md-2">--}}
                                                    {{--<img src="{{asset('public/img/peerposted/images/card.svg')}}" class="img-responsive card-icon">--}}
                                                {{--</div>--}}
                                                {{--<div class="col-md-6">--}}
                                                    {{--<img src="{{asset('public/img/peerposted/images/demo.jpg')}}" class="img-responsive card-type">--}}
                                                    {{--<img src="{{asset('public/img/peerposted/images/demo.jpg')}}" class="img-responsive card-type">--}}
                                                    {{--<img src="{{asset('public/img/peerposted/images/demo.jpg')}}" class="img-responsive card-type">--}}
                                                {{--</div>--}}


                                            {{--</div>--}}

                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4 center">--}}
                                        {{--<div class="middle text-center">--}}
                                            {{--<h3>...XXXX 4589</h3>--}}
                                            {{--<a href="#" class="btn btn-common btn-same"> Edit</a>--}}
                                            {{--<a href="#" class="btn btn-common btn-same"> Remove</a>--}}
                                        {{--</div>--}}
                                        {{--<div class="middle text-center">--}}
                                            {{--<h3>...XXXX 4589</h3>--}}
                                            {{--<a href="#" class="btn btn-common btn-same"> Edit</a>--}}
                                            {{--<a href="#" class="btn btn-common btn-same"> Remove</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-5 text-right right">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-9">--}}
                                                {{--<input class="form-control" type="text" name="no" placeholder="XXXX-XXXX-XXXX-4321" maxlength="16">--}}
                                            {{--</div>--}}

                                        {{--</div>--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-6">--}}
                                                {{--<input class="form-control" type="text" name="date" placeholder="MM/YY" maxlength="5">--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-3">--}}
                                                {{--<input class="form-control" type="text" name="ccv" placeholder="CCV" maxlength="3">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="col-md-9 text-left" >--}}
                                                {{--<input type="checkbox" name="">--}}
                                                {{--<label>Primary Card</label>--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-9 text-center" >--}}
                                                {{--<a href="#" class="btn btn-common btn-round">Add New Card</a>--}}
                                            {{--</div>--}}

                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')
    <script >
        $(document).ready(function(){

        })
    </script>
    <script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/travel.css') }}">
@endsection
