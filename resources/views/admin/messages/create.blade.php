
@extends('admin.layout')

@section('title') Create new Message @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Messages</center></h1>


@if($errors->any())
<section class="row panel-body">
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

<h3>Create Message</h3>


{!! Form::open( ['url'=> action('Messages@store'), 'enctype'=>'multipart/form-data' ]) !!}

        <div class="form-group">
            {!! Form::label('message_to', 'To: ') !!}
            {!! Form::select('message_to', [] , old('message_to') , ['class'=>'form-control user-search', 'placeholder'=>'Receiver of the message']) !!}
        </div>
    
        <div class="form-group">
            {!! Form::label('name', 'Subject: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        {!! Form::hidden('message_from', auth()->user()->id) !!}
            
        <div class="form-group">
            {!! Form::label('details', 'Details: ') !!}
            {!! Form::textarea('details', old('details') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Message', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        