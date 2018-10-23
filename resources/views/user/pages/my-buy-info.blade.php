@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
            <div class="col-sm-3">
                <img src="{{auth()->user()->user_photo}}" alt="Profile image" class="img-responsive push-up-40">
                <h4 class="text-center push-up-20">{{auth()->user()->name}}</h4>
                <ul class="list-group border-bottom">
                    <li class="list-group-item"><a href="{{action('MyProfile@edit')}}" >Edit Profile</a></li>
                    <li class="list-group-item"><a href="{{action('MyProfile@edit')}}" >Change Password</a></li>
                </ul>
            </div>
        
            <div class="col-sm-6 col-sm-offset-1">
            
                @if($errors->any())
                <div class="alert alert-warning">
                    @foreach($errors->all() as $error)
                    <p class="black-text">{{$error}}</p>
                    @endforeach
                </div>
                @endif
                
                <h1 class="section-heading black-text">&nbsp;Post Buy</h1>
                
                {!! Form::open(['url'=> action('Buyers@storeMyBuys'), 'enctype'=> 'multipart/form-data', 'class'=> 'blue-label buy-info-post' ]) !!}
                    <section class="row">
                        <div class="col-xs-12">
                            {!! Form::label('country_id', 'My Country (where I want to receive product):') !!}
                            {!! Form::select('country_id', \App\Country::orderBy('name')->lists('name', 'id'), old('country_id'), ['class'=> 'form-control select2', 'placeholder'=> 'My Country (where I want to receive product)', 'required'=>'required']) !!}
                        </div>
                        <div class="col-xs-12">
                            {!! Form::label('amazon_url', 'Amazon url of the product you are looking for:') !!}
                            {!! Form::text('amazon_url', old('amazon_url'), ['class'=> 'form-control', 'placeholder'=> 'e.g. http://www.amazon.com/iphone']) !!}
                        </div>
                        <div class="col-xs-12">
                            {!! Form::label('other_url', "Can't find the product at Amazon ? Enter any url showing the product (optional):") !!}
                            {!! Form::text('other_url', old('other_url'), ['class'=> 'form-control', 'placeholder'=> 'e.g. http://www.ebay.com/iphone']) !!}
                        </div>
                        <div class="col-xs-12">
                            {!! Form::label('name', 'What is the name of the product?') !!}
                            {!! Form::text('name', old('name'), ['class'=> 'form-control', 'placeholder'=> 'e.g. iPhone 6s', 'required'=> 'required' ]) !!}
                        </div>
                        <div class="col-xs-12 price_area" transaction_charge="{{$app->transaction_charge}}" commission="{{$app->commission}}">
                            {!! Form::label('price', 'How much does the product cost (USD)?') !!}
                            {!! Form::text('price', old('price'), ['class'=> 'form-control price', 'placeholder'=> 'Product Price (USD)', 'required'=> 'required' ]) !!}
                            <small class="pull-right text-right">Transaction Charge ({{$app->transaction_charge}}% + 0.30 USD): <b>USD <span class="total_transaction_charge">0</span></b><br> Airposted Commission ({{$app->commission}}%): <b>USD <span class="total_commission">0</span></b><br> Total: <b>USD <span class="total_price">0</span></b> </small>
                        </div>
                        <div class="col-xs-12">
                            {!! Form::label('category_id', 'Our travelers carry certain items. Select your product category:') !!}
                            {!! Form::select('category_id', \App\Category::lists('name', 'id'), old('category_id'), ['class'=> 'form-control select2', 'placeholder'=> 'Select the category for this product', 'required'=> 'required']) !!}
                            </div>
                        <div class="col-xs-12">
                            {!! Form::label('picture', 'Upload an image of your product (optional):') !!}
                            <div class="col-xs-12 form-control upload-image"> {!! Form::file('picture', old('picture'), ['class'=> 'file']) !!}</div>
                        </div>
                    </section>
                    
                
                    <section class="col-xs-12">
                        <p class="text-justify push-up-20">
                            <b class="blue-text">Note:</b><br>
                            After posting your Buy details, please search for a traveler or wait to hear back from one. 
                            Then send your selected traveler a request. The traveler enjoys the privilege to send you 
                            his carrying fee & updated product price(adding Taxes & local Shipping charges if applicable) 
                            the first time, after which you can send Counter Offers. Please negotiate a competitive and 
                            reasonable fee that works for both of you. Once the traveler Accepts your Offer or you 
                            Accept his, please Pay us for the total amount. We will hold your money in our escrow until 
                            your traveler delivers you the product. 
                            <br><br>
                            Finally, please leave a feedback and check the delivered box when you receive 
                            the product, for a successful & smooth transaction.
                        </p>
                    </section>
                    
                    <section class="row">
                        <div class="col-xs-12 text-center">{!! Form::submit('Post Buy', ['class'=>'btn btn-lg green-bg white-text']) !!}</div>
                    </section>
                    {!! Form::close() !!}
                
            </div>
        </div>
        
        <div class="col-xs-12 push-up-50 scroll">
            <table class="table table-responsive text-center">
                <thead>
                    <tr>
                        <th>Post Date</th>
                        <th>Country</th>
                        <th>Product Name</th>
                        <th>Price (USD)</th>
                        <th>Category</th>
                        <th>Amazon url</th>
                        <th>Other url</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($myBuys) > 0)
                    @foreach($myBuys as $myBuy)
                    <tr>
                        <td>{{$myBuy->created_at->format('Y-m-d')}}</td>
                        <td>@if($myBuy->country){{$myBuy->country->name}} @endif</td>
                        <td>{{$myBuy->name}}</td>
                        <td>{{$myBuy->price}}</td>
                        <td>@if($myBuy->category){{$myBuy->category->name}} @endif</td>
                        <td><a @if(strlen(trim($myBuy->amazon_url))>0) href="{!! $myBuy->amazon_url !!}" @endif class="btn transparent-bg @if(strlen(trim($myBuy->amazon_url))>0) green-border @else orange-border @endif btn-rounded btn-xs" target="_blank">open in new window</a></td>
                        <td><a @if(strlen(trim($myBuy->other_url))>0) href="{!! $myBuy->other_url !!}" @endif class="btn transparent-bg @if(strlen(trim($myBuy->other_url))>0) green-border @else orange-border @endif btn-rounded btn-xs" target="_blank">open in new window</a></td>
                        <td>
                            {!! Form::open(['url'=> action('Buyers@removeMyPost', $myBuy->id), 'method'=> 'POST']) !!}
                            <button role="button" type="submit" class="btn btn-rounded btn-danger">X</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            {!! $myBuys->render() !!}
        </div>
        
    </div>
</section>


@stop