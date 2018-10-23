@extends('admin.layout')

@section('main')

<section class="col-xs-12">

<h3>Modify User: {{$user->name}}</h3>


{!! Form::open( ['method'=>'patch', 'url'=> action('Users@update', ['id'=>$user->id]), 'enctype'=>'multipart/form-data' ]) !!}

    <div class="form-group">
        {!! Form::label('firstname','First Name: ') !!}
        {!! Form::text('firstname', $user->firstname , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('lastname','Last Name: ') !!}
        {!! Form::text('lastname', $user->lastname , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('email','Email: ') !!}
        {!! Form::text('email', $user->email , ['class'=>'form-control']) !!}
    </div>
    
    
    <div class="form-group">
        {!! Form::label('password','New Password: ') !!}
        {!! Form::text('password', null , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('address','Address: ') !!}
        {!! Form::text('address', $user->address , ['class'=>'form-control']) !!}
    </div>
    
    
    <div class="form-group">
        {!! Form::label('contact','Contact: ') !!}
        {!! Form::text('contact', $user->contact , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('address','Address: ') !!}
        {!! Form::text('address', $user->address , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('city','City: ') !!}
        {!! Form::text('city', $user->city , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('state','State: ') !!}
        {!! Form::text('state', $user->state , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('postcode','Postcode: ') !!}
        {!! Form::text('postcode', $user->postcode , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('country_id','Country: ') !!}
        {!! Form::select('country_id', \App\Country::lists('name','id'), $user->country_id , ['class'=>'form-control select2']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('active','Status: ') !!}
        {!! Form::select('active', ['1'=>'Active', '2'=>'Inactive'], $user->active , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('balance','Balance: ') !!}
        {!! Form::text('balance', $user->balance , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('picture','New Profile Image: ') !!}
        {!! Form::file('picture' , ['class'=>'form-control']) !!}
    </div>
    
    <div class="form-group">
        {!! Form::submit('Update User', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}



@if($errors->any())
    <hr>
    <ul class="container">
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>

@endif

</section>

@stop