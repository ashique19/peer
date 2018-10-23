@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
            <div class="col-sm-3 col-md-2 no-padding">
                <ul class="user-action-ul">
                    <li class="user-actions"><a href="{{action('BuyOrders@newOrder')}}" >Order</a></li>
                    <li class="user-actions active"><a href="{{action('BuyOrders@history')}}" >History</a></li>
                </ul>
            </div>
        
            <div class="col-sm-9 col-md-10">
                
                <h1 class="section-heading blue-text">Orders</h1>
                <h2 class="section-heading black-text small-heading">Orders that I placed</h2>
            
                <section class="col-xs-12 no-padding scrollable">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th style="min-width: 135px;">Date</th>
                                <th style="min-width: 250px; max-width: 350px;">Product</th>
                                <th style="text-align: right;">Price</th>
                                <th style="min-width: 100px;">Status</th>
                                <th style="max-width: 100px;">Shipping fee</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($orders) > 0 )
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->created_at->format('Y-m-d')}}</td>
                                
                                <?php $products = $order->order_products; ?>
                                
                                <td colspan="2" style="min-width: 250px; max-width: 350px; overflow-x: scroll;">
                                    @if( count($products) > 0)
                                    @foreach($products as $product)
                                    <p class="product-detail-price">
                                        <a class="btn no-padding" href="{{$product->product_url}}" target="_blank"><img src="{{$product->product_image}}" class="img-thumbnail push-5" width="50">{{$product->name}}</a>
                                        <span class="badge badge-primary pull-right white-text">
                                            {{$product->price}}
                                        </span>
                                    </p>
                                    @endforeach
                                    @endif
                                </td>
                                <td>{{order_status($order->status)}}</td>
                                <td>{{ round($order->order_total - $order->product_cost , 2) }}</td>
                                <td>
                                    <a href="{{action('BuyOrders@orderSummary', $order->id)}}" class="btn btn-rouned btn-block green-bg white-text">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </section>
                
            </div>
        </div>
        
        
    </div>
</section>


@stop