@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
            <div class="col-sm-3 col-md-2 no-padding">
                <ul class="user-action-ul">
                    <li class="user-actions active"><a href="{{action('BuyOrders@newOrder')}}" >Order</a></li>
                    <li class="user-actions"><a href="{{action('BuyOrders@history')}}" >History</a></li>
                </ul>
            </div>
        
            <div class="col-sm-9 col-md-10">
                
                <h4 class="light-gray-text push-up-20 pull-left-10 breads">
                    <span class="boldest">Select items &nbsp;&nbsp;&nbsp;<i class="fa fa-play"></i></span>
                    <span class="push-10">Shipping details &nbsp;&nbsp;&nbsp;<i class="fa fa-play"></i></span>
                    <span>Order confirmation</span>
                </h4>
            
                
                {!! Form::open(['url'=> action('BuyOrders@postNewOrder'), 'enctype'=> 'multipart/form-data', 'class'=> 'blue-label buy-info-post' ]) !!}
                    
                    <h1 class="section-heading blue-text">Place an Order</h1>
                    <h2 class="section-heading black-text small-heading">Airposted will buy and ship to you via Airposted Express Mail.</h2>
                
                    
                    <section class="row order-holder">
                        
                        <section class="row order-more">
                            <h2 class="section-heading blue-text hidden">Save money by ordering multiple items at once</h2>
                            <a class="btn add-item-to-order" href="#" data-trigger="focus" role="button" tabindex="0" data-html="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="
                                <a href='' class='btn btn-block btn-rounded white-text green-bg trigger-buy-from-amazon'>From Amazon</a>
                                <a href='' class='btn btn-block btn-rounded white-text blue-bg trigger-buy-from-elsewhere'>From Elsewhere</a>
                            ">
                                <i class="fa fa-plus lightGray-bg"></i>
                                Add Items to your Order list
                            </a>
                            
                        </section>
                        
                    
                        <section class="row">
                            <div class="col-xs-12 text-center pull-up-20">
                                <a href="#" class="btn btn-lg btn-rounded green-bg white-text large-font hidden next-to-shipping">Next</a>
                            </div>
                        </section>
                        
                    </section>
                    
                    
                    <section class="row shipping-holder hidden">
    
                        
                        <h1 class="section-heading blue-text">Shipping Details</h1>
                        

                        <div class="col-sm-6 col-xs-12">
                            
                            <h2 class="section-heading green-text text-center">Billing Details</h2>
                            
                            <div class="col-xs-12">
                                <input type="checkbox" class="full-opacity"/>
                            </div>
                            
                            {!! Form::hidden('sender_company', '') !!}
                            {!! Form::hidden('receiver_company', '') !!}
                            {!! Form::hidden('shipping_agent', 'usps') !!}
                            {!! Form::hidden('box_height', '') !!}
                            {!! Form::hidden('box_width', '') !!}
                            {!! Form::hidden('box_length', '') !!}
                            {!! Form::hidden('box_weight', '') !!}
                            
                            <div class="col-xs-12 pull-up-20">
                                {!! Form::text('sender_name', old('sender_name'), ['class'=> 'form-control', 'placeholder'=> 'Buyer\'s full name', 'required'=> 'required' ]) !!}
                                {!! Form::text('sender_phone', old('sender_phone'), ['class'=> 'form-control', 'placeholder'=> 'Your phone no. (e.g. +1786456789)', 'required'=> 'required' ]) !!}
                                {!! Form::text('sender_email', old('sender_email'), ['class'=> 'form-control', 'placeholder'=> 'Your email address', 'required'=> 'required' ]) !!}
                                {!! Form::text('sender_address', old('sender_address'), ['class'=> 'form-control', 'placeholder'=> 'Street address (including apt, flat, floor etc.)', 'required'=> 'required' ]) !!}
                            </div>
                            
                            <div class="col-sm-6 col-xs-12">
                                {!! Form::select('sender_country_id', \App\Country::lists('name','id'), old('sender_country_id'), ['class'=> 'form-control select2', 'get_cities'=> 2, 'placeholder'=> 'Billing country', 'required'=> 'required' ]) !!}
                            </div>
                            
                            <div class="col-sm-6 col-xs-12">
                                {!! Form::select('sender_city_id', [], old('sender_city_id'), ['class'=> 'form-control select2', 'city_list'=>2, 'placeholder'=> 'Select city', 'required'=> 'required' ]) !!}
                            </div>
                            
                            <div class="col-sm-6 col-xs-12">
                                {!! Form::text('sender_state', old('sender_state'), ['class'=> 'form-control', 'placeholder'=> 'State', 'required'=> 'required' ]) !!}
                            </div>
                            
                            <div class="col-sm-6 col-xs-12">
                                {!! Form::text('sender_postcode', old('sender_postcode'), ['class'=> 'form-control', 'placeholder'=> 'Zip/Postal code', 'required'=> 'required' ]) !!}
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-6 col-xs-12">
                            
                            <h2 class="section-heading green-text text-center">Receiver Details</h2>
                            
                            <div class="col-xs-12">
                                <input type="checkbox" id="copycat" /> Same as Billing
                            </div>
                            
                            <div class="col-xs-12 pull-up-20">
                                {!! Form::text('receiver_name', old('receiver_name'), ['class'=> 'form-control', 'placeholder'=> 'Receiver\'s full name', 'required'=> 'required' ]) !!}
                                {!! Form::text('receiver_phone', old('receiver_phone'), ['class'=> 'form-control', 'placeholder'=> 'Receiver\'s phone no. (e.g. +8801712123456)', 'required'=> 'required' ]) !!}
                                {!! Form::text('receiver_email', old('receiver_email'), ['class'=> 'form-control', 'placeholder'=> 'Receiver\'s Email', 'required'=> 'required' ]) !!}
                                {!! Form::text('receiver_address', old('receiver_address'), ['class'=> 'form-control', 'placeholder'=> 'Street address (including apt, flat, floor etc.)', 'required'=> 'required' ]) !!}
                            </div>
                            
                            <div class="col-sm-6 col-xs-12">
                                {!! Form::select('receiver_country_id', \App\Country::lists('name','id'), old('receiver_country_id'), ['class'=> 'form-control select2', 'get_cities'=> 1, 'placeholder'=> 'Shipping country', 'required'=> 'required' ]) !!}
                            </div>
                            
                            <div class="col-sm-6 col-xs-12">
                                {!! Form::select('receiver_city_id', [], old('receiver_city'), ['class'=> 'form-control select2', 'city_list'=>1, 'placeholder'=> 'Select city', 'required'=> 'required' ]) !!}
                            </div>
                            
                            <div class="col-sm-6 col-xs-12">
                                {!! Form::text('receiver_state', old('receiver_state'), ['class'=> 'form-control', 'placeholder'=> 'State', 'required'=> 'required' ]) !!}
                            </div>
                            
                            <div class="col-sm-6 col-xs-12">
                                {!! Form::text('receiver_postcode', old('receiver_postcode'), ['class'=> 'form-control', 'placeholder'=> 'Zip/Postal code', 'required'=> 'required' ]) !!}
                            </div>
                            
                        </div>
                        
                        <section class="row">
                            <div class="col-xs-12 text-center pull-up-20">
                                <a href="#" class="btn btn-lg btn-rounded orange-bg white-text large-font back-to-shopping">Prev</a>
                                <a href="#" class="btn btn-lg btn-rounded green-bg white-text large-font next-to-summary">Next</a>
                            </div>
                        </section>
                        
                    </section>
                    
                    
                    <section class="row rate-holder hidden">
    
                        
                        <h1 class="section-heading blue-text">Order Confirmation</h1>
                        
                        <section class="row">
                            
                            <div class="col-sm-6 col-xs-12">
                                <h2 class="section-heading">
                                    Cart / Order Summary
                                    <div class="or push-up-10"></div>
                                </h2>
                                
                                <ul class="list-unstyled summary-products"></ul>
                                
                                <div class="or push-down-10"></div>
                                <div>
                                    Total product cost: <span class="pull-right total-product-cost">$0</span>
                                </div>
                                <div>
                                    Estimated shipping & handling cost: <span class="pull-right total-shipping">$0</span>
                                </div>
                                <div>
                                    Estimated total cost (rounded): <span class="pull-right total-invoice">$0</span>
                                </div>
                                
                            </div>
                            
                            <div class="col-sm-5 col-sm-offset-1 col-xs-12">
                                <h2 class="section-heading no-padding">
                                    Estimated box required to fit your product(s)
                                    <div class="or push-up-10"></div>
                                </h2>
                                <div>
                                    Height: <span class="pull-right box-height">0 Inches</span>
                                </div>
                                <div>
                                    Width: <span class="pull-right box-width">0 Inches</span>
                                </div>
                                <div>
                                    Length: <span class="pull-right box-length">0 Inches</span>
                                </div>
                                <div>
                                    Capacity: <span class="pull-right box-capacity">0 GM</span>
                                </div>
                                <div>
                                    Shipping & Handling cost: <span class="pull-right total-shipping">$0</span>
                                </div>
                                <div class="or push-up-20 push-down-20"></div>
                                <p class="small green-text">
                                    This is an estimation. We will manually review and confirm required box detail and cost after you placed the order.
                                </p>
                            </div>
                            
                        </section>
                        
                        <div class="or push-up-20 push-down-20"></div>
                        
                        <section class="row pull-10">
                            <b class="boldest">What Next?</b>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-angle-right"></i> &nbsp; Next, we will review your order and determine shipping cost. You will be notified via email.</li>
                                <li><i class="fa fa-angle-right"></i> &nbsp; You will make the payment via PayPal or debit/credit card.</li>
                                <li><i class="fa fa-angle-right"></i> &nbsp; We will process your order.</li>
                            </ul>
                        </section>
                        
                        <section class="row">
                            <div class="col-xs-12 text-center pull-up-20">
                                <a href="#" class="btn btn-lg btn-rounded orange-bg white-text large-font back-to-shipping">Prev</a>
                                <button type="submit" class="btn btn-lg btn-rounded green-bg white-text large-font">Place Order</button>
                            </div>
                        </section>
                        
                    </section>
                    
                    
                    <p class="message alert orange-text"></p>
                
                {!! Form::close() !!}
                
            </div>
        </div>
        
        
    </div>
</section>



<section class="row amazon-holder hidden">
    
    <div class="or blue-bg push-up-20"><span></span></div>
    
    <h2 class="section-heading green-text text-center">
        Buy from Amazon
        <a href="#" class="btn del pull-right" title="Remove this section">
            <i class="fa fa-trash-o"></i>
        </a>
    </h2>
    
    <div class="col-sm-7 col-xs-12">
        
        <div class="col-xs-12 no-padding">
            <div class="col-xs-12 pull-up-20">
                {!! Form::label('amazon_url[]', 'Amazon url of the product you are looking for:') !!}
                {!! Form::text('amazon_url[]', old('amazon_url[]'), ['class'=> 'form-control', 'placeholder'=> 'e.g. http://www.amazon.com/iphone', 'required'=>'required']) !!}
            </div>
        </div>
        
        <div class="col-xs-12 no-padding">
            
            <div class="col-xs-12 pull-up-20 image-chooser-area">
                
                <div class="image-chooser row">
                    
                    {!! Form::label('image_url', 'Choose/Upload an image for your post:') !!}
                    
                    <div class="upload">
                        <input type="file" class="img_for_amazon">
                        <i class="fa fa-plus"></i>
                        <small>Upload your own</small>
                    </div>
                    <div class="fetch fetch_from_amazon">
                        <p>Fetch from Amazon</p>
                    </div>
                    <div class="amazon_preview">
                        {!! Form::hidden('amazon_image_url[]') !!}
                        <img src="" alt="Preview" class="amazon_img_preview">
                        <small class="message"></small>
                    </div>
                </div>
                
            </div>
            
            
        </div>
        
        <div class="col-xs-12 col-sm-6 pull-up-20">
            {!! Form::label('amazon_name[]', 'Name of the product') !!}
            {!! Form::text('amazon_name[]', old('amazon_name[]'), ['class'=> 'form-control push-up-10', 'placeholder'=> 'e.g. iPhone 6s, Rice bran oil', 'required'=> 'required' ]) !!}
        </div>

        <div class="col-xs-12 col-sm-6 pull-up-20">
            {!! Form::label('amazon_category_id[]', 'Category of the Product') !!}
            {!! Form::select('amazon_category_id[]', \App\Category::lists('name', 'id'), old('amazon_category_id[]'), ['class'=> 'form-control', 'placeholder'=> 'Select the category for this product', 'required'=> 'required']) !!}
        </div>
        
        <div class="col-xs-12 pull-up-20">
            {!! Form::label('amazon_note[]', 'Note') !!}
            {!! Form::textarea('amazon_note[]', old('amazon_note[]'), ['class'=> 'form-control', 'rows'=> 5, 'placeholder'=> 'If you have any instruction or other requests regarding this product, type it here.' ]) !!}
        </div>
        
        <div class="col-xs-12 pull-up-20">
            <p class="small blue-text">N.B.: Local duty, tax and other customs charge may apply. <a href="#" class="blue-text">Learn more..</a></p>
        </div>
        
    </div>
    
    <div class="col-sm-4 col-sm-offset-1 col-xs-12">
        
        <div class="col-xs-12 pull-up-20">
            {!! Form::label('amazon_price[]', 'Product price per unit (USD)') !!}
            {!! Form::text('amazon_price[]', old('amazon_price[]'), ['class'=> 'form-control', 'placeholder'=> 'price per unit, as given at Amazon', 'required'=> 'required' ]) !!}
            {!! Form::select('amazon_quantity[]', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5], 1, ['class'=> 'form-control', 'placeholder'=> 'How many units would you like to order?', 'required'=> 'required' ]) !!}
        </div>
        
        <div class="col-xs-12 pull-up-20 product-dimension-reference">
            {!! Form::label('dimension', 'Product Packing size (Estimated)') !!}
            <img src="/public/img/settings/box.jpg" width="250" alt="Size reference" class="img-responsive">
            {!! Form::select('amazon_length[]', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], null, ['class'=> 'form-control', 'placeholder'=> 'length (Inches)', 'required'=> 'required' ]) !!}
            {!! Form::select('amazon_width[]', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], null, ['class'=> 'form-control', 'placeholder'=> 'width (Inches)', 'required'=> 'required' ]) !!}
            {!! Form::select('amazon_height[]', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], null, ['class'=> 'form-control', 'placeholder'=> 'height (Inches)', 'required'=> 'required' ]) !!}
        </div>
        
        <div class="col-xs-12 pull-up-20">
            {!! Form::label('amazon_weight[]', 'Product weight') !!}
            {!! Form::select('amazon_weight[]', [500=>'0-500 Gm', 1000=>'500 Gm - 1 KG', 1500=>'1 KG - 1.5 KG', 2000=>'1.5 KG - 2 KG', 2500=>'2 KG - 2.5 KG', 3000=>'2.5 KG - 3 KG', 3500=>'3 KG - 3.5 KG', 4000=>'3.5 KG - 4 KG', 4500=>'4 KG - 4.5 KG', 5000=>'4.5 KG - 5 KG', 5500=>'5 KG - 5.5 KG', 6000=>'5.5 KG - 6 KG', 6500=>'6 KG - 6.5 KG', 7000=>'6.5 KG - 7 KG'], old('amazon_weight[]'), ['class'=> 'form-control', 'placeholder'=> 'estimated weight in GM', 'required'=> 'required' ]) !!}
        </div>
        
        <div class="col-xs-12 pull-up-20">
            <p class="small green-text">N.B.: Actual product size and weight might vary. We will contact you if it costs more than anticipated.</p>
        </div>
        
    </div>
    
</section>


<section class="row other-source-holder hidden">
    
    <div class="or blue-bg push-up-20"><span></span></div>
    
    <h2 class="section-heading green-text text-center">
        Buy from Other Sources
        <a href="#" class="btn del pull-right" title="Remove this section">
            <i class="fa fa-trash-o"></i>
        </a>
    </h2>
    
    <div class="col-sm-7 col-xs-12">
        
        <div class="col-xs-12 no-padding">
            <div class="col-xs-12 pull-up-20">
                {!! Form::label('other_url[]', "Url of the product") !!}
                {!! Form::text('other_url[]', old('other_url[]'), ['class'=> 'form-control', 'placeholder'=> ' Enter any url showing the product', 'required'=> 'required']) !!}
            </div>
        </div>
        
        <div class="col-xs-12 no-padding">
            
            <div class="col-xs-12 pull-up-20 image-chooser-area">
                
                <div class="image-chooser row">
                    
                    {!! Form::label('image_url', 'Upload an image for your post:') !!}
                    
                    <div class="upload">
                        <input type="file" class="img_for_non_amazon">
                        <i class="fa fa-plus"></i>
                        <small>Upload your own</small>
                    </div>
                    <div class="preview">
                        {!! Form::hidden('non_amazon_image_url[]') !!}
                        <img src="" alt="Preview" class="non_amazon_img_preview">
                    </div>
                </div>
                
            </div>
            
        </div>
        
        <div class="col-xs-12 col-sm-6 pull-up-20">
            {!! Form::label('other_name[]', 'Name of the product') !!}
            {!! Form::text('other_name[]', old('other_name[]'), ['class'=> 'form-control push-up-15', 'placeholder'=> 'e.g. iPhone 6s', 'required'=> 'required' ]) !!}
        </div>

        <div class="col-xs-12 col-sm-6 pull-up-20">
            {!! Form::label('other_category_id[]', 'Category of the product') !!}
            {!! Form::select('other_category_id[]', \App\Category::lists('name', 'id'), old('other_category_id[]'), ['class'=> 'form-control', 'placeholder'=> 'Select the category for this product', 'required'=> 'required']) !!}
        </div>
        
        <div class="col-xs-12 pull-up-20">
            {!! Form::label('other_note[]', 'Note') !!}
            {!! Form::textarea('other_note[]', old('other_note[]'), ['class'=> 'form-control', 'rows'=> 5, 'placeholder'=> 'If you have any instruction or other requests regarding this product, type it here.' ]) !!}
        </div>
        
        <div class="col-xs-12 pull-up-20">
            <p class="small blue-text">N.B.: Local duty, tax and other customs charge may apply. <a href="#" class="blue-text">Learn more..</a></p>
        </div>
        
    </div>
    
    <div class="col-sm-4 col-sm-offset-1 col-xs-12">
        
        <div class="col-xs-12 pull-up-20">
            {!! Form::label('other_price[]', 'Product price per unit (USD)') !!}
            {!! Form::text('other_price[]', old('other_price[]'), ['class'=> 'form-control', 'placeholder'=> 'Product price as given on its website', 'required'=> 'required' ]) !!}
            {!! Form::select('other_quantity[]', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5], 1, ['class'=> 'form-control', 'placeholder'=> 'How many units would you like to order?', 'required'=> 'required' ]) !!}
        </div>
        
        <div class="col-xs-12 pull-up-20 product-dimension-reference">
            {!! Form::label('dimension', 'Product packing size (Estimated)') !!}
            <img src="/public/img/settings/box.jpg" width="250" alt="Size reference" class="img-responsive">
            {!! Form::select('other_length[]', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], null, ['class'=> 'form-control', 'placeholder'=> 'length (Inches)', 'required' => 'required' ]) !!}
            {!! Form::select('other_width[]', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], null, ['class'=> 'form-control', 'placeholder'=> 'width (Inches)', 'required' => 'required' ]) !!}
            {!! Form::select('other_height[]', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], null, ['class'=> 'form-control', 'placeholder'=> 'height (Inches)', 'required' => 'required' ]) !!}
        </div>
        
        <div class="col-xs-12 pull-up-20">
            {!! Form::label('other_weight[]', 'Product weight (lb)') !!}
            {!! Form::select('other_weight[]', [500=>'0-500 Gm', 1000=>'500 Gm - 1 KG', 1500=>'1 KG - 1.5 KG', 2000=>'1.5 KG - 2 KG', 2500=>'2 KG - 2.5 KG', 3000=>'2.5 KG - 3 KG', 3500=>'3 KG - 3.5 KG', 4000=>'3.5 KG - 4 KG', 4500=>'4 KG - 4.5 KG', 5000=>'4.5 KG - 5 KG', 5500=>'5 KG - 5.5 KG', 6000=>'5.5 KG - 6 KG', 6500=>'6 KG - 6.5 KG', 7000=>'6.5 KG - 7 KG'], old('other_weight[]'), ['class'=> 'form-control', 'placeholder'=> 'estimated weight in lb', 'required' => 'required' ]) !!}
        </div>
        
        <div class="col-xs-12 pull-up-20">
            <p class="small green-text">N.B.: Actual product size and weight might vary. We will contact you if it costs more than anticipated.</p>
        </div>
        
    </div>
    
</section>


@stop