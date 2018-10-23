
@extends('admin.layout')

@section('title') Slider @stop

@section('main')

<h1><center>Sliders @if($sliders) : {{$sliders->total()}} @endif</center></h1>

 <section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">Create New</h4>
 
    {!! Form::open( ['url'=> action('Sliders@store'), 'class'=> 'form form-inline', 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('note', 'Note: ') !!}
            {!! Form::text('note', old('note') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Slider', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}

</section>

<section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">List of All:</h4>
    
    <div class="col-xs-12">
        
        <ul class="list-group">
        
    @if($sliders)
        @foreach($sliders as $slider)
            <li class="list-group-item">
                <ul class="list-inline">
					<li>{{$slider->id}}</li>
					<li>{{$slider->name}}</li>
					<li>{{$slider->note}}</li>  
                    <li class="pull-right">
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#openme{{$slider->id}}"><i class="fa fa-caret-down"></i></a>
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#editme{{$slider->id}}"><i class="fa fa-pencil"></i></a>
                            <span class="btn btn-link btn-xs">
                                {!! deletes('Sliders', $slider['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-xs']) !!}
                            </span>
                    </li>
                </ul>
                <ul class="list-inline collapse" id="editme{{$slider->id}}">
                    
                {!! Form::open( ['class'=> 'form form-inline','method'=>'patch', 'url'=> action('Sliders@update', $slider->id), 'enctype'=>'multipart/form-data' ]) !!}
                
                    
                            <div class="form-group">
                                {!! Form::label('name', 'Name: ') !!}
                                {!! Form::text('name', $slider->name , ['class'=>'form-control']) !!}
                            </div>
                                
                            <div class="form-group">
                                {!! Form::label('note', 'Note: ') !!}
                                {!! Form::text('note', $slider->note , ['class'=>'form-control']) !!}
                            </div>
                                
                    <div class="form-group">
                        {!! Form::submit('Update Slider', ['class'=>'form-control btn btn-info']) !!}
                    </div>
                
                {!! Form::close() !!}

                
        
                </ul>
                <div class="row collapse" id="openme{{$slider->id}}">
                </div>
            </li>
        @endforeach
    @endif
                
            <ul>
    </div>
</section>
{!! errors($errors) !!}

@stop
        