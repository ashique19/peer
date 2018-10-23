@extends('public.layouts.layout')
@section('title')Airposted- Signup. @stop
@section('main')

@section('meta')
    <meta name="title" content="Airposted -  sign up">
    <meta name="description" content="Airposted -  sign up">
    <meta name="keywords" content="Airposted, sign up">
@stop

<section class="row login-signup-page">
    <section class="col-xs-12 col-sm-8 col-sm-offset-2">
    
    <h1>Sign up for free today!</h1>
    
    <article class="modal-theme-1 col-sm-6 col-sm-offset-3 push-down-20">
            
        <section class="row text-center">
            <a href="{{action('AccessController@social', 'facebook')}}" class="btn btn-lg btn-block blue-bg white-text">
                SIGN UP WITH FACEBOOK
            </a>
            <p class="text-center or push-up-30 push-down-20"><span>or</span></p>
        </section>
        
        @if($errors->any())
            <div class="col-xs-12">
                <ul>
                    @foreach($errors->all() as $error)
                    
                        <li>{{$error}}</li>
                    
                    @endforeach
                </ul>
            </div>
        @endif
        
        <section class="login-area row">
            {!! Form::open([ 'url'=> action('AccessController@postSignup'), 'method'=>'POST', 'class'=> 'ajax-signup', 'sign-url' => action('AccessController@postAjaxSignup') ]) !!}
            
            <div class="col-xs-12 no-padding">
                {!! Form::text('firstname', old('firstname'), ['class'=> 'form-control', 'placeholder'=> 'First name']) !!}
            </div>
            <div class="col-xs-12 no-padding">
                {!! Form::text('lastname', old('lastname'), ['class'=> 'form-control', 'placeholder'=> 'Last name']) !!}
            </div>
            <div class="col-xs-12 no-padding">
                {!! Form::text('email', old('email'), ['class'=> 'form-control', 'placeholder'=> 'Email']) !!}
            </div>
            <div class="col-xs-12 no-padding">
                <input type="password" name="password" class="form-control" placeholder="Password"/>
                <small class="help-text">Must be alpha-numeric and 8 characters long.</small>
            </div>
            <div class="col-xs-12 no-padding">
                <p class="signup-message"></p>
            </div>
            <div class="col-sm-6 no-padding push-up-20">
                By creating an account, you confirm that you agree with our 
                <a class="blue-text push-up-15" href="{{action('StaticPageController@page', 'terms-of-service')}}" >Terms of Service</a>
            </div>
            
            <div class="col-sm-6 no-padding text-right push-up-20">
                <button type="submit" class="btn btn-lg gray-text gray-border white-bg login-button signup-button">SIGN UP</button>
                <p class="push-up-5">
                    Already have an account? <br /><a href="{{route('login')}}" class="blue-text">Log in here.</a>
                </p>
            </div>
            
            {!! Form::close() !!}
        </section>
        
    </article>
    

</section>
</section>
@stop
