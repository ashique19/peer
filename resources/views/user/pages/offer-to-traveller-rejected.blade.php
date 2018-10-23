@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1 col-xs-12 xs-no-padding">
        
        <div class="col-xs-12 col-sm-6 xs-no-padding">
            <h1 class="section-heading black-text">Offers from Travelers (Rejected)</h1>
        </div>
        
        @include('user.partials.buyer-offer-page-buttons')
        
        <div class="col-xs-12 xs-no-padding">
            
            {!! errors($errors) !!}
            
            @if(count($offers) > 0)
            <ul class="list-group offer-list">
            @foreach($offers as $offer)
            
            <?php
            
            $agreed = ($offer->is_agreed == 1 || \App\Offer::replyOf($offer->id)->agreed()->count() > 0) ? true : false;
            $rejected = ($offer->is_deleted == 1 || \App\Offer::replyOf($offer->id)->deleted()->count() > 0) ? true : false; 
            
            ?>
            <li class="list-group-item push-up-5 push-down-5 offer-list">
                <div class="row pull-left-10">
                    <div class="col-xs-12 col-sm-8 offer-user no-padding">
                        <div class="height-200 pull-20">
                            <img src="@if($offer->traveller) @if($offer->traveller->user_photo){{$offer->traveller->user_photo}} @else /public/img/settings/no-image-available-3.png @endif @endif" alt="Airposted traveller" class="pull-left img-responsive push-right-10" width="100" />
                            <p><b>@if($offer->traveller)<a href="{{action('Travels@travellerDetails', $offer->traveller_id)}}" target="_blank">{{$offer->traveller->name}}</a> @endif</b></p>
                            <p>Country: @if($offer->traveller)@if($offer->traveller->country){{$offer->traveller->country->name}}@endif @endif</p>
                            <p>Product URL: <a href="{{$offer->link}}" class="btn btn-default btn-rounded btn-xs" target="_blank">Open in new window</a></p>
                            <p>Product Name: {{$offer->name}}</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 height-200 pull-20 offer-details">
                        <p class="row"><span class="col-xs-6">Product Price:</span> <span class="col-xs-6">USD {{$offer->product_price}}</span></p>
                        <p class="row"><span class="col-xs-6">Traveler Fee:</span> <span class="col-xs-6">USD {{$offer->offer_price * 1 - $offer->product_price * 1 }}</span></p>
                        <p class="row"><span class="col-xs-6">Airposted Fee:</span> <span class="col-xs-6">USD {{$offer->airposted_commission}}</span></p>
                        <p class="row"><span class="col-xs-6">Transaction Fee:</span> <span class="col-xs-6">USD {{$offer->transaction_charge}}</span></p>
                        <p class="row"><span class="col-xs-6">Total:</span> <span class="col-xs-6">USD {{$offer->total_price}}</span></p>
                    </div>
                </div>
                
                @include('user.partials.offer-replies')
                
            </li>
            @endforeach
            </ul>
            <div class="row push-up-10 push-down-10">{!! $offers->render() !!}</div>
            @else
            <h4 class="text-center">You dont have any offer from travelers yet.</h4>
            @endif
        </div>
        
    </div>
</section>


@stop