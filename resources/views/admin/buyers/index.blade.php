
@extends('admin.layout')

@section('title') Buy @stop

@section('main')

<h1><center>Buy @if($buyers) : {{$buyers->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Buyers@searchIndex')]) !!} 
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('country_id', 'Country: ') !!}
            {!! Form::select('country_id', \App\Country::lists('name', 'id'), old('country_id') , ['class'=>'form-control select2' ]) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', [], old('user_id') , ['class'=>'form-control user-search', 'placeholder'=> '-Search Buyer-']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('category_id', 'Category: ') !!}
            {!! Form::select('category_id', \App\Category::lists('name', 'id'), old('category_id') , ['class'=>'form-control select2']) !!}
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

<section class="col-sm-12">
    
    <a href="{{action('Buyers@create')}}" class="btn btn-default pull-right btn-lg blue-border blue-text">Add new</a>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Name</th>
				<th class="blue-bg white-text">Amazon url</th>
				<th class="blue-bg white-text">Other url</th>
				<th class="blue-bg white-text">Price</th>
				<th class="blue-bg white-text">Country</th>
				<th class="blue-bg white-text">Buyer</th>
				<th class="blue-bg white-text">Category</th>
				<th class="blue-bg white-text">Created at</th>
				<th class="blue-bg white-text">Updated at</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($buyers)
                @foreach($buyers as $buyer)
                    <tr>
						<td>{{$buyer->id}}</td>
						<td>{{$buyer->name}}</td>
						<td><a href="{{$buyer->amazon_url}}" class="btn btn-default btn-rounded btn-xs" target="_blank">open in new window</a></td>
						<td><a href="{{$buyer->other_url}}" class="btn btn-default btn-rounded btn-xs" target="_blank">open in new window</a></td>
						<td>{{$buyer->price}}</td>
						<td>@if($buyer->country) {{$buyer->country->name}} @endif</td>
						<td>@if($buyer->user) {{$buyer->user->name}} @endif</td>
						<td>@if($buyer->category) {{$buyer->category->name}} @endif</td>
						<td>{{$buyer->created_at}}</td>
						<td>{{$buyer->updated_at}}</td>
                        <td>
                            {!! views('Buyers', $buyer->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                        <td>
                            {!! edits('Buyers', $buyer['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                        </td>
                        <td>
                            {!! deletes('Buyers', $buyer['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $buyers->render() !!}
</section>


@stop
        