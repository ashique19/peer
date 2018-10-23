@extends('public.layouts.layout')
@section('title')@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif- Signup is easy. @stop
@section('main')

<section class="col-xs-12 col-sm-8 main-body">

<div class="panel panel-default"></div>

<div class="panel panel-default">
    
    <div class="panel-heading">
        <h1><center>Signup</center></h1>
    </div>
    
    <div class="panel-body">
        <div class="list-group border-bottom">
            
            @if($errors->any())

                <ul>
                    @foreach($errors->all() as $error)
                    
                        <li>{{$error}}</li>
                    
                    @endforeach
                </ul>
            
            @endif
            
            <div class="col-xs-12">
            {!! Form::open(['url'=>action('AccessController@postSignup'), 'method'=>'post']) !!}
                <a href="#" class="list-group-item"><span class="profile-details-heading">First name: </span> {!! Form::text('firstname', old('firstname'), ['class'=>'form-control']) !!}</a>
                <a href="#" class="list-group-item"><span class="profile-details-heading">Last name: </span> {!! Form::text('lastname', old('lastname'), ['class'=>'form-control']) !!}</a>
                <a href="#" class="list-group-item"><span class="profile-details-heading">Email: </span> {!! Form::text('email', old('email'), ['class'=>'form-control']) !!}</a>
                <a href="#" class="list-group-item"><span class="profile-details-heading">Password: </span> {!! Form::password('password', ['class'=>'form-control']) !!}</a>
                <a href="#" class="list-group-item"><span class="profile-details-heading">Contact: </span> {!! Form::text('contact', old('contact'), ['class'=>'form-control']) !!}</a>
                <a href="#" class="list-group-item"><span class="profile-details-heading">Address: </span> {!! Form::text('address', old('address'), ['class'=>'form-control']) !!}</a>
                <a href="#" class="list-group-item"><span class="profile-details-heading">City: </span> {!! Form::text('city', old('city'), ['class'=>'form-control']) !!}</a>
                <a href="#" class="list-group-item"><span class="profile-details-heading">State: </span> {!! Form::text('state', old('state'), ['class'=>'form-control']) !!}</a>
                <a href="#" class="list-group-item"><span class="profile-details-heading">Postcode: </span> {!! Form::text('postcode', old('postcode'), ['class'=>'form-control']) !!}</a>
                <a href="#" class="list-group-item"><span class="profile-details-heading">Country: </span> {!! Form::select('country_id', \App\Country::lists('name','id'), old('country'), ['class'=>'form-control select2']) !!}</a>
                <a href="#" class="list-group-item"><span class="profile-details-heading">Parmanent Address: </span> {!! Form::text('parmanent_address', old('parmanent_address'), ['class'=>'form-control']) !!}</a>
                <a href="#" class="list-group-item active"><center>{!! Form::submit('Signup', ['class'=>'btn btn-info']) !!}</center></a>
            {!! Form::close() !!}
            </div>
        </div>                              
    </div>
</div>
</section>

@stop