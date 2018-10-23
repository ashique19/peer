@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Dashboard @stop
@section('main')

    <div class="wrapper payment-confirmation">
        @include('user.pages.product.sidebar')

        <div id="content">
            @include('user.pages.product.header')
            <div class="container-fluid setting travel">
                <div class="col-md-12">
                    <div class="row layer-1">
                        <a href="#" class="pull-left">My Settings</a>
                    </div>
                    <div class="row layer-2">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('user-settings')}}" class="{{ Request::is('user/profile') ? 'active' : '' }}">Profile</a></li>
                            <li><a href="{{route('password-update')}}" class="{{ Request::is('user/account/update-password') ? 'active' : '' }}">Change Password</a></li>
                            <li><a href="{{route('payout')}}" class="{{ Request::is('user/payout') ? 'active' : '' }}">Payment</a></li>
                        </ul>
                    </div>
                    <div class="row layer-3">
                        <div class="details text-warning pull-10">
                            <b>Welcome Back! {{$user->name}}</b>
                            <a href="{{route('profile-update')}}" class="active pull-right">Edit</a>
                        </div>
                    </div>
                    <div class="row layer-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <figure>
                                            <img width="100" src="{{ strlen(auth()->user()->user_photo) > 5 ? auth()->user()->user_photo : asset('public/img/peerposted/images/user.jpg')}}" class="img-responsive">
                                        </figure>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <table class="table table-responsive table-bordered table-striped" >
                                            <tr>
                                                <td style="width: 100px;"><span class="push-up-5 push-down-5">Name</span></td>
                                                <td><span class="push-up-5 push-down-5">{{$user->name}}</span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="push-up-5 push-down-5">Location</span></td>
                                                <td><span class="push-up-5 push-down-5">{{$user->address}}, {{$user->city}}</span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="push-up-5 push-down-5">Gender</span></td>
                                                <td><span class="push-up-5 push-down-5">Male</span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="push-up-5 push-down-5">About Me</span></td>
                                                <td><span class="push-up-5 push-down-5">Florida, USA</span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="push-up-5 push-down-5">Registered</span></td>
                                                <td><span class="push-up-5 push-down-5">{{$user->created_at->format('d-m-Y')}}</span></td>
                                            </tr>
                                        </table>
                                    </div><!-- /.row -->
                                    <div class="col-xs-12 col-sm-6">
                                        <table class="table table-responsive table-bordered table-striped" >
                                            <tr>
                                                <td rowspan="6"><img class="img-responsive location-img" src="{{asset('public/img/peerposted/images/location.svg')}}"></td>
                                                <td><span class="push-up-5 push-down-5">Address</span></td>
                                                <td><span class="push-up-5 push-down-5">{{$user->address}}</span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="push-up-5 push-down-5">City</span></td>
                                                <td><span class="push-up-5 push-down-5">{{$user->city}}</span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="push-up-5 push-down-5">State</span></td>
                                                <td><span class="push-up-5 push-down-5">{{$user->state}}</span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="push-up-5 push-down-5">Zipcode</span></td>
                                                <td><span class="push-up-5 push-down-5">{{$user->postcode}}</span></td>
                                            </tr>
                                            <tr>
                                                <td><span class="push-up-5 push-down-5">Country</span></td>
                                                <td><span class="push-up-5 push-down-5">{{($user->country) ? $user->country->name : ''}}</span></td>
                                            </tr>
                                        </table>
                                    </div><!-- /.row -->
                                </div>

                            </div>

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

        })
    </script>
    <script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/product/travel.css') }}">
@endsection
