
@extends('admin.layout')

@section('title') Edit Airports @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Modify Airport</center></h1>


@if($errors->any())
<section class="col-sm-6 col-sm-offset-3">
    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
</section>  
@endif


<section class="col-sm-6 col-sm-offset-3">

{!! Form::open( ['method'=>'patch', 'url'=> action('Airports@update', $airport->id), 'enctype'=>'multipart/form-data' ]) !!}

    
            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', $airport->name , ['class'=>'form-control']) !!}
            </div>
                
            <div class="form-group">
                {!! Form::label('country_id', 'Country: ') !!}
                {!! Form::select('country_id', \App\Country::lists('name', 'id'), $airport->country_id , ['class'=>'form-control select2']) !!}
            </div>
                
    <div class="form-group">
        {!! Form::submit('Update Airport', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        