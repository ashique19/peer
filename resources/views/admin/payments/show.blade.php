
@extends('admin.layout')

@section('title') Payment @stop

@section('main')

<h1 class="page-title"><center>Payment</center></h1>

{!! errors($errors) !!}

@if($payment)
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
                    <td>{{$payment->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$payment->name}}</td>
                </tr>
                
                <tr>
                    <td>Offer</td>
                    <td><a href="{{action('Offers@show', $payment->offer_id)}}" class="btn btn-default btn-rounded btn-xs">View offer details</a></td>
                </tr>
                
                <tr>
                    <td>Buyer</td>
                    <td>@if($payment->buyer) {{$payment->buyer->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Traveller</td>
                    <td>@if($payment->traveller) {{$payment->traveller->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>From country</td>
                    <td>@if($payment->from_country) {{$payment->from_country->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>To country</td>
                    <td>@if($payment->to_country) {{$payment->to_country->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Product price</td>
                    <td>{{$payment->product_price}}</td>
                </tr>
                
                <tr>
                    <td>Airposted commission</td>
                    <td>{{$payment->airposted_commission}}</td>
                </tr>
                
                <tr>
                    <td>Transaction Charge</td>
                    <td>{{$payment->transaction_charge}}</td>
                </tr>
                
                <tr>
                    <td>Payment</td>
                    <td>{{$payment->payment}}</td>
                </tr>
                
                <tr>
                    <td>Gateway</td>
                    <td>@if($payment->gateway) {{$payment->gateway->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Status</td>
                    <td>
					    @if($payment->status == 1)Unpaid
					    @elseif($payment->status == 2)Paid and Unverified
					    @elseif($payment->status == 3)Verified
					    @elseif($payment->status == 4)Withdrawn by Traveler
					    @endif
					</td>
                </tr>
                
                <tr>
                    <td>Is delivered</td>
                    <td>{{yn($payment->is_delivered)}}</td>
                </tr>
                
                <tr>
                    <td>Gateway payment ID</td>
                    <td>@if($payment->gateway_payment) {{$payment->gateway_payment->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Gateway payer ID</td>
                    <td>@if($payment->gateway_payer) {{$payment->gateway_payer->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$payment->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$payment->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Payments', $payment->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Payments', $payment->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        