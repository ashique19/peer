@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <h1 class="section-heading black-text">My Profile</h1>
        
        @if($errors->any())
        @foreach($errors->all() as $error)
        <p class="alert alert-warning">{{$error}}</p>
        @endforeach
        @endif
        
        <div class="row">
            <aside class="col-sm-3 col-xs-12" role="tablist">
                <a class="btn col-xs-12 text-left push-up-10 push-down-10" type="button" href="#profile" aria-controls="home" role="tab" data-toggle="tab"><h5>Modify Profile</h5></a>
                <a class="btn col-xs-12 text-left push-up-10 push-down-10" type="button" href="#change-password" aria-controls="home" role="tab" data-toggle="tab"><h5>Change Password</h5></a>
                <a class="btn col-xs-12 text-left push-up-10 push-down-10" type="button" href="#accounts" aria-controls="home" role="tab" data-toggle="tab"><h5>Payout Details</h5></a>
                <a class="btn col-xs-12 text-left push-up-10 push-down-10" type="button" href="#delete-account" aria-controls="home" role="tab" data-toggle="tab"><h5>Delete Account</h5></a>
            </aside>
            <article class="col-sm-9 col-xs-12 tab-content push-down-30">
                
                <section class="row white-bg tab-pane fade in active" role="tabpanel" id="profile">
            
                    <div class="col-xs-12 no-padding">
                        <h4 class="dark-gray-bg pull-20">My Profile</h4>
                        <img src="@if(strlen(auth()->user()->user_photo) > 0){{auth()->user()->user_photo}} @else /public/img/settings/no-image-available-3.png @endif" alt="profile image" width="150" class="img-responsive col-sm-offset-3 push-down-10">
                    </div>
                    
                    {!! Form::open(['class'=> 'form-horizontal', 'url'=> action('MyProfile@update'), 'enctype'=> 'multipart/form-data' ]) !!}
                    
                    <div class="col-xs-12 col-sm-9 col-sm-offset-3">
                            {!! Form::label('picture', 'Profile image') !!}
                            {!! Form::file('picture', ['class'=> 'file btn blue-bg white-text']) !!}
                    </div>
                    
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
                        {!! Form::text('contact', auth()->user()->contact, ['class'=> 'form-control']) !!}
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
                        {!! Form::label('note', 'About me', ['class'=> 'col-sm-2 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-7">
                        {!! Form::textarea('note', auth()->user()->note, ['class'=> 'form-control', 'row'=>10]) !!}
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-9 col-sm-offset-3">
                        {!! Form::submit('Update Profile', ['class'=> 'btn green-bg white-text']) !!}
                    </div>
                    
                    {!! Form::close() !!}
                    
                </section>
                
                <section class="row white-bg tab-pane fade" role="tabpanel" id="change-password">
                    
                    <div class="col-xs-12 no-padding">
                        <h4 class="dark-gray-bg pull-20">Change Password</h4>
                    </div>
            
                    {!! Form::open(['url'=> action('MyProfile@updatePassword'), 'class'=> 'form-horizontal']) !!}
                    
                    <div class="form-group">
                        {!! Form::label('oldpass', 'Old Password', ['class'=> 'col-sm-3 control-label']) !!}
                        <div class="col-sm-8">
                        <input type="password" name="oldpass" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('newpass', 'New Password', ['class'=> 'col-sm-3 control-label']) !!}
                        <div class="col-sm-8">
                        <input type="password" name="newpass" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('repeatpass', 'Repeat New Password', ['class'=> 'col-sm-3 control-label']) !!}
                        <div class="col-sm-8">
                        <input type="password" name="repeatpass" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-8 col-sm-offset-3">
                        {!! Form::submit('Update Password', ['class'=> 'btn green-bg white-text'] ) !!}
                    </div>
                    
                    {!! Form::close() !!}
                    
                </section>
                
                <section class="row white-bg tab-pane fade" role="tabpanel" id="accounts">
                    
                    <div class="col-xs-12 no-padding">
                        <h4 class="dark-gray-bg pull-20">Payout Details</h4>
                    </div>
                    
                    <p class="alert">
                        ***Please Fill up Paypal or Bank acount details for your offers to be acceptable by you or your buyer/traveler.
                    </p>
            
                    {!! Form::open(['class'=> 'form-horizontal', 'url'=> action('MyProfile@update'), 'enctype'=> 'multipart/form-data' ]) !!}
                    
                    {!! Form::hidden('firstname', auth()->user()->firstname) !!}
                    {!! Form::hidden('lastname', auth()->user()->lastname) !!}
                    
                    <div class="col-xs-12">
                        <h4 class="green-text text-left push-up-50 col-sm-8 col-sm-offset-4 push-down-20">Paypal Details</h4>
                    </div>
                    
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
                    
                    <div class="col-xs-12 hidden">
                        <h4 class="green-text text-left push-up-50 col-sm-8 col-sm-offset-4 push-down-20">Payza Details</h4>
                    </div>
                    
                    <div class="form-group hidden">
                        {!! Form::label('payza_email', 'Payza Email', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::text('payza_email', auth()->user()->payza_email, ['class'=> 'form-control', 'placeholder'=> 'Enter your Payza Email address.' ]) !!}
                        </div>
                    </div>
                    
                    <div class="form-group hidden">
                        {!! Form::label('payza_currency', 'Payout Currency', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::select('payza_currency', ['usd'=> 'USD', 'aud'=> 'AUD', 'gbp'=> 'GBP'], auth()->user()->payza_currency, ['class'=> 'form-control', 'placeholder'=> 'Select your Payout Currency.' ]) !!}
                        </div>
                    </div>
                    
                    <div class="col-xs-12">
                        <h4 class="green-text push-up-50 text-left col-sm-8 col-sm-offset-4 push-down-20">Bank Account Details</h4>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('bank_name', 'Name of the Bank', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::text('bank_name', auth()->user()->bank_name, ['class'=> 'form-control', 'placeholder'=> 'Enter the name of your Bank.' ]) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('bank_branch', 'Name of the Branch', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::text('bank_branch', auth()->user()->bank_branch, ['class'=> 'form-control', 'placeholder'=> 'Enter the name of the Branch.' ]) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('bank_swift_code', 'Swift/Routing code of Bank/Branch', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::text('bank_swift_code', auth()->user()->bank_swift_code, ['class'=> 'form-control', 'placeholder'=> 'Swift code of Bank/Branch.' ]) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('bank_account_number', 'Your bank account number', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::text('bank_account_number', auth()->user()->bank_account_number, ['class'=> 'form-control', 'placeholder'=> 'Your bank account number.' ]) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('bank_account_name', 'Your name at bank', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::text('bank_account_name', auth()->user()->bank_account_name, ['class'=> 'form-control', 'placeholder'=> 'Your name at bank.' ]) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('bank_currency', 'Currency to receive payment at Bank', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::select('bank_currency', ['usd'=> 'USD', 'aud'=> 'AUD', 'gbp'=> 'GBP'], auth()->user()->bank_currency, ['class'=> 'form-control', 'placeholder'=> 'Select your payout Currency.' ]) !!}
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-8 col-sm-offset-4">
                        {!! Form::submit('Update Accounts Details', ['class'=> 'btn green-bg white-text']) !!}
                    </div>
                    
                    {!! Form::close() !!}
                    
                </section>
                
                <section class="row white-bg tab-pane fade" role="tabpanel" id="delete-account">
                    
                    <div class="col-xs-12 no-padding">
                        <h4 class="dark-gray-bg pull-20">Delete My Account</h4>
                    </div>
            
                    {!! Form::open(['class'=> 'form-horizontal', 'url'=> action('AccessController@deactivateMyAccount'), 'method'=> 'POST', 'enctype'=> 'multipart/form-data' ]) !!}
                    
                    <div class="form-group">
                        {!! Form::label('note', 'Please enter your reason to Delete:', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::textarea('note', null, ['class'=> 'form-control', 'row'=>5, 'placeholder'=> 'Reason to Delete.' ]) !!}
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-8 col-sm-offset-4">
                        {!! Form::submit('Delete My Account', ['class'=> 'btn green-bg white-text']) !!}
                    </div>
                    
                    {!! Form::close() !!}
                    
                </section>
                
            </article>
        </div>
                
    </div>
</section>


@stop