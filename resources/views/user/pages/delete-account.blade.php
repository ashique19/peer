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
                    <li class="user-actions"><a href="{{action('UserAccounts@modifyPayoutPreference')}}" >Payout Preference</a></li>
                    @endif
                    <li class="user-actions active"><a href="{{action('UserAccounts@deleteAccount')}}" >Delete Account</a></li>
                </ul>
            </div>
            
            <div class="col-sm-9 col-md-10 push-up-80 form-theme-1">
                <section class="row white-bg">
            
                    <div class="col-xs-12 no-padding">
                        <h4 class="dark-gray-bg pull-20 ">Delete Account</h4>
                    </div>
                    
                    {!! Form::open(['class'=> 'form-horizontal', 'url'=> action('AccessController@deactivateMyAccount'), 'method'=> 'POST', 'enctype'=> 'multipart/form-data' ]) !!}
                    
                    <div class="form-group">
                        {!! Form::label('note', 'Enter reason for deleting', ['class'=> 'col-sm-3 col-sm-offset-1 control-label']) !!}
                        <div class="col-sm-6">
                        {!! Form::textarea('note', null, ['class'=> 'form-control' ]) !!}
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-8 col-sm-offset-4">
                        {!! Form::submit('Delete Account', ['class'=> 'btn btn-lg orange-bg white-text']) !!}
                    </div>
                    
                    {!! Form::close() !!}
                    
                </section>
            </div>
            
        </div>
        
        
        
    </div>
</section>


@stop