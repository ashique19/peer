
@extends('admin.layout')

@section('title') Order product @stop

@section('main')

<h1 class="page-title"><center>Order product</center></h1>

{!! errors($errors) !!}

@if($order_product)
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
                    <td>{{$order_product->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$order_product->name}}</td>
                </tr>
                
                <tr>
                    <td>Order</td>
                    <td>@if($order_product->order) {{$order_product->order->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Source</td>
                    <td>{{$order_product->source}}</td>
                </tr>
                
                <tr>
                    <td>Product url</td>
                    <td>{{$order_product->product_url}}</td>
                </tr>
                
                <tr>
                    <td>Category</td>
                    <td>@if($order_product->category) {{$order_product->category->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Price</td>
                    <td>{{$order_product->price}}</td>
                </tr>
                
                <tr>
                    <td>Height</td>
                    <td>{{$order_product->height}}</td>
                </tr>
                
                <tr>
                    <td>Width</td>
                    <td>{{$order_product->width}}</td>
                </tr>
                
                <tr>
                    <td>Length</td>
                    <td>{{$order_product->length}}</td>
                </tr>
                
                <tr>
                    <td>Weight</td>
                    <td>{{$order_product->weight}}</td>
                </tr>
                
                <tr>
                    <td>Dimension unit</td>
                    <td>{{$order_product->dimension_unit}}</td>
                </tr>
                
                <tr>
                    <td>Weight unit</td>
                    <td>{{$order_product->weight_unit}}</td>
                </tr>
                
                <tr>
                    <td>Product image</td>
                    <td>{{$order_product->product_image}}</td>
                </tr>
                
                <tr>
                    <td>Quantity</td>
                    <td>{{$order_product->quantity}}</td>
                </tr>
                
                <tr>
                    <td>Note</td>
                    <td>{{$order_product->note}}</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$order_product->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$order_product->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Order_products', $order_product->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Order_products', $order_product->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        