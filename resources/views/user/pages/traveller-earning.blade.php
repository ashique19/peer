@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        {!! errors($errors) !!}
        
        <div class="col-xs-12 no-padding">
            
            <div class="col-sm-3 col-md-2 no-padding">
                <ul class="user-action-ul">
                    <li class="user-actions"><a href="{{action('Payments@traveller')}}" >All Transactions</a></li>
                    <li class="user-actions"><a href="{{action('Payments@paidForTraveller')}}" >Paid</a></li>
                    <li class="user-actions"><a href="{{action('Payments@unpaidForTraveller')}}" >Unpaid</a></li>
                    <li class="user-actions active"><a href="{{action('Payments@earningHistory')}}" >Earning History</a></li>
                </ul>
            </div>
            
            <div class="col-sm-9 col-md-10">
                <section class="row push-up-20 pull-left-20 scrollable">
                    <h1 class="section-heading black-text">Earning History</h1>
                    
                    <table class="table table-responsive table-theme-1 table-condensed">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>From</th>
                                <th>My Earning</th>
                                <th>Withdraw Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if(count($payments) > 0)
                            @foreach($payments as $payment)
                            <tr>
                                <td><a @if($payment->offer) href="{{$payment->offer->link}}" @endif>{{$payment->name}}</a></td>
                                <td>{{$payment->product_price}}</td>
                                <td>@if($payment->traveller){{$payment->traveller->country->name}} @endif</td>
                                <td>{{$payment->agreed_price}}</td>
                                <td>{{$payment->updated_at->format('Y-m-d')}}</td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                    
                    {!! $payments->render() !!}

                </section>
            
            </div>
        </div>
    
    </div>
</section>

@stop