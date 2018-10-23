
@extends('admin.layout')

@section('title') Page @stop

@section('main')

<h1><center>Page</center></h1>

<section class="col-xs-12">
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

@if($page)
<section class="col-xs-12">
    <table class="table table-bordered table-striped table-actions">
        <tdead>
            <tr>
                <td width="200">Title</td>
                <td>Details</td>
            </tr>
        </tdead>
        <tbody>
                <tr>
                    <td>Id</td>
                    <td>{{$page->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$page->name}}</td>
                </tr>
                
                <tr>
                    <td>Details</td>
                    <td>{!! $page->details !!}</td>
                </tr>
                
                <tr>
                    <td>Meta tag title</td>
                    <td>{{$page->meta_tag_title}}</td>
                </tr>
                
                <tr>
                    <td>Meta tag description</td>
                    <td>{{$page->meta_tag_description}}</td>
                </tr>
                
                <tr>
                    <td>Meta tag keywords</td>
                    <td>{{$page->meta_tag_keywords}}</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$page->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$page->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    <a href="{{action('Pages@edit', $page->id)}}" class="btn btn-info btn-sm">edit</a>                
                </td>
                <td>
                    {!! Form::open(['url'=>action('Pages@destroy', $page->id), 'method'=>'DELETE']) !!}
                    {!! Form::hidden('id',$page->id) !!}
                    <button class=" btn btn-primary btn-sm "> <i class="fa fa-trash-o"></i> </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>
@else

    <h3>No data found.</h3>

@endif

@stop
        