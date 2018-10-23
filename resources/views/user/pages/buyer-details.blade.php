@extends('public.layouts.layout')
@section('title')@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif - My Travel info. @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        {!! errors($errors) !!}
        
        <div class="col-xs-12 no-padding">
            
            <div class="col-sm-3 no-padding">
                <ul class="user-action-ul profile-nav">
                    <li class="user-actions">
                        <img src="{{$buyer->user_photo}}" alt="Profile Photo" class="img-responsive profile-img">
                    </li>
                    <li class="user-actions">
                        <a>{{$buyer->city}}, {{$buyer->state}} @if($buyer->country){{$buyer->country->name}} @endif</a>
                    </li>
                    <li class="user-actions">
                        <a href="#" class="btn btn-lg btn-block blue-bg white-text"  data-toggle="modal" data-target="#message{{$buyer->id}}" >Message <img src="/public/img/settings/chat-icon.png" alt=" - " width="30" /> </a>
                        
                        @section('bodyScope')
                        
                        <div class="modal fade modal-theme-1" id="message{{$buyer->id}}" tabindex="-1" role="dialog" aria-labelledby="message">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    
                                    <aside class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </aside>
                                    
                                    <article class="modal-body no-padding">
                                        
                                        {!! Form::open([ 'url'=> action('UserChats@store', $buyer->id), 'class'=> 'send-message', 'enctype'=> "multipart/form-data" ]) !!}
                                        <section class="row send-message-heading">
                                            <h2>Messenger</h2>
                                            <h5>To [{{$buyer->name}}]</h5>
                                        </section>
                                        
                                        <section class="login-area row send-message-details">
                                            
                                            <div class="col-xs-12 no-padding">
                                                {!! Form::textarea('name', null, ['class'=> 'form-control', 'placeholder'=> 'Message', 'required'=> 'required']) !!}
                                                
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
                        
                        @stop
                        
                    </li>
                </ul>
            </div>
            
            <div class="col-sm-9 push-up-80 form-theme-1">
                <section class="row white-bg">
            
                    <h1>Hey, I'm {{$buyer->name}} !</h1>
                    <h4 class=" pull-5">Member since {{$buyer->created_at->format('F Y')}}</h4>
                    
                    <h2 class=" push-up-30">About me</h2>
                    <p>{{$buyer->note}}</p>
                    
                </section>
                
                <section class="row white-bg scrollable">
    
                    <h2 class=" push-up-30">My Buys</h2>
                    
                    <table class="table table-responsive table-theme-1">
                        <thead>
                            <tr>
                                <th>Send Request</th>
                                <th>Post Date</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Country</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if( count($buys) > 0 )
                            @foreach( $buys as $buy)
                            
                            <tr>
                                <td>
                                    @if($buyer->user_id != auth()->user()->id)
                                    
                                    @if( traveler_fee( $buy, auth()->user() ) > 0 )
                                    
                                    <a href="#" class="btn" data-toggle="modal" data-target="#send-buy-request-{{$buy->id}}">
                                        <img src="/public/img/settings/send-icon.png" alt="Send Request" class="img-responsive">
                                    </a>
                                    
                                    <div class="modal fade modal-theme-1" id="send-buy-request-{{$buy->id}}" tabindex="-1" role="dialog" aria-labelledby="offer">
                                        <div class="modal-dialog modal-md" role="document">
                                            <div class="modal-content">
                                                
                                                <aside class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </aside>
                                                
                                                <article class="modal-body no-padding">
                                                    
                                                    {!! Form::open(['url' => action('Offers@postOfferFromBuyerSearch'), 'method'=>'POST', 'class'=> 'post-offer-from-buyer-search']) !!}
                                    
                                                    {!! Form::hidden('name', $buy->name) !!}
                                                    {!! Form::hidden('link', $buy->amazon_url) !!}
                                                    {!! Form::hidden('image_url', $buy->image_url) !!}
                                                    {!! Form::hidden('buyer_id', $buy->user->id) !!}
                                                    {!! Form::hidden('product_price', $buy->price) !!}
                                                    {!! Form::hidden('traveller_commission', traveler_fee( $buy, auth()->user() )) !!}
                                                    
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
                    
                                                            <span class="push-right-20">Carrying Fee</span> $ {!! Form::text('not_required', traveler_fee( $buy, auth()->user() ) , ['class'=> 'slim-form-control offer-price', 'min'=> env('MIN_TRAVELER_COMMISSION'), 'disabled'=> '']) !!}
                                                            
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
                                    
                                    @else
                                    
                                    Unknown carrying fee
                                    
                                    @endif
                                    
                                    @endif
                                    
                                </td>
                                <td>{{$buy->created_at->format('m/d/Y')}}</td>
                                <td>{{$buy->name}}</td>
                                <td>${{$buy->price}}</td>
                                <td>@if($buy->category){{$buy->category->name}} @endif</td>
                                <td>@if($buy->country){{$buy->country->name}} @endif</td>
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