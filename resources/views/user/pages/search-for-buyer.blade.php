@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

@section('bodyScope') @include('user.partials.tour-buyer-search') @stop

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <h1 class="section-heading black-text">Buyers</h1>
        
        <div class="row search-area" id="buyer-search">
            {!! Form::open([ 'url'=> action('Buyers@postBuyerSearchByTraveller'), 'method'=>'POST', 'class'=> 'form-inline text-center' ]) !!}
            
            <div class="col-xs-12 col-sm-3 no-padding text-left">
                <p>Product</p>
                {!! Form::text('keyword', null, ['class'=> 'form-control push-up-15', 'placeholder'=> 'Search for Product']) !!}
            </div>
            
            <div class="col-xs-12 col-sm-3 no-padding text-left">
                <p>Category</p>
                {!! Form::select('categories[]', $categories->lists('name'), null, ['class'=> 'form-control select2', 'placeholder'=> 'Product Categories']) !!}
            </div>
            
            <div class="col-xs-12 col-sm-3 no-padding text-left">
                <p>From</p>
                {!! Form::select('country', $countries->lists('name', 'id'), null, ['class'=> 'form-control select2', 'placeholder'=> 'Country']) !!}
            </div>
            
            <div class="col-xs-12 col-sm-3 no-padding text-right">
                <h5 class="no-margin"> &nbsp;&nbsp;&nbsp; </h5>
                {!! Form::submit('Search', ['class'=> 'btn btn-lg orange-bg white-text']) !!}
            
            </div>
            
            {!! Form::close() !!}
        </div>
        
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            @if($errors->any())
            
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                <p class="black-text">{{$error}}</p>
                @endforeach
            </div>
            @endif
        </div>
        
        <div class="col-xs-12 push-up-50 no-padding">
            
            <div class="col-sm-12 search-result-area">
                @if(count($buyers) > 0)
                @foreach($buyers as $buyer)
                
                <div class="col-sm-3 panel-body text-center push-up-20 push-down-20 search-item">
                    <div class="row">
                        <div class="img-holder" >
                            <img src="@if(strlen($buyer->image_url)>5){{$buyer->image_url}} @else /public/img/settings/product-image-available.jpg @endif"></img>
                            <a @if( strlen(trim($buyer->amazon_url)) > 0 ) href="{!! $buyer->amazon_url !!}" @else href="{!! $buyer->other_url !!}" @endif target="_blank" >
                                <span class="profile btn">View Link</span>
                            </a>
                        </div>
                        
                        <h4><a href="{{action('Buyers@details', $buyer->user_id)}}">{{$buyer->user->name}}</a></h4>
                        
                        <div class="col-xs-12">
                            @if( $buyer->user_id != auth()->user()->id )
                            @if( traveler_fee( $buyer, auth()->user() ) > 0 )
                            <h5 class="text-center green-text">Carry it for ${{ traveler_fee( $buyer, auth()->user() ) }}</h5>
                            @else
                            <h5 class="text-center green-text">Unknown carrying fee</h5>
                            @endif
                            @endif
                            <p class="text-justified small">
                                Weight: {{ $buyer->p_weight }}lb, Dimension: {{ $buyer->p_length}} inch * {{ $buyer->p_width }} inch * {{ $buyer->p_height }} inch
                            </p>
                        </div>
                        
                        <div class="row no-padding" data-toggle="tooltip" data-placement="bottom" title="{{$buyer->name}}">
                        <div class="col-xs-12 col-sm-6 message-request pull-right-5">
                            @if($buyer->user_id != auth()->user()->id)
                            @if( traveler_fee( $buyer, auth()->user() ) > 0 )
                            <a href="#" class="pull-left btn btn-block btn-xs black-bg white-text offer-buyer" data-toggle="modal" data-target="#buyer{{$buyer->id}}">Send Request <img src="/public/img/settings/offer-icon.png" alt="proceed"></a>
                            @endif
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6 message-request pull-left-5">
                            @if($buyer->user_id != auth()->user()->id)
                            <a href="#" class="pull-right btn btn-block btn-xs blue-bg white-text message-buyer" data-toggle="modal" data-target="#message{{$buyer->id}}">Message <img src="/public/img/settings/chat-icon.png" alt="proceed"></a>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-4 message-request">
                            <p>
                                <b>From</b>
                                @if($buyer->country){{$buyer->country->name}} @endif
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-4 message-request">
                            <p>
                                <b>Product</b>
                                @if(strlen($buyer->name) > 16){{substr($buyer->name, 0, 16)}}.. @else {{$buyer->name}} @endif
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-4 message-request">
                            <p>
                                <b>Price</b>
                                USD ${{$buyer->price}}
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
                
                
                @if($buyer->user_id != auth()->user()->id)
                
                @if( traveler_fee( $buyer, auth()->user() ) > 0 )
                
                <div class="modal fade modal-theme-1" id="buyer{{$buyer->id}}" tabindex="-1" role="dialog" aria-labelledby="offer">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            
                            <aside class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </aside>
                            
                            <article class="modal-body no-padding">
                                
                                {!! Form::open(['url' => action('Offers@postOfferFromBuyerSearch'), 'method'=>'POST', 'class'=> 'post-offer-from-buyer-search']) !!}
                                    
                                {!! Form::hidden('name', $buyer->name) !!}
                                {!! Form::hidden('link', $buyer->amazon_url) !!}
                                {!! Form::hidden('image_url', $buyer->image_url) !!}
                                {!! Form::hidden('buyer_id', $buyer->user->id) !!}
                                {!! Form::hidden('product_price', $buyer->price) !!}
                                {!! Form::hidden('traveller_commission', traveler_fee( $buyer, auth()->user() )) !!}
                                
                                <section class="row text-center">
                                    <h2>Send Request</h2>
                                </section>
                                
                                <section class="login-area row text-center">
                                    
                                    <div class="col-xs-12 no-padding push-up-40 push-down-40">
                                        
                                        <i class="col-xs-12 small text-left push-down-20">
                                            Note: After you send request to your buyer, please wait for 
                                            him to accept your request and pay. Once paid, 
                                            please buy and carry the product.
                                            <br>
                                            <br>
                                            Tax/Duty/Sales tax is not included in the carrying fee. If you pay 
                                            tax/duty at the customs save your receipt and show it to your buyer 
                                            when making delivery. They should reimburse you. If they do not, 
                                            DO NOT deliver the product and let us know. We’ll open a case. 
                                            <br>
                                            Unsure about the tax rates? Shoot us an email.
                                        </i>

                                        <span class="push-right-20">Carrying Fee</span> $ {!! Form::text('not_required', traveler_fee( $buyer, auth()->user() ) , ['class'=> 'slim-form-control offer-price', 'min'=> env('MIN_TRAVELER_COMMISSION'), 'disabled'=> '']) !!}
                                        
                                    </div>

                                    <div class="col-xs-12 text-center">
                                        <p class="small message"></p>
                                        <button type="submit" class="btn btn-sm white-text blue-bg">Send</button>
                                    </div>
                                    
                                </section>
                                
                                {!! Form::close() !!}
                                
                            </article>
                            
                        </div>
                    </div>
                </div>
                
                @endif
                
                <div class="modal fade modal-theme-1" id="message{{$buyer->id}}" tabindex="-1" role="dialog" aria-labelledby="message">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            
                            <aside class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </aside>
                            
                            <article class="modal-body no-padding">
                                
                                {!! Form::open([ 'url'=> action('UserChats@store', $buyer->user_id), 'class'=> 'send-message', 'enctype'=> "multipart/form-data" ]) !!}
                                <section class="row send-message-heading">
                                    <h2>Messenger</h2>
                                    <h5>To [{{$buyer->user->name}}]</h5>
                                </section>
                                
                                <section class="login-area row send-message-details">
                                    
                                    <div class="col-xs-12 no-padding">
                                        {!! Form::textarea('name', null, ['class'=> 'form-control', 'placeholder'=> 'type message here…', 'required'=> 'required']) !!}
                                        
                                        <p class="small message"></p>
                                        
                                    </div>
                                    <div class="col-xs-12 col-sm-6 no-padding push-up-20">
                                        <a class="push-up-20 darkGray-text" href="{{action('UserChats@indexAndOffers')}}" >View my Inbox</a>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-6 no-padding text-right push-up-20">
                                        <button type="submit" class="btn btn-sm white-text blue-bg">Send</button>
                                    </div>
                                    
                                </section>
                                
                                <section class="row message-success hidden">
                                    <figure class="text-right">
                                        <img src="/public/img/settings/message-success.png" alt="Hurrahhh!">
                                    </figure>
                                    <figcaption>Message Sent!</figcaption>
                                    <figdetails>Head to your inbox to see all your messages.</figdetails>
                                    <p class="text-center"><a href="{{action('UserChats@indexAndOffers')}}">View my inbox</a></p>
                                </section>
                                
                                {!! Form::close() !!}
                                
                            </article>
                            
                        </div>
                    </div>
                </div>

                
                @endif
                
                @endforeach
                
                {!! $buyers->render() !!}
                
                @else
                <h4>No Buyer was found.</h4>
                @endif
                
            </div>
            
        </div>
        
    </div>
</section>


@stop