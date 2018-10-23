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
                    <li class="user-actions active"><a href="{{action('UserAccounts@modifyPassword')}}" >Password</a></li>
                    @if(session('user_type') == 'buyer' || session('user_type') == 'traveller')
                    <li class="user-actions"><a href="{{action('UserAccounts@modifyPayoutPreference')}}" >Payout Preference</a></li>
                    @endif
                    <li class="user-actions"><a href="{{action('UserAccounts@deleteAccount')}}" >Delete Account</a></li>
                </ul>
            </div>
            
            <div class="col-sm-9 col-md-10 push-up-80 form-theme-1">
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
                        {!! Form::submit('Update', ['class'=> 'btn btn-lg orange-bg white-text'] ) !!}
                    </div>
                    
                    {!! Form::close() !!}
                    
                </section>
            </div>
            
        </div>
        
        
        
    </div>
</section>


@stop