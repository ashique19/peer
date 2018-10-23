@extends('public.layouts.layout')
@section('title')@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif - My Travel info. @stop
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
            
            $agreed         = ($offer->is_agreed == 1) ? true : false;
            
            $actionReply    = \App\Offer::replyOf($offer->id)->orderBy('id', 'Desc')->first();
            
            ?>
            
            @if($agreed == false)
            <li class="list-group-item push-up-5 push-down-5 offer-list">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 offer-user">
                        <div class="height-200 pull-20 push-right-20">
                            <img src="@if($offer->buyer)@if($offer->buyer->user_photo){{$offer->buyer->user_photo}} @else /public/img/settings/no-image-available-3.png @endif @endif" alt="Airposted Buyer" class="pull-left img-responsive push-right-10" width="100" />
                            <p><b>@if($offer->buyer)<a href="{{action('Buyers@details', $offer->buyer_id)}}" target="_blank">{{$offer->buyer->name}}</a> @endif</b></p>
                            <p>Country: @if($offer->buyer)@if($offer->buyer->country){{$offer->buyer->country->name}}@endif @endif</p>
                            <p>Product name: {{$offer->name}}</p>
                            <p>Product URL: <a href="{{$offer->link}}" class="btn btn-default btn-rounded btn-xs" target="_blank">Open in new window</a></p>
                        </div>
                    </div>
                    <div class="col-xs-8 col-sm-3 height-200 pull-20 offer-details">
                        <a href="{{$offer->link}}" target="_blank">
                            <p class="row"><span class="col-xs-6">Product Price:</span> <span class="col-xs-6">USD {{$offer->product_price}}</span></p>
                            <p class="row"><span class="col-xs-6">Traveler Fee:</span> <span class="col-xs-6">USD @if( ($offer->offer_price * 1 - $offer->product_price * 1) < 0 ) 0 @else {{$offer->offer_price * 1 - $offer->product_price * 1 }} @endif</span></p>
                            <p class="row"><span class="col-xs-6">Airposted Fee:</span> <span class="col-xs-6">USD {{$offer->airposted_commission}}</span></p>
                            <p class="row"><span class="col-xs-6">Transaction Fee:</span> <span class="col-xs-6">USD {{$offer->transaction_charge}}</span></p>
                            <p class="row"><span class="col-xs-6">Total:</span> <span class="col-xs-6">USD {{$offer->total_price}}</span></p>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-3 no-padding push-up-20">
                        <ul class="list-group push-20 unstyled-list offer-action">
                            
                            @if($agreed == false)<a type="button" class="btn white-bg orange-text orange-border btn-block square-border push-up-5" tabindex="0" data-toggle="popover" data-placement="bottom" title='<h4 class="text-center">Make an offer</h4>' data-content='{!! Form::open(["url"=> action("Offers@offerUpdateByTraveller"), "class"=> "offer_made_by_user"]) !!} {!! Form::text("product_price", $offer->product_price, ["class"=> "form-control square-border text-center reply_price", "placeholder"=> "USD", "transaction_rate"=> $app->transaction_charge, "commission_rate"=> $app->commission]) !!} {!! Form::text("traveller_commission", null, ["class"=> "form-control square-border text-center reply_traveller_commission", "placeholder"=> "My Commission (USD)", "title"=> "Traveler Commission (USD)"]) !!} <p>Transaction Charge ({{$app->transaction_charge}}% + 0.30 USD): <span class="reply_transaction_charge">0</span></p><p>Airposted Commission ({{$app->commission}}%): <span class="reply_airposted_commission">0</span></p><p>Total: <span class="reply_total">0</span></p> {!! Form::text("note", null, ["class"=> "form-control square-border text-center push-up-10", "placeholder"=> "Note"]) !!} {!! Form::hidden("id", $offer->id) !!} <p class="text-center black-text message"></p>{!! Form::submit("Send Offer", ["class"=> "btn blue-bg white-text square-border btn-block push-up-10"]) !!} {!! Form::close() !!} ' >Counter Offer</a>@endif
                            
                            @if($actionReply)
                            @if($actionReply->is_offer_from_buyer == 1 && $actionReply->traveller_id ==  auth()->user()->id)
                            <a href="{{action('Offers@offerAcceptedByTraveller', $actionReply->id)}}" class="btn white-bg green-text green-border btn-block square-border push-up-5 push-down-5">Accept</a>
                            <a type="button" class="btn white-bg blue-text blue-border btn-block square-border" tabindex="0" data-toggle="popover" data-placement="top" title='<h4 class="text-center">Reason for Rejecting the offer</h4>' data-content='{!! Form::open(["url"=> action("Offers@rejectOffer"), "class"=> "offer_rejected_by_user"]) !!} {!! Form::hidden("id", $offer->id) !!} {!! Form::hidden("is_offer_from_buyer", 0) !!} {!! Form::hidden("is_offer_from_traveller", 1) !!} <p class="black-text">I rejected the offer. Because-</p>{!! Form::text("reason", null, ["class"=> "form-control", "placeholder"=> "Please write your reason to reject the offer", "required"=> "required"]) !!} {!! Form::submit("Submit", ["class"=> "btn green-bg white-text square-border push-up-5 push-down-5 pull-right"]) !!} {!! Form::close() !!}' >Reject</a>
                            @endif
                                                        
                            @endif
                            @if($offer->is_agreed == 1)<span class="badge badge-info white-text">@if($offer->is_offer_from_buyer == 1)Offer accepted by buyer @elseif($offer->is_offer_from_traveller == 1)Offer accepted by me @endif</span> @endif
                            
                        </ul>
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
                <!--        <p class="alert">{{$reply->created_at->format('M d h:i')}} - {{$reply->traveller->name}}: I will get this product for you for USD {{$reply->total_price}}.{{$reply->note}} @if($reply->is_agreed == 1)<span class="badge badge-success white-text pull-right">Offer accepted by buyer</span>@endif</p>-->
                <!--        @elseif($reply->is_offer_from_buyer == 1)-->
                <!--        <p class="alert">{{$reply->created_at->format('M d h:i')}} - {{$reply->buyer->name}}: Please bring me this product for USD {{$reply->total_price}}.{{$reply->note}} @if($agreed) @if($reply->is_agreed == 1)<span class="badge badge-info white-text pull-right">Offer accepted by me</span>@endif  @endif</p>-->
                <!--        @endif-->

                <!--    @endforeach-->
                <!--    </div>-->
                <!--    @endif-->
                <!--</div>-->
                
            </li>
            @endif
            
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