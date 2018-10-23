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
                    <li class="user-actions"><a href="{{action('UserAccounts@modify')}}" >Edit Account</a></li>
                    <li class="user-actions"><a href="{{action('UserAccounts@modifyPassword')}}" >Password</a></li>
                    @if(session('user_type') == 'buyer' || session('user_type') == 'traveller')
                    <li class="user-actions active"><a href="{{action('UserAccounts@modifyPayoutPreference')}}" >Payout Preference</a></li>
                    @endif
                    <li class="user-actions"><a href="{{action('UserAccounts@deleteAccount')}}" >Delete Account</a></li>
                </ul>
            </div>
            
            <div class="col-sm-9 col-md-10 push-up-80 form-theme-1">
                <section class="row white-bg">
            
                    <div class="col-xs-12 no-padding">
                        <h4 class="dark-gray-bg pull-20 ">Payout Preference</h4>
                    </div>
                    
                    <p class="panel-body">
                        <i>
                        Please enter the email you wish to use for your offers to be acceptable by you and your buyer/traveler. 
                        You can securely pay on Airposted through PayPal and international debit/credit cards.
                        </i>
                    </p>
                    
                    {!! Form::open(['class'=> 'form-horizontal', 'url'=> action('MyProfile@update'), 'enctype'=> 'multipart/form-data' ]) !!}
                    
                    {!! Form::hidden('firstname', auth()->user()->firstname) !!}
                    {!! Form::hidden('lastname', auth()->user()->lastname) !!}
                    
                    @if(auth()->user()->country)
                    {!! Form::select('country_code', \App\Country::orderBy('phone_code')->lists('phone_code','phone_code') , auth()->user()->country->phone_code, ['class'=> 'form-control push-up-10 country_code hidden', 'placeholder'=> '-Country code-', 'required'=> 'required']) !!}
                    {!! Form::text('phone_no', str_replace(auth()->user()->country->phone_code, '', auth()->user()->contact) , ['class'=> 'form-control push-up-10 phone_no hidden', 'placeholder'=> 'Phone number after country code', 'required'=> 'required']) !!}
                    @else
                    {!! Form::select('country_code', \App\Country::orderBy('phone_code')->lists('phone_code','phone_code') , null, ['class'=> 'form-control push-up-10 country_code hidden', 'placeholder'=> '-Country code-', 'required'=> 'required']) !!}
                    {!! Form::text('phone_no', ' ' , ['class'=> 'form-control push-up-10 phone_no hidden', 'placeholder'=> 'Phone number after country code', 'required'=> 'required']) !!}
                    @endif
                    
                    <h2 class="text-center ">PayPal Information</h2>
                                        
                    <div class="form-group">
                        {!! Form::label('paypal_email', 'Paypal Email', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::text('paypal_email', auth()->user()->paypal_email, ['class'=> 'form-control', 'placeholder'=> 'Enter your Paypal Email address.' ]) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('paypal_currency', 'Payout Currency', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::select('paypal_currency', ['usd'=> 'USD', 'aud'=> 'AUD', 'gbp'=> 'GBP'], auth()->user()->paypal_currency, ['class'=> 'form-control', 'placeholder'=> 'Select your Payout Currency.' ]) !!}
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