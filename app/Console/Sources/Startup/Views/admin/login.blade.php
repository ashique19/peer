@extends('public.layouts.layout')
@section('title')@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif- Login is easy. @stop
@section('main')

<section class="col-xs-12 col-sm-8 main-body">
    
    <div class="panel panel-default"></div>
    
    <div class="panel panel-default">
        <h2 class="page-title"><center>Login</center></h2>
        @if($errors->any())
            <div class="col-xs-12">
                <hr>
                <h3>
                    <ul class="container">
                        @foreach($errors->all() as $error)
                        
                            <li>{{$error}}</li>
                        
                        @endforeach
                    </ul>
                </h3>
            </div>
        @endif
    </div>
    
    <div class="login-container">
        
        
        
        <div class="login-box animated fadeInDown">
            
            <div class="login-body accordion">
                
                <form action="{{action('AccessController@postLogin')}}" class="form-horizontal" method="post">
                    <u><h4>Login via:</h4></u>
                    {!! csrf_field() !!}
                
                <div class="form-group">
                    <div class="col-xs-12">
                        <a href="{{action('AccessController@social', 'facebook')}}" class="btn btn-info btn-block"><i class="fa fa-facebook"></i> Facebook</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <a href="{{action('AccessController@social', 'google')}}" class="btn btn-info btn-block"><i class="fa fa-google"></i> Google</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <a href="{{action('AccessController@social', 'github')}}" class="btn btn-info btn-block"><i class="fa fa-github"></i> Github</a>
                    </div>
                </div>
                <hr>
                <hr>
                <div class="form-group">
                    <div class="col-xs-12">
                        <a class="btn btn-info btn-block">@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}} @endif Account</a>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-xs-12">                                            
                        <div class="input-group">
                            <span class="input-group-addon btn-info">Email</span>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}" autofocus />
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-xs-12">                                            
                        <div class="input-group">
                            <span class="input-group-addon btn-info">Password</span>
                            <input type="password" class="form-control" placeholder="Password" name="password" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-info btn-block">Log In</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="login-footer">
                <div class="col-xs-12">
                    <center>
                        <a href="{{url(route('signup'))}}">Open new account</a> | 
                        <a href="#" class="mb-control" data-box="#forgot_password">Forgot password</a>
                    <center>
                </div>                   
                <div class="col-xs-12">
                    <center>
                        <a href="{{action('StaticPageController@page', 'about-us')}}">About</a> |
                        <a href="{{action('StaticPageController@page', 'privacy-policy')}}">Privacy</a> |
                        <a href="{{action('StaticPageController@contact')}}">Contact Us</a>
                    <center>
                </div>
                
                @if($errors->any())
                    <div class="col-xs-12">
                        <hr>
                        <ul class="container">
                            @foreach($errors->all() as $error)
                            
                                <li>{{$error}}</li>
                            
                            @endforeach
                        </ul>
                    </div>
                @endif
                
            </div>
            
        </div>
        
    </div>
    
    <div class="message-box message-box-info animated fadeIn" id="forgot_password">
        <div class="mb-container">
            <div class="mb-middle">
                {!! Form::open(['method'=>'post', 'url'=>action('AccessController@forgotPassword'), 'class'=>'form', 'role'=>'form']) !!}
                <div class="mb-title"><span class="fa fa-info"></span>Retrieve password</div>
                <div class="mb-content">
                    {!! Form::email('recovery_email',null, ['class'=>'form-control', 'placeholder'=>'Enter your email address', 'required'=>'']) !!}
                </div>
                <div class="mb-footer">
                    {!! Form::submit('Submit', ['class'=>'btn btn-default btn-lg pull-right']) !!} &nbsp;
                    <span class="btn btn-default btn-lg pull-right mb-control-close">Close</span>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
        
</section>
    
@stop
