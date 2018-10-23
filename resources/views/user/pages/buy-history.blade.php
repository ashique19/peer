@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
            <div class="col-sm-3 col-md-2 no-padding">
                <ul class="user-action-ul">
                    <li class="user-actions"><a href="{{route('userDashboard')}}" >Post</a></li>
                    <li class="user-actions active"><a href="{{action('Buyers@oldBuyPosts')}}" >Active</a></li>
                </ul>
            </div>
        
            <div class="col-sm-9 col-md-10">
            
                <h1 class="section-heading black-text">Active Buys</h1>
                
                <div class="col-xs-12 scrollable">
                    <table class="table table-responsive text-center">
                        <thead>
                            <tr>
                                <th>Edit</th>
                                <th>Post Date</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Country</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($myBuys) > 0)
                            @foreach($myBuys as $myBuy)
                            <tr>
                                <td>
                                    <a href="#" class="btn" data-toggle="modal" data-target="#edit-buy-{{$myBuy->id}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    
                                    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit-buy-{{$myBuy->id}}" id="edit-buy-{{$myBuy->id}}">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                              
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h2 class="modal-title  text-left">Edit Post</h2>
                                            </div>
                                            
                                            <div class="modal-body">
                                              {!! Form::open(['url'=> action('Buyers@update', $myBuy->id), 'enctype'=> 'multipart/form-data', 'class'=> 'blue-label buy-info-post', 'method'=> 'patch' ]) !!}
                                                <section class="row text-left">
                                                    
                                                    <div class="col-xs-12 no-padding">
                                                        <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                                                            {!! Form::label('amazon_url', 'Amazon url:') !!}
                                                            {!! Form::text('amazon_url', $myBuy->amazon_url, ['class'=> 'form-control', 'placeholder'=> 'e.g. http://www.amazon.com/iphone']) !!}
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20">
                                                            {!! Form::label('other_url', "Other Url (optional)") !!}
                                                            {!! Form::text('other_url', $myBuy->other_url, ['class'=> 'form-control', 'placeholder'=> ' Enter any url showing the product (optional)']) !!}
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
                                                                    <input type="radio" name="image_url" value="@if(strlen(trim($myBuy->amazon_url)) > 0){{$myBuy->image_url}} @endif" checked />
                                                                    <img src="@if(strlen(trim($myBuy->amazon_url)) > 0){{$myBuy->image_url}} @endif" alt="Preview" id="amazon_img_preview">
                                                                    <small class="message"></small>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20 image-chooser-area">
                                                            
                                                            <div class="image-chooser row">
                                                                
                                                                {!! Form::label('image_url', 'Upload an image for your post:') !!}
                                                                
                                                                <div class="upload">
                                                                    <input type="file" value="@if(strlen(trim($myBuy->amazon_url)) == 0){{$myBuy->image_url}} @endif" id="img_for_non_amazon">
                                                                    <i class="fa fa-plus"></i>
                                                                    <small>Upload your own</small>
                                                                </div>
                                                                <div class="preview">
                                                                    <img src="@if(strlen(trim($myBuy->amazon_url)) == 0){{$myBuy->image_url}} @endif" alt="Preview" id="non_amazon_img_preview">
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                                                        {!! Form::label('name', 'What is the name of the product?') !!}
                                                        {!! Form::text('name', $myBuy->name, ['class'=> 'form-control', 'placeholder'=> 'e.g. iPhone 6s', 'required'=> 'required' ]) !!}
                                                    </div>
                                                    <div class="col-xs-6 col-sm-5 col-sm-offset-1 price_area pull-up-20" transaction_charge="{{settings()->transaction_charge}}" commission="{{settings()->commission}}">
                                                        
                                                        {!! Form::label('price', 'How much does the product cost (USD)?') !!}
                                                        {!! Form::text('price', $myBuy->price, ['class'=> 'form-control price', 'placeholder'=> 'Product Price (USD)', 'required'=> 'required' ]) !!}
                                                        
                                                        <div class="price_summary">
                                                            <p>
                                                                Airposted Fee <span class="pull-right">$<span class="total_commission">0</span></span>
                                                                <p class="small">({{settings()->commission}}%)</p>
                                                            </p>
                                                            <p>
                                                                Paypal Fee <span class="pull-right">$<span class="total_transaction_charge">0</span></span>
                                                                <p class="small">({{settings()->transaction_charge}}% + {{env('FIXED_TRANSACTION_CHARGE')}} USD)</p>
                                                            </p>
                                                            <p>
                                                                <b>
                                                                    Total USD <span class="pull-right"><span class="total_price">0</span></span>
                                                                </b>
                                                            </p>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-5 pull-up-20">
                                                        {!! Form::label('category_id', 'Our travelers carry certain items.') !!}
                                                        {!! Form::select('category_id', \App\Category::lists('name', 'id'), $myBuy->category_id, ['class'=> 'form-control select2', 'placeholder'=> 'Select the category for this product', 'required'=> 'required']) !!}
                                                    </div>
                                                    
                                                    @if( strlen( \App\User::find(auth()->user()->id)->contact ) < 5 )
                                                    <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1 pull-up-20">
                                                        <div class="col-xs-12">
                                                            {!! Form::label('contact', 'Phone Number (mobile/landline)') !!}
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6 col-md-5 pull-right-0">
                                                            {!! Form::text('contact', null, ['class'=> 'form-control', 'required'=> 'required']) !!}
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
                                                            {!! Form::text('contact', null, ['class'=> 'form-control', 'placeholder'=> 'Phone number starting with country code', 'required'=> 'required']) !!}
                                                        </div>
                                                        <small class="help-block">For verification purpose only. Will not be visible to public.</small>
                                                    </div>
                                                    @endif
                                                    
                                                </section>
                                                
                                            
                                                <section class="row">
                                                    <div class="col-xs-12 text-center pull-up-20 pull-down-20">{!! Form::submit('Update', ['class'=>'btn btn-lg green-bg white-text large-font']) !!}</div>
                                                </section>
                                                {!! Form::close() !!}
                                                
                                                <section class="row or text-center push-up-50 push-down-50">
                                                    <span>OR</span>
                                                </section>  
                                                
                                                {!! Form::open(['url'=> action('Buyers@destroy', $myBuy->id), 'method'=> 'delete']) !!}
                                                <section class="row">
                                                    <div class="col-xs-12 text-center pull-up-20 pull-down-20">{!! Form::submit('Delete Post', ['class'=>'btn btn-lg black-bg white-text large-font']) !!}</div>
                                                </section>
                                                {!! Form::close() !!}
                                                
                                                
                                            </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                                    
                                </td>
                                <td>{{$myBuy->created_at->format('m/d/Y')}}</td>
                                <td>{{$myBuy->name}}</td>
                                <td>${{$myBuy->price}}</td>
                                <td>@if($myBuy->category){{$myBuy->category->name}} @endif</td>
                                <td>@if($myBuy->country){{$myBuy->country->name}} @endif</td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                    {!! $myBuys->render() !!}
                </div>
                
            </div>
        </div>
        
        
        
    </div>
</section>


@stop