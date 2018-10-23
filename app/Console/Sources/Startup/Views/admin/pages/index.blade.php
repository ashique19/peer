
@extends('admin.layout')

@section('title') Page @stop

@section('main')

<h1><center>Pages @if($pages) : {{$pages->total()}} @endif</center></h1>

<section class="col-xs-12">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Pages@searchIndex')]) !!} 
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('details', 'Details: ') !!}
            {!! Form::text('details', old('details') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('meta_tag_title', 'Meta tag title: ') !!}
            {!! Form::text('meta_tag_title', old('meta_tag_title') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('meta_tag_description', 'Meta tag description: ') !!}
            {!! Form::text('meta_tag_description', old('meta_tag_description') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('meta_tag_keywords', 'Meta tag keywords: ') !!}
            {!! Form::text('meta_tag_keywords', old('meta_tag_keywords') , ['class'=>'form-control']) !!}
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

<section class="col-sm-11">
@if($errors->any())

    <h4>Please check:</h4>
    
    <ul>
        @foreach($errors->all() as $error)
        
            <li>{{$error}}</li>
        
        @endforeach
    </ul>
    <hr>
    
@endif
</section>

<section class="col-sm-11">

    <table class="table table-responsive">
        <thead>
            <tr>
				<th>Id</th>
				<th>Name</th>
				<th>Created at</th>
				<th>Updated at</th>
                <th>Show</th>
                <th>Modify</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($pages)
                @foreach($pages as $page)
                    <tr>
						<td>{{$page->id}}</td>
						<td>{{$page->name}}</td>
						<td>{{$page->created_at}}</td>
						<td>{{$page->updated_at}}</td>
                        <td>
                            <a href="{{action('Pages@show', $page->id)}}" class="btn btn-default btn-sm btn-rounded" title="Edit role"><span class="fa fa-pencil"></span></a>
                        </td>
                        <td>
                            <a href="{{action('Pages@edit', $page['id'])}}" class="btn btn-default btn-sm btn-rounded" title="Edit role"><span class="fa fa-pencil"></span></a>
                        </td>
                        <td>
                            {!! Form::open(['method'=>'delete', 'url'=> action('Pages@destroy', $page->id) ]) !!}
                            {!! Form::hidden('id', $page->id ) !!}
                            <button href="{{action('Pages@edit',[$page->id])}}" class="btn btn-danger btn-sm btn-rounded" title="Delete page ">
                                <span class="fa fa-times"></span>
                            </button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $pages->render() !!}
</section>

@stop
        