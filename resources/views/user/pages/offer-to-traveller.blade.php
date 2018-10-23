@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1 col-xs-12 xs-no-padding">
        
        <div class="col-xs-12 col-sm-6 xs-no-padding">
            <h1 class="section-heading black-text">Offers from Travelers (Pending)</h1>
        </div>
        
        @include('user.partials.buyer-offer-page-buttons')
        
        <div class="col-xs-12 xs-no-padding">
            
            {!! errors($errors) !!}
            
            @if(count($offers) > 0)
            <ul class="list-group offer-list">
            @foreach($offers as $offer)
            
            <?php
            $agreed         = ($offer->is_agreed == 1 || \App\Offer::replyOf($offer->id)->agreed()->count() > 0) ? true : false;
            $rejected       = ($offer->is_deleted == 1 || \App\Offer::replyOf($offer->id)->deleted()->count() > 0) ? true : false; 
            $actionReply    = \App\Offer::replyOf($offer->id)->orderBy('id', 'Desc')->first();
            ?>
            @if( $agreed == false && $rejected == false)
            <li class="list-group-item push-up-5 push-down-5 offer-list">
                <div class="row pull-left-10">
                    <div class="col-xs-12 col-sm-6 offer-user no-padding">
                        <div class="height-200 pull-20">
                            <img src="@if($offer->traveller) @if($offer->traveller->user_photo) {{$offer->traveller->user_photo}} @else /public/img/settings/no-image-available-3.png @endif @endif" alt="Airposted traveller" class="pull-left img-responsive push-right-10" width="100" />
                            <p><b>@if($offer->traveller)<a href="{{action('Travels@travellerDetails', $offer->traveller_id)}}" target="_blank">{{$offer->traveller->name}}</a> @endif</b></p>
                            <p>Country: @if($offer->traveller)@if($offer->traveller->country){{$offer->traveller->country->name}}@endif @endif</p>
                            <p>Product URL: <a href="{{$offer->link}}" class="btn btn-default btn-rounded btn-xs" target="_blank">Open in new window</a></p>
                            <p>Product Name: {{$offer->name}}</p>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-3 height-200 pull-20 offer-details">
                        <p class="row"><span class="col-xs-6">Product Price:</span> <span class="col-xs-6">USD {{$offer->product_price}}</span></p>
                        <p class="row"><span class="col-xs-6">Traveler Fee:</span> <span class="col-xs-6">USD @if(($offer->offer_price * 1 - $offer->product_price * 1) < 0) 0 @else {{$offer->offer_price * 1 - $offer->product_price * 1 }}@endif</span></p>
                        <p class="row"><span class="col-xs-6">Airposted Fee:</span> <span class="col-xs-6">USD {{$offer->airposted_commission}}</span></p>
                        <p class="row"><span class="col-xs-6">Transaction Fee:</span> <span class="col-xs-6">USD {{$offer->transaction_charge}}</span></p>
                        <p class="row"><span class="col-xs-6">Total:</span> <span class="col-xs-6">USD {{$offer->total_price}}</span></p>
                    </div>
                    <div class="col-xs-4 col-sm-3 no-padding push-up-20">
                        <ul class="list-group push-20 unstyled-list offer-action">
                            
                            @if($offer->is_agreed == 1)<span class="badge badge-info white-text">@if($offer->is_offer_from_buyer == 1)Offer accepted by me @elseif($offer->is_offer_from_traveller == 1)Offer accepted by traveler @endif</span> @endif
                            @if(!$agreed)<a type="button" class="btn white-bg orange-text orange-border btn-block square-border " tabindex="0" data-toggle="popover" data-placement="bottom" title='<h4 class="text-center">Make an offer</h4>' data-content='{!! Form::open(["url"=> action("Offers@offerUpdateByBuyer"), "class"=> "offer_made_by_user"]) !!} {!! Form::text("product_price", $offer->product_price, ["class"=> "form-control text-center reply_price square-border", "placeholder"=> "Product price (USD)", "title"=> "Product price (USD)", "transaction_rate"=> $app->transaction_charge, "commission_rate"=> $app->commission ]) !!} {!! Form::text("traveller_commission", null, ["class"=> "form-control square-border text-center reply_traveller_commission", "placeholder"=> "Traveler Commission (USD)", "title"=> "Traveler Commission (USD)"]) !!} <p>Transaction Charge ({{$app->transaction_charge}}% + 0.30 USD): <span class="reply_transaction_charge">0</span></p><p>Airposted Commission ({{$app->commission}}%): <span class="reply_airposted_commission">0</span></p><p>Total: <span class="reply_total">0</span></p> {!! Form::text("note", null, ["class"=> "form-control text-center push-up-10 square-border", "placeholder"=> "Note"]) !!} {!! Form::hidden("id", $offer->id) !!} <p class="text-center black-text message"></p>{!! Form::submit("Send Offer", ["class"=> "btn blue-bg white-text square-border btn-block push-up-10"]) !!} {!! Form::close() !!} ' >Counter Offer</a>@endif
                            
                            @if($offer->offer_price && $offer->is_agreed == 0 && $offer->is_offer_from_buyer == 0 && \App\Offer::replyOf($offer->id)->toMeFromTraveller()->notAgreed()->count() == 0)
                            <a href="{{action('Offers@offerAcceptedByBuyer', $offer->id)}}" class="btn white-bg green-text green-border btn-block square-border  push-up-5 push-down-5">Accept</a>
                            <a type="button" class="btn white-bg blue-text blue-border btn-block square-border " tabindex="0" data-toggle="popover" data-placement="top" title='<h4 class="text-center">Reason for Rejecting the offer</h4>' data-content='{!! Form::open(["url"=> action("Offers@rejectOffer"), "class"=> "offer_rejected_by_user"]) !!} {!! Form::hidden("id", $offer->id) !!} {!! Form::hidden("is_offer_from_buyer", 1) !!} {!! Form::hidden("is_offer_from_traveller", 0) !!} <p class="black-text">I rejected the offer. Because-</p>{!! Form::text("reason", null, ["class"=> "form-control", "placeholder"=> "Please write your reason to reject the offer", "required"=> "required"]) !!} {!! Form::submit("Submit", ["class"=> "btn green-bg white-text square-border push-up-5 push-down-5 pull-right"]) !!} {!! Form::close() !!}' >Reject</a>
                            @else
                            
                            @if($agreed ==false && $rejected ==false && $actionReply)
                            @if($actionReply->is_offer_from_traveller == 1 && $actionReply->buyer_id == auth()->user()->id)
                            <a href="{{action('Offers@offerAcceptedByBuyer', $actionReply->id)}}" class="btn white-bg green-text green-border btn-block square-border push-up-5 push-down-5">Accept</a>
                            <a type="button" class="btn white-bg blue-text blue-border btn-block square-border" tabindex="0" data-toggle="popover" data-placement="top" title='<h4 class="text-center">Reason for Rejecting the offer</h4>' data-content='{!! Form::open(["url"=> action("Offers@rejectOffer"), "class"=> "offer_rejected_by_user"]) !!} {!! Form::hidden("id", $offer->id) !!} {!! Form::hidden("is_offer_from_buyer", 1) !!} {!! Form::hidden("is_offer_from_traveller", 0) !!} <p class="black-text">I rejected the offer. Because-</p>{!! Form::text("reason", null, ["class"=> "form-control", "placeholder"=> "Please write your reason to reject the offer", "required"=> "required"]) !!} {!! Form::submit("Submit", ["class"=> "btn green-bg white-text square-border push-up-5 push-down-5 pull-right"]) !!} {!! Form::close() !!}' >Reject</a>
                            @endif
                            @endif
                            
                            @endif
                            
                        </ul>
                    </div>
                </div>
                
                @include('user.partials.offer-replies')
                
                
            </li>
            @endif
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