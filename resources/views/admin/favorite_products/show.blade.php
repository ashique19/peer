
@extends('admin.layout')

@section('title') Favorite product @stop

@section('main')

<h1 class="page-title"><center>Favorite product</center></h1>

{!! errors($errors) !!}

@if($favorite_product)
<section class="row panel-body">
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
                    <td>{{$favorite_product->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$favorite_product->name}}</td>
                </tr>
                
                <tr>
                    <td>Amazon url</td>
                    <td>{{$favorite_product->amazon_url}}</td>
                </tr>
                
                <tr>
                    <td>Image url</td>
                    <td>{{$favorite_product->image_url}}</td>
                </tr>
                
                <tr>
                    <td>Price</td>
                    <td>{{$favorite_product->price}}</td>
                </tr>
                
                <tr>
                    <td>User</td>
                    <td>@if($favorite_product->user) {{$favorite_product->user->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$favorite_product->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$favorite_product->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Favorite_products', $favorite_product->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Favorite_products', $favorite_product->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        