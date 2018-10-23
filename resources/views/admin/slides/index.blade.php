
@extends('admin.layout')

@section('title') Slide @stop

@section('main')

<h1><center>Slides @if($slides) : {{$slides->total()}} @endif</center></h1>

 <section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">Create New</h4>
 
    {!! Form::open( ['url'=> action('Slides@store'), 'class'=> 'form form-inline', 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group image">
            {!! Form::label('slide_photos', 'Slide photo: ') !!}
            {!! Form::file('slide_photos', ['class'=>'form-control file']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('slider_id', 'Slider: ') !!}
            {!! Form::select('slider_id', \App\Slider::lists('name', 'id'), old('slider_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('order', 'Order: ') !!}
            {!! Form::text('order', old('order') , ['class'=>'form-control']) !!}
        </div>
            
    <div class="form-group">
        {!! Form::submit('Save Slide', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}

</section>

<section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">List of All:</h4>
    
    <div class="col-xs-12">
        
        <ul class="list-group">
        
    @if($slides)
        @foreach($slides as $slide)
            <li class="list-group-item">
                <ul class="list-inline">
					<li>{{$slide->id}}</li>
					<li>{{$slide->name}}</li>
					<li><center><a href="{{$slide->slide_photo}}" class="btn btn-default btn-xs">{!! thumb($slide->slide_photo) !!}</a></center></li>
					<li>@if($slide->slider) {{$slide->slider->name}} @endif</li>
					<li>{{$slide->order}}</li>  
                    <li class="pull-right">
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#openme{{$slide->id}}"><i class="fa fa-caret-down"></i></a>
                            <a class="btn btn-default btn-xs" data-toggle="collapse" data-target="#editme{{$slide->id}}"><i class="fa fa-pencil"></i></a>
                            <span class="btn btn-link btn-xs">
                                {!! deletes('Slides', $slide['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-xs']) !!}
                            </span>
                    </li>
                </ul>
                <ul class="list-inline collapse" id="editme{{$slide->id}}">
                    
                {!! Form::open( ['class'=> 'form form-inline','method'=>'patch', 'url'=> action('Slides@update', $slide->id), 'enctype'=>'multipart/form-data' ]) !!}
                
                    
                            <div class="form-group">
                                {!! Form::label('name', 'Name: ') !!}
                                {!! Form::text('name', $slide->name , ['class'=>'form-control']) !!}
                            </div>
                                
                            <div class="form-group">
                                <label for="slide_photos">Slide photo: <span class="badge badge-primary"><input type="checkbox" value="1" name="slide_photo_delete" /> remove</span></label>
                                {!! Form::file('slide_photos' , ['class'=>'form-control file']) !!}
                            </div>
                                
                            <div class="form-group">
                                {!! Form::label('slider_id', 'Slider: ') !!}
                                {!! Form::select('slider_id', \App\Slider::lists('name', 'id'), $slide->slider_id , ['class'=>'form-control select2']) !!}
                            </div>
                                
                            <div class="form-group">
                                {!! Form::label('order', 'Order: ') !!}
                                {!! Form::text('order', $slide->order , ['class'=>'form-control']) !!}
                            </div>
                                
                    <div class="form-group">
                        {!! Form::submit('Update Slide', ['class'=>'form-control btn btn-info']) !!}
                    </div>
                
                {!! Form::close() !!}

                
        
                </ul>
                <div class="row collapse" id="openme{{$slide->id}}">
                </div>
            </li>
        @endforeach
    @endif
                
            <ul>
    </div>
</section>
{!! errors($errors) !!}

@stop
        