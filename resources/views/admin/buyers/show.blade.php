
@extends('admin.layout')

@section('title') Buy @stop

@section('main')

<h1 class="page-title"><center>Buy</center></h1>

{!! errors($errors) !!}

@if($buyer)
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
                    <td>{{$buyer->id}}</td>
                </tr>
                
                <tr>
                    <td>Product</td>
                    <td>{{$buyer->name}}</td>
                </tr>
                
                <tr>
                    <td>Amazon url</td>
                    <td><a href="{{$buyer->amazon_url}}" class="btn btn-default btn-rounded btn-xs">Open in new window</a></td>
                </tr>
                
                <tr>
                    <td>Other url</td>
                    <td><a href="{{$buyer->other_url}}" class="btn btn-default btn-rounded btn-xs">Open in new window</a></td></td>
                </tr>
                
                <tr>
                    <td>Price</td>
                    <td>{{$buyer->price}}</td>
                </tr>
                
                <tr>
                    <td>Country</td>
                    <td>@if($buyer->country) {{$buyer->country->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Buyer</td>
                    <td>@if($buyer->user) {{$buyer->user->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Category</td>
                    <td>@if($buyer->category) {{$buyer->category->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$buyer->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$buyer->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Buyers', $buyer->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Buyers', $buyer->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        