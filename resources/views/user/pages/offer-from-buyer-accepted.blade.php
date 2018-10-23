@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1 col-xs-12 xs-no-padding">
        
        <div class="col-xs-12 col-sm-6 xs-no-padding">
            <h1 class="section-heading black-text">Requests from Buyers</h1>
        </div>
        
        @include('user.partials.traveler-offer-page-buttons')
        
        <div class="col-xs-12 xs-no-padding">
            
            {!! errors($errors) !!}
            
            @if(count($offers) > 0)
            <ul class="list-group offer-list">
            @foreach($offers as $offer)
            
            <?php
            
            $agreed = ($offer->is_agreed == 1 || \App\Offer::replyOf($offer->id)->agreed()->count() > 0) ? true : false;

            ?>
            <li class="list-group-item push-up-5 push-down-5 offer-list">
                <div class="row pull-left-10">
                    <div class="col-xs-12 col-sm-8 offer-user no-padding">
                        <div class="height-200 pull-20">
                            <img src="@if($offer->buyer) @if($offer->buyer->user_photo){{$offer->buyer->user_photo}} @else /public/img/settings/no-image-available-3.png @endif @endif" alt="Airposted Buyer" class="pull-left img-responsive push-right-10" width="100" />
                            <p><b>@if($offer->buyer)<a href="{{action('Buyers@details', $offer->buyer_id)}}" target="_blank">{{$offer->buyer->name}}</a> @endif</b></p>
                            <p>Country: @if($offer->buyer)@if($offer->buyer->country){{$offer->buyer->country->name}}@endif @endif</p>
                            <p>Product name: {{$offer->name}}</p>
                            <p>Product URL: <a href="{{$offer->link}}" class="btn btn-default btn-rounded btn-xs" target="_blank">Open in new window</a></p>
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
                
                <!--<div class="row replies">-->
                <!--    @if(\App\Offer::replyOf($offer->id)->count() > 0)-->
                <!--    <a class="btn btn-block" role="button" data-toggle="collapse" href="#reply{{$offer->id}}" aria-expanded="false" aria-controls="reply{{$offer->id}}">-->
                <!--      <i class="fa fa-caret-down green-text"></i> View logs and replies-->
                <!--    </a>-->
                <!--    <div class="col-xs-12 no-padding collapse" id="reply{{$offer->id}}">-->
                <!--    @foreach(\App\Offer::replyOf($offer->id)->get() as $reply)-->
                        
                <!--        @if($reply->is_offer_from_traveller == 1)-->
                <!--        <p class="alert">{{$reply->created_at->format('M d h:i')}} - {{$reply->traveller->name}}: I will get this product for you for USD {{$reply->offer_price}}.{{$reply->note}} @if($reply->is_agreed == 1)<span class="badge badge-success white-text pull-right">Offer accepted by buyer</span>@endif</p>-->
                <!--        @elseif($reply->is_offer_from_buyer == 1)-->
                <!--        <p class="alert">{{$reply->created_at->format('M d h:i')}} - {{$reply->buyer->name}}: Please bring me this product for USD {{$reply->offer_price}}.{{$reply->note}} @if($agreed) @if($reply->is_agreed == 1)<span class="badge badge-info white-text pull-right">Offer accepted by me</span>@endif @else @if(\App\Offer::replyOf($offer->id)->toMeFromBuyer()->orderBy('id', 'Desc')->first()->id == $reply->id)<a href="{{action('Offers@offerAcceptedByTraveller', $reply->id)}}" class="btn green-bg white-text square-border pull-right">Accept</a> <a href="{{action('Offers@offerAcceptedByTraveller', $reply->id)}}" class="btn green-bg white-text square-border push-right-5 pull-right">Reject</a> @endif @endif</p>-->
                <!--        @endif-->

                <!--    @endforeach-->
                <!--    </div>-->
                <!--    @endif-->
                <!--</div>-->
                
            </li>
            
            @endforeach
            </ul>
            <div class="row push-up-10 push-down-10">{!! $offers->render() !!}</div>
            @else
            <h4 class="text-center">You dont have any offer from Buyers yet.</h4>
            @endif
        </div>
        
    </div>
</section>


@stop