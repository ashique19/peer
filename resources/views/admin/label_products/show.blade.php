
@extends('admin.layout')

@section('title') Label product @stop

@section('main')

<h1 class="page-title"><center>Label product</center></h1>

{!! errors($errors) !!}

@if($label_product)
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
                    <td>{{$label_product->id}}</td>
                </tr>
                
                <tr>
                    <td>Label</td>
                    <td>@if($label_product->label) {{$label_product->label->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$label_product->name}}</td>
                </tr>
                
                <tr>
                    <td>Quantity</td>
                    <td>{{$label_product->quantity}}</td>
                </tr>
                
                <tr>
                    <td>Weight</td>
                    <td>{{$label_product->weight}}</td>
                </tr>
                
                <tr>
                    <td>Value</td>
                    <td>{{$label_product->value}}</td>
                </tr>
                
                <tr>
                    <td>Country</td>
                    <td>@if($label_product->country) {{$label_product->country->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Hs tarrif</td>
                    <td>{{$label_product->hs_tarrif}}</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$label_product->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$label_product->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Label_products', $label_product->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Label_products', $label_product->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        