
@extends('admin.layout')

@section('title') Order log @stop

@section('main')

<h1 class="page-title"><center>Order log</center></h1>

{!! errors($errors) !!}

@if($order_log)
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
                    <td>{{$order_log->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$order_log->name}}</td>
                </tr>
                
                <tr>
                    <td>Order</td>
                    <td>@if($order_log->order) {{$order_log->order->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>User</td>
                    <td>@if($order_log->user) {{$order_log->user->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Created By</td>
                    <td>@if($order_log->createdBy){{$order_log->createdBy->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Created By</td>
                    <td>@if($order_log->updatedBy){{$order_log->updatedBy->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Log detail</td>
                    <td>{{$order_log->log_detail}}</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$order_log->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$order_log->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Order_logs', $order_log->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Order_logs', $order_log->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        