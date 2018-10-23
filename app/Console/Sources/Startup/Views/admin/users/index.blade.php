@extends('admin.layout')

@section('main')

<h3>Users ({{$users->total()}})</h3>


@if($errors->any())

    <h4>Please check:</h4>
    
    @foreach($errors as $error)
    
        <li>{{$error}}</li>
    
    @endforeach
    
    <hr>
    
@endif

<section class="col-sm-12">
    <h2 class="page-title text-center">Search Users</h2>
    {!! Form::open(['method'=> 'POST', 'url'=> action('Users@postSearch'), 'class'=> 'form form-inline' ]) !!}
    
    {!! Form::label('name', 'Name:'  ) !!}
    {!! Form::text('name', null, ['class'=> 'form-control']  ) !!}
    
    {!! Form::label('role', 'Role:'  ) !!}
    {!! Form::select('role', \App\Role::lists('name', 'id'), null, ['class'=> 'form-control', 'placeholder'=> '-Select-']  ) !!}
    
    {!! Form::label('email', 'Email:'  ) !!}
    {!! Form::text('email', null, ['class'=> 'form-control']  ) !!}
    
    {!! Form::label('phone', 'Phone:'  ) !!}
    {!! Form::text('phone', null, ['class'=> 'form-control']  ) !!}
    
    {!! Form::label('address', 'Address:'  ) !!}
    {!! Form::text('address', null, ['class'=> 'form-control']  ) !!}
    
    {!! Form::label('country_id', 'Country:'  ) !!}
    {!! Form::select('country_id', \App\Country::lists('name', 'id'), null, ['class'=> 'form-control select2']  ) !!}
    
    {!! Form::submit('Search', ['class'=> 'btn btn-info']) !!}
    
    {!! Form::close() !!}
</section>


<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>View</th>
            <th>Modify</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @if($users)
            @foreach($users as $user)
                
                <tr>
                    <td>{{$user->name}}</td>
                    <td>@if($user->roles){{$user->roles->name}} @endif</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->contact}}</td>
                    <td><a href="{{action('Users@show', $user->id)}}" class="btn btn-info"><i class="fa fa-expand"></i></a></td>
                    <td>
                        <a href="{{action('Users@edit', $user->id)}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                    </td>
                    <td>
                        {!! Form::open(['url'=>action('Users@destroy', $user->id), 'method'=>'DELETE']) !!}
                        {!! Form::hidden('id',$user->id) !!}
                        <button class="btn btn-info"> <i class="fa fa-trash-o"></i> </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

{!! $users->render() !!}

@stop