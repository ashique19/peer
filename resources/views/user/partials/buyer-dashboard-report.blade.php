@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
            <div class="col-sm-3 col-md-2 no-padding">
                <ul class="user-action-ul">
                    <li class="user-actions active"><a href="{{route('userDashboard')}}" >Post</a></li>
                    <li class="user-actions"><a href="{{action('Buyers@oldBuyPosts')}}" >Active</a></li>
                </ul>
            </div>
        
            <div class="col-sm-9 col-md-10">
            
                <h1 class="section-heading blue-text">Welcome to Airposted {{auth()->user()->firstname}}!</h1>
                <h2 class="section-heading black-text small-heading">Post a Buy</h2>
                
                @if( $errors->any() && ! $errors->has('user_type') )
                <div class="row">
                @foreach( $errors->all() as $error )
                <p class="alert alert-info">{{ $error }}</p>
                @endforeach
                </div>
                @endif
                
                {!! Form::open(['url'=> action('Buyers@storeMyBuys'), 'enctype'=> 'multipart/form-data', 'class'=> 'blue-label buy-info-post' ]) !!}
                    <section class="row product-picker">
                        <div class="col-xs-12 col-sm-6 col-md-5">
                            {!! Form::label('country_id', 'Country') !!}
                            {!! Form::select('country_id', \App\Country::orderBy('name')->lists('name', 'id'), old('country_id'), ['class'=> 'form-control select2 get_cities', 'placeholder'=> 'Select the location where you want to receive the product.', 'required'=>'required']) !!}
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                            {!! Form::label('city_id', 'City') !!}
                            {!! Form::select('city_id', [], old('city_id'), ['class'=> 'form-control select2', 'placeholder'=> 'Select the city where you want to receive the product.']) !!}
                        </div>
                        
                        <div class="col-xs-12 no-padding">
                            <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                                {!! Form::label('amazon_url', 'Amazon url of the product you are looking for:') !!}
                                {!! Form::text('amazon_url', old('amazon_url'), ['class'=> 'form-control', 'placeholder'=> 'e.g. http://www.amazon.com/iphone']) !!}
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20">
                                {!! Form::label('other_url', "Can't find at Amazon?") !!}
                                {!! Form::text('other_url', old('other_url'), ['class'=> 'form-control', 'placeholder'=> ' Enter any url showing the product (optional)']) !!}
                            </div>
                        </div>
                        
                        <div class="col-xs-12 no-padding">
                            
                            <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20 image-chooser-area">
                                
                                <div class="image-chooser row">
                                    
                                    {!! Form::label('image_url', 'Choose/Upload an image for your post:') !!}
                                    
                                    <div class="upload">
                                        <input type="file" id="img_for_amazon">
                                        <i class="fa fa-plus"></i>
                                        <small>Upload your own</small>
                                    </div>
                                    <div class="fetch" id="fetch_from_amazon">
                                        <p>Fetch from Amazon</p>
                                    </div>
                                    <div class="amazon_preview">
                                        <input type="radio" name="image_url" checked />
                                        <img src="" alt="Preview" id="amazon_img_preview">
                                        <small class="message"></small>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20 image-chooser-area">
                                
                                <div class="image-chooser row">
                                    
                                    {!! Form::label('image_url', 'Upload an image for your post:') !!}
                                    
                                    <div class="upload">
                                        <input type="file" id="img_for_non_amazon">
                                        <i class="fa fa-plus"></i>
                                        <small>Upload your own</small>
                                    </div>
                                    <div class="preview">
                                        <img src="" alt="Preview" id="non_amazon_img_preview">
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                            {!! Form::label('name', 'What is the name of the product?') !!}
                            {!! Form::text('name', old('name'), ['class'=> 'form-control', 'placeholder'=> 'e.g. iPhone 6s', 'required'=> 'required' ]) !!}
                        </div>
                        <div class="col-xs-6 col-sm-5 col-sm-offset-1 price_area pull-up-20" transaction_charge="{{$app->transaction_charge}}" commission="{{$app->commission}}">
                            
                            {!! Form::label('price', 'How much does the product cost (USD)?') !!}
                            {!! Form::text('price', old('price'), ['class'=> 'form-control price', 'placeholder'=> 'Product Price (USD)', 'required'=> 'required' ]) !!}
                            
                            <!--<div class="price_summary">-->
                            <!--    <p>-->
                            <!--        Airposted Fee <span class="pull-right">$<span class="total_commission">0</span></span>-->
                            <!--        <p class="small">({{$app->commission}}%)</p>-->
                            <!--    </p>-->
                            <!--    <p>-->
                            <!--        Paypal Fee <span class="pull-right">$<span class="total_transaction_charge">0</span></span>-->
                            <!--        <p class="small">({{$app->transaction_charge}}% + {{env('FIXED_TRANSACTION_CHARGE')}} USD)</p>-->
                            <!--    </p>-->
                            <!--    <p>-->
                            <!--        <b>-->
                            <!--            Total USD <span class="pull-right"><span class="total_price">0</span></span>-->
                            <!--        </b>-->
                            <!--    </p>-->
                            <!--</div>-->
                            
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                            {!! Form::label('category_id', 'Our travelers carry certain items.') !!}
                            {!! Form::select('category_id', \App\Category::lists('name', 'id'), old('category_id'), ['class'=> 'form-control select2', 'placeholder'=> 'Select the category for this product', 'required'=> 'required']) !!}
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 col-md-5 col-sm-offset-1 pull-up-20">
                            {!! Form::label('p_weight', 'Weight (lb)') !!}
                            {!! Form::text('p_weight', old('p_weight'), ['class'=> 'form-control', 'required'=> 'required']) !!}
                        </div>
                        
                        @if( strlen( \App\User::find(auth()->user()->id)->contact ) < 5 )
                        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20">
                            {!! Form::label('contact', 'Phone Number (mobile/landline)') !!}
                            <div class="row inline">
                                
                            @if(auth()->user()->country)
                            {!! Form::select('country_code', \App\Country::orderBy('phone_code')->lists('phone_code','phone_code') , auth()->user()->country->phone_code, ['class'=> 'form-control push-up-10 country_code', 'placeholder'=> '-Country code-', 'required'=> 'required']) !!}
                            @else
                            {!! Form::select('country_code', \App\Country::orderBy('phone_code')->lists('phone_code','phone_code') , null, ['class'=> 'form-control push-up-10 country_code', 'placeholder'=> '-Country code-', 'required'=> 'required']) !!}
                            @endif
                            {!! Form::text('phone_no', null, ['class'=> 'form-control push-up-10 phone_no', 'placeholder'=> 'Phone number after country code', 'required'=> 'required']) !!}
                            
                            </div>
                            <p class="small">For verification purpose only. Will not be visible to public.</p>
                        </div>
                        @endif
                        
                        
                        <div class="col-xs-12 push-up-30">
                            
                            <h4>Enter estimated product dimension:</h4>
                            
                            <div class="col-sm-3 col-xs-12 product-dimension-reference">
                                <img src="/public/img/settings/box.jpg" width="250" alt="Size reference" class="img-responsive">
                            </div>
                            
                            <div class="col-xs-12 col-sm-3 pull-up-20">
                                {!! Form::label('p_length', 'Length (Inch)') !!}
                                {!! Form::text('p_length', old('p_length'), ['class'=> 'form-control', 'required'=> 'required']) !!}
                            </div>
                            
                            <div class="col-xs-12 col-sm-3 pull-up-20">
                                {!! Form::label('p_width', 'Width (Inch)') !!}
                                {!! Form::text('p_width', old('p_width'), ['class'=> 'form-control', 'required'=> 'required']) !!}
                            </div>
                            
                            <div class="col-xs-12 col-sm-3 pull-up-20">
                                {!! Form::label('p_height', 'Height (Inch)') !!}
                                {!! Form::text('p_height', old('p_height'), ['class'=> 'form-control', 'required'=> 'required']) !!}
                            </div>
                            
                        </div>
                        
                    </section>
                    
                    
                    
                
                    <section class="row">
                        <div class="col-xs-12 text-center pull-up-20">{!! Form::submit('Post Buy', ['class'=>'btn btn-lg orange-bg white-text large-font']) !!}</div>
                    </section>
                    {!! Form::close() !!}
                
            </div>
        </div>
        
        
    </div>
</section>


@stop