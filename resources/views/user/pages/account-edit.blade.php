@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        {!! errors($errors) !!}
        
        <div class="col-xs-12 no-padding">
            
            <div class="col-sm-3 col-md-2 no-padding">
                <ul class="user-action-ul">
                    <li class="user-actions active"><a href="{{action('UserAccounts@modify')}}" >Edit Account</a></li>
                    <li class="user-actions"><a href="{{action('UserAccounts@modifyPassword')}}" >Password</a></li>
                    
                    @if(session('user_type') == 'buyer' || session('user_type') == 'traveller')
                    <li class="user-actions"><a href="{{action('UserAccounts@modifyPayoutPreference')}}" >Payout Preference</a></li>
                    @endif
                    
                    <li class="user-actions"><a href="{{action('UserAccounts@deleteAccount')}}" >Delete Account</a></li>
                </ul>
            </div>
            
            <div class="col-sm-9 col-md-10 push-up-80 form-theme-1">
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
                    
                    <div class="col-xs-12 text-center">
                        {!! Form::submit('Update', ['class'=> 'btn btn-lg orange-bg white-text']) !!}
                    </div>
                    
                    {!! Form::close() !!}
                    
                </section>
            </div>
            
        </div>
        
        
        
    </div>
</section>


@stop