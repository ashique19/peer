
@extends('admin.layout')

@section('title') Category @stop

@section('main')

<h1><center>Categories @if($categories) : {{$categories->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Categories@searchIndex')]) !!} 
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('search_index', 'Search index: ') !!}
            {!! Form::text('search_index', old('search_index') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_active', 'Is active: ') !!}
            {!! Form::select('is_active', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_active') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_at_homepage', 'Is at homepage: ') !!}
            {!! Form::select('is_at_homepage', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_at_homepage') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('amazon_node', 'Amazon node: ') !!}
            {!! Form::text('amazon_node', old('amazon_node') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('from', 'From: ') !!}
            {!! Form::text('from', old('from') , ['class'=>'form-control datepicker']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('to', 'To: ') !!}
            {!! Form::text('to', old('to') , ['class'=>'form-control datepicker']) !!}
        </div>

        {!! Form::submit('search', ['class'=>'btn btn-info']) !!}
        
    {!! Form::close() !!}
    
    <hr>
</section>

{!! errors($errors) !!}

<section class="col-sm-10 col-sm-offset-1">
    
    <a href="{{action('Categories@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <span class="badge badge-primary pull-left">Latest 12 from homepage items will be visible at homepage.</span>
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Name</th>
				<th class="blue-bg white-text">Is active</th>
				<th class="blue-bg white-text">Is at homepage</th>
				<th class="blue-bg white-text">Category photo</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($categories)
                @foreach($categories as $category)
                    <tr>
						<td>{{$category->id}}</td>
						<td>{{$category->name}}</td>
						<td>{{yn($category->is_active)}}</td>
						<td>{{yn($category->is_at_homepage)}}</td>
						<td><center><a href="{{$category->category_photo}}" class="btn btn-default btn-xs">{!! thumb($category->category_photo) !!}</a></center></td>
                        <td>
                            {!! views('Categories', $category->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                        <td>
                            {!! edits('Categories', $category['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                        </td>
                        <td>
                            {!! deletes('Categories', $category['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $categories->render() !!}
</section>


@stop
        