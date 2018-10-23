@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <h1 class="section-heading black-text">Favorite</h1>
        
        <div class="col-sm-6 col-sm-offset-3">
            @if($errors->any())
            
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                <p class="black-text">{{$error}}</p>
                @endforeach
            </div>
            @endif
        </div>
        
        <div class="col-xs-12 push-up-50 no-padding">
            <div class="col-xs-12 search-result-area">
                
                @if( session('user_type') == 'traveller' && count($buyers) > 0)
                <h4 class="green-bg pull-10 white-text">Favorite Buyers:</h4>
                <section class="row">
                @foreach($buyers as $buyer)
                <div class="col-sm-3 panel-body text-center push-up-20 push-down-20 buyer-item">
                    <div class="img-holder">
                        <img src="@if(strlen($buyer->image_url)>0){{$buyer->image_url}} @else /public/img/settings/no-image-available.png @endif"></img>
                        <p><a href="{{action('Buyers@details', $buyer->user_id)}}" class="link white-text" data-toggle="tooltip" data-placement="top" title="See my profile and all requested items">{{$buyer->user->name}}@if($buyer->country), {{$buyer->country->name}}@endif</a></p>
                    </div>
                    <h4>
                        <a type="button" data-container="body" data-toggle="popover" data-trigger="focus" tabindex="0" data-placement="top" data-content='<div class="row text-center"><a @if($buyer->amazon_url)href="{!! $buyer->amazon_url !!}"@endif target="_blank" class="btn green-bg white-text btn-block">Product Link at Amazon</a><a @if($buyer->other_url)href="{{ $buyer->other_url }}"@endif target="_blank" class="btn green-bg white-text btn-block">Product Link at Else Where</a></div>'><span data-toggle="tooltip" data-placement="bottom" title="Click to see the links">{{$buyer->name}}</span></a>    
                        <br>
                        <small>USD {{$buyer->price}}</small>
                        
                    </h4>
                    <p class="push-up-10">
                        @if($buyer->user_id != auth()->user()->id)
                        <a href="#" class="pull-left hover remove-buyer-from-list" b_id="{{$buyer->id}}" b_name="{{$buyer->name}}"><i class="fa fa-star fa-2x green-text"></i> Remove from list</a>
                        <a href="#" class="pull-right hover" data-toggle="modal" data-target="#buyer{{$buyer->id}}" type="button"><i class="fa fa-paper-plane fa-2x blue-text"></i> Send Request</a>
                        @endif
                    </p>
                </div>
                
                @if($buyer->user_id != auth()->user()->id)
                <div class="modal fade green-modal" id="buyer{{$buyer->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content" id="buyer-modal-group{{$buyer->id}}" role="tablist" aria-multiselectable="true">
                          <div class="row">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          {!! Form::open(['url' => action('Offers@postOfferFromBuyerSearch'), 'method'=>'POST', 'class'=> 'post-offer-from-buyer-search']) !!}
                          {!! Form::hidden('name', $buyer->name) !!}
                          {!! Form::hidden('link', $buyer->amazon_url) !!}
                          {!! Form::hidden('image_url', $buyer->image_url) !!}
                          {!! Form::hidden('buyer_id', $buyer->user->id) !!}
                          <h2>Hi {{$buyer->user->name}},</h2>
                          <p>I would like to buy this product for you. <b>My Offer is -</b></p>
                          <p class="text-right" transaction_rate="{{$app->transaction_charge}}" commission_rate="{{$app->commission}}">
                              Product Price: (USD) <a type="button" data-toggle="tooltip" data-placement="top" title="Please write the final product price, including Tax and local Shipping charges, if applicable."> ( ? )</a> <input type="text" name="product_price" title="Product Price" class="white-text blue-bg green-border buyer_price_offer" value="{{$buyer->price}}">
                              <br>
                              My Commission: (USD) <a type="button" data-toggle="tooltip" data-placement="top" title="Please write the carrying fee. Be competitive & reasonable to win you buyer's attention and deal."> ( ? ) </a> <input type="text" title="My Commision" value="{{$buyer->price*0.1}}" name="traveller_commission" class="offer-price buyer_commission_offer white-text green-border">
                              <br>
                              Total Offer Price: USD <span class="get_offer_price">0</span>
                              <br>
                              Transaction Charge ({{$app->transaction_charge}}% + 0.30 USD): USD <span class="get_transaction_charge">0</span>
                              <br>
                              Airposted Commission ({{$app->commission}}%): USD <span class="get_commission">0</span>
                              <br>
                              Total: USD <span class="get_total">0</span>&nbsp;
                          </p>
                          <p>Please let me know as soon as possible if you agree with this.</p>
                          <p class="text-center message"></p>
                          <button type="submit" class="btn square-border submit-request">Send Offer</button>
                          {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                @endif
                
                @endforeach
                </section>
                
                @elseif(session('user_type') == 'buyer')
                
                @if(count($products) > 0)
                <h4 class="green-bg pull-10 white-text">Favorite Products:</h4>
                <section class="row">
                @foreach($products as $product)
                <div class="col-sm-3 panel-body text-center push-up-20 push-down-20 product-item" >
                    <div class="img-holder">
                        <a href="{{$product->image_url}}" target="_blank">
                            <img src="@if($product->image_url){{$product->image_url}}@else /public/img/settings/no-image-available.png @endif"></img>
                        </a>
                    </div>
                    <a href="{{$product->image_url}}" target="_blank">
                        <h4 data-toggle="tooltip" data-placement="top" title="{{$product->name}}">{{substr($product->name, 0, 50)}}</h4>
                    </a>
                    <p class="blue-text">Price : USD {{$product->price}}</p>
                    <p class="push-up-10">
                        <a href="#" class="pull-left remove-product-from-list hover" p_id="{{$product->id}}" p_name="{{$product->name}}" p_price="{{$product->price}}" p_image="@if($product->image_url){{$product->image_url}}@else /public/img/settings/no-image-available.png @endif" p_link="{{$product->image_url}}"><i class="fa fa-star fa-2x green-text"></i> Remove from list</a>
                        <a href="#" class="pull-right hover" data-toggle="modal" data-target="#modal-parent-{{str_slug(substr($product->name, 0, 20), '-')}}-{{round($product->price)}}" type="button"><i class="fa fa-paper-plane fa-2x blue-text"></i> Send Request</a>
                    </p>
                </div>
                
                <div class="modal fade green-modal" id="modal-parent-{{str_slug(substr($product->name, 0, 20), '-')}}-{{round($product->price)}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content" id="modal-content-{{str_slug(substr($product->name, 0, 20), '-')}}-{{round($product->price)}}" role="tablist" aria-multiselectable="true">
                      {!! Form::open(['url'=> action('Offers@postOfferFromProductSearch'), 'method'=> 'POST', 'class'=> 'offer-from-product-search' ]) !!}
                      <h4 class="white-text">Send Buying Request to Traveler</h4>
                      
                      <p class="text-left">Product: {{$product->name}}
                          <span class="text-right pull-right">
                              Price: USD {{$product->price}} <br>
                              Transaction Charge: USD {{round($product->price * $app->transaction_charge / 100 ,2)}} <br>
                              Airposted Commission: USD {{round($product->price * $app->commission / 100 ,2)}} <br>
                              Total: USD {{$product->price * 1 + round($product->price * $app->transaction_charge / 100 ,2) + round($product->price * $app->commission / 100 ,2)}}
                          </span>
                      </p>
                      <button class="btn btn-block white-bg square-border" role="button" data-toggle="collapse" data-parent="#modal-content-{{str_slug(substr($product->name, 0, 20), '-')}}-{{round($product->price)}}" href="#modal-item-{{str_slug(substr($product->name, 0, 20), '-')}}-{{round($product->price)}}" aria-expanded="true" aria-controls="modal-item-{{str_slug(substr($product->name, 0, 20), '-')}}-{{round($product->price)}}">Choose Traveler from your favorite list</button>
                      <div class="row collapse favorite-traveller-list" id="modal-item-{{str_slug(substr($product->name, 0, 20), '-')}}-{{round($product->price)}}" role="tabpanel" aria-labelledby="favorite-products-for-product1">
                          <p class="text-center">
                              <a href="{{action('Travels@travellerSearchByBuyer')}}" class="btn square-border" target="_blank">You did not add any traveler to your favorite list. Click to add now.</a>
                          </p>
                      </div>
                      {!! Form::hidden('name', $product->name) !!}
                      {!! Form::hidden('price', $product->price ) !!}
                      {!! Form::hidden('link', $product->image_url ) !!}
                      <input type="text" name="image_url" class="hidden" value="@if($product->image_url){{$product->image_url}}@else /public/img/settings/no-image-available.png @endif" />
                      <p class="text-center message"></p>
                      <button type="submit" class="btn square-border submit-request">Send Request</button>
                      or
                      <a href="{{action('Travels@travellerSearchByBuyer')}}" class="btn square-border">Find Traveler</a>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
                @endforeach
                </section>
                @endif
                
                @if(count($travellers) > 0)
                
                <h4 class="green-bg pull-10 white-text">Favorite Travelers:</h4>
                <section class="row">
                @foreach($travellers as $traveller)
                <div class="col-sm-3 panel-body text-center push-up-20 push-down-20 travel-item">
                    <div class="img-holder">
                        <img src="{{$traveller->user->user_photo}}"></img>
                        <p><a href="{{action('Travels@travellerDetails', $traveller->user_id)}}" class="white-text">Traveler Details</a></p>
                    </div>
                    <h4><a href="{{action('Travels@travellerDetails', $traveller->user_id)}}">{{$traveller->user->name}}</a></h4>
                    <p class="col-sm-6"><small>Arr: {{$traveller->departure_date->format('d-M-Y')}}</small></p>
                    <p class="col-sm-6"><small>Dept: {{$traveller->arrival_date->format('d-M-Y')}}</small></p>
                    @if($traveller->airportFrom)<p><small>From: <span class="green-text">{{$traveller->airportFrom->name}}</span></small></p>@endif
                    @if($traveller->airportTo)<p><small>To: <span class="green-text">{{$traveller->airportTo->name}}</span></small></p>@endif
                    <p class="push-up-10">
                        <a href="#" class="pull-left hover remove-traveller-from-list" t_id="{{$traveller->id}}" t_name="{{$traveller->name}}"><i class="fa fa-star fa-2x green-text"></i> Remove from list</a>
                        <a href="#" class="pull-right hover" data-toggle="modal" data-target="#traveller{{$traveller->id}}" type="button"><i class="fa fa-paper-plane fa-2x blue-text"></i> Send Request</a>
                    </p>
                </div>
                <div class="modal fade green-modal" id="traveller{{$traveller->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content" id="traveller-modal-group{{$traveller->id}}" role="tablist" aria-multiselectable="true">
                          <div class="row">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          </div>
                          {!! Form::open(['url'=> action('Offers@postOfferFromBuyer'), 'method'=> 'POST', 'class'=> 'offer-from-traveller-page']) !!}
                          {!! Form::hidden('traveller', $traveller->user->id) !!}
                          <h2>Send Request to Traveler</h2>
                          <button class="btn btn-block white-bg square-border" role="button" data-toggle="collapse" data-parent="#traveller-modal-group{{$traveller->id}}" href="#favorite-products-for-traveller{{$traveller->id}}" aria-expanded="true" aria-controls="favorite-products-for-traveller{{$traveller->id}}">Choose product from your favorite list</button>
                          <div class="row collapse favorite-product-list" id="favorite-products-for-traveller{{$traveller->id}}" role="tabpanel" aria-labelledby="favorite-products-for-traveller{{$traveller->id}}">
                              <p class="text-center">
                                  <a href="{{action('Amazons@productSearch')}}" class="btn square-border">You did not add any product to your favorite list. Click to add now.</a>
                              </p>
                          </div>
                          <p>Or</p>
                          <button class="btn btn-block white-bg square-border" role="button" data-toggle="collapse" data-parent="#traveller-modal-group{{$traveller->id}}" href="#manual-products-for-traveller{{$traveller->id}}" aria-expanded="true" aria-controls="favorite-products-for-traveller{{$traveller->id}}">Send your Product URL</button>
                          <div class="row collapse" id="manual-products-for-traveller{{$traveller->id}}" role="tabpanel" aria-labelledby="manual-products-for-traveller{{$traveller->id}}">
                              <p><input type="text" class="manual_name form-control" placeholder="product's name"></p>
                              <p><input type="text" class="manual_link form-control" placeholder="url"></p>
                              <p><input type="text" class="manual_price form-control" placeholder="price in USD"></p>
                              <p><input type="text" class="manual_traveller_commission form-control hidden" placeholder="Traveler commission in USD" value="0"></p>
                              <p class="text-right blue-text" transaction_rate="{{$app->transaction_charge}}" commission_rate="{{$app->commission}}">
                                  Transaction Charge ({{$app->transaction_charge}}% + 0.30 USD): USD <span class="manual_transaction_charge">0</span>
                                  <br>
                                  Airposted Commission ({{$app->commission}}%): USD <span class="manual_airposted_commission">0</span>
                                  <br>
                                  Total: USD <span class="manual_total">0&nbsp;</span>
                              </p>
                              <p><input type="text" class="manual_image form-control" placeholder="image url of the product (optional)"></p>
                          </div>
                          <p class="text-center message"></p>
                          <button type="submit" class="btn square-border submit-request">Send Request</button>
                          {!! Form::close() !!}
                          <p class="push-up-20 text-justify">
                              Once you send request to the traveler, please wait for him to 
                              send you a Counter Offer(with his carrying fee & updated product 
                              price with Tax and local shipping charges if applicable). Once 
                              traveler sends you his Counter Offer, you will be able to Accept, 
                              Reject or Counter it. When sending a Counter Offer, please be 
                              reasonable & competitive to attract the traveler & win the deal.
                          </p>
                        </div>
                      </div>
                    </div>
                @endforeach
                </section>
                @endif
                
                @endif
                
            </div>
            
        </div>
        
    </div>
</section>


@stop