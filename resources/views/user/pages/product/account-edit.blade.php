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
                            <li><a href="{{route('user-settings')}}" class="{{ Request::is('user-settings') ? 'active' : '' }}">Profile</a></li>
                            <li><a href="{{route('password-update')}}" class="{{ Request::is('password-update') ? 'active' : '' }}">Change Password</a></li>
                            <li><a href="{{route('payout')}}" class="{{ Request::is('payout') ? 'active' : '' }}">Payment</a></li>
                        </ul>
                    </div>
                    <div class="row layer-3">
                        <div class="details">
                            <span>Welcome Back!</span>
                            <a href="{{route('profile-update')}}" class="active pull-right">Edit</a>
                        </div>
                    </div>
                    <div class="row layer-4">
                        <div class="col-sm-12 col-sm-offset-1">

                            {!! errors($errors) !!}

                            <div class="col-xs-12 no-padding">

                                <div class="col-sm-12 col-md-12 push-up-80 form-theme-1">
                                    <section class="row white-bg">

                                        <div class="col-xs-12 no-padding">
                                            <h4 class="dark-gray-bg pull-20 ">Edit Account Settings</h4>
                                        </div>

                                        {!! Form::open(['class'=> 'form-horizontal', 'url'=> action('MyProfile@update'), 'enctype'=> 'multipart/form-data' ]) !!}

                                        <div class="form-group">
                                            {!! Form::label('firstname', 'First name', ['class'=> 'col-sm-2 col-sm-offset-1 control-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::text('firstname', auth()->user()->firstname, ['class'=> 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('lastname', 'Last name', ['class'=> 'col-sm-2 col-sm-offset-1 control-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::text('lastname', auth()->user()->lastname, ['class'=> 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('contact', 'Phone no.', ['class'=> 'col-sm-2 col-sm-offset-1 control-label']) !!}
                                            <div class="col-sm-7">
                                                <div class="row inline">

                                                    @if(auth()->user()->country)
                                                        {!! Form::select('country_code', \App\Country::orderBy('phone_code')->lists('phone_code','phone_code') , auth()->user()->country->phone_code, ['class'=> 'form-control push-up-10 country_code', 'placeholder'=> '-Country code-', 'required'=> 'required']) !!}
                                                        {!! Form::text('phone_no', str_replace(auth()->user()->country->phone_code, '', auth()->user()->contact) , ['class'=> 'form-control push-up-10 phone_no', 'placeholder'=> 'Phone number after country code', 'required'=> 'required']) !!}
                                                    @else
                                                        {!! Form::select('country_code', \App\Country::orderBy('phone_code')->lists('phone_code','phone_code') , null, ['class'=> 'form-control push-up-10 country_code', 'placeholder'=> '-Country code-', 'required'=> 'required']) !!}
                                                        {!! Form::text('phone_no', auth()->user()->contact , ['class'=> 'form-control push-up-10 phone_no', 'placeholder'=> 'Phone number after country code', 'required'=> 'required']) !!}
                                                    @endif



                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('address', 'Address', ['class'=> 'col-sm-2 col-sm-offset-1 control-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::text('address', auth()->user()->address, ['class'=> 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('city', 'City', ['class'=> 'col-sm-2 col-sm-offset-1 control-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::text('city', auth()->user()->city, ['class'=> 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('state', 'State', ['class'=> 'col-sm-2 col-sm-offset-1 control-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::text('state', auth()->user()->state, ['class'=> 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('postcode', 'Zipcode', ['class'=> 'col-sm-2 col-sm-offset-1 control-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::text('postcode', auth()->user()->postcode, ['class'=> 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            {!! Form::label('country', 'Country', ['class'=> 'col-sm-2 col-sm-offset-1 control-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::select('country_id', \App\Country::orderBy('name')->lists('name', 'id'), auth()->user()->country_id, ['class'=> 'form-control select2', 'placeholder'=> '-Select Country-', 'required'=> 'required' ]) !!}
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            {!! Form::label('picture', 'Profile image', ['class'=> 'col-sm-2 col-sm-offset-1 control-label']) !!}
                                            <div class="col-sm-7">
                                                {!! Form::file('picture', ['class'=>'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="col-xs-12 text-center">
                                            {!! Form::submit('Update', ['class'=> 'btn btn-lg btn-common white-text']) !!}
                                        </div>

                                        {!! Form::close() !!}

                                    </section>
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
