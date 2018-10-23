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
                        <a href="#" class="pull-right">Refer a friend</a>
                    </div>
                    <div class="row layer-2">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('user-settings')}}" class="{{ Request::is('user/profile') ? 'active' : '' }}">Profile</a></li>
                            <li><a href="{{route('password-update')}}" class="{{ Request::is('user/account/update-password') ? 'active' : '' }}">Change Password</a></li>
                            <li><a href="{{route('payout')}}" class="{{ Request::is('user/payout') ? 'active' : '' }}">Payment</a></li>
                        </ul>
                    </div>
                    <div class="row layer-3">
                        <div class="details">
                            <span>Welcome Back!</span>
                            <a href="{{route('profile-update')}}" class="active pull-right">Edit</a>
                            <a href="" class="active pull-right">Delete My Account</a>
                        </div>
                    </div>
                    <div class="row layer-4">
                        <div class="col-sm-12 col-md-12 push-up-80 form-theme-1">
                            <section class="row white-bg">

                                <div class="col-xs-12 no-padding">
                                    <h4 class="dark-gray-bg pull-20 ">Password</h4>
                                </div>

                                {!! Form::open(['url'=> action('MyProfile@updatePassword'), 'class'=> 'form-horizontal']) !!}

                                <div class="form-group">
                                    {!! Form::label('oldpass', 'Old Password', ['class'=> 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-6">
                                        <input type="password" name="oldpass" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('newpass', 'New Password', ['class'=> 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-6">
                                        <input type="password" name="newpass" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('repeatpass', 'Repeat New Password', ['class'=> 'col-sm-3 control-label']) !!}
                                    <div class="col-sm-6">
                                        <input type="password" name="repeatpass" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-xs-12 text-center">
                                    {!! Form::submit('Update', ['class'=> 'btn btn-lg btn-common white-text'] ) !!}
                                </div>

                                {!! Form::close() !!}

                            </section>
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
