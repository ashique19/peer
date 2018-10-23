@extends('admin.layout')

@section('title') Order @stop

@section('main')

<h1 class="page-title">
    <center>Order</center>
    <a href="#" class="btn btn-rounded btn-info pull-right" 
            data-container="body" 
            data-toggle="popover" 
            data-placement="bottom" 
            data-html="true" 
            data-trigger="click" 
            data-content='    
                            {!! Form::open(["url"=> action("Orders@updateStatus"), "class"=> "change-order-log" ]) !!}
                            {!! Form::hidden("id", $order->id) !!}
                            <p>{!! Form::select("status", order_status("", false), null, ["class"=> "form-control" ] ) !!}</p>
                            <p>{!! Form::checkbox("notify_user", 1, null) !!} Notify User</p>
                            <p>{!! Form::submit("Submit", ["class"=> "btn btn-success btn-rounded"]) !!}</p>
                            <p class="message"></p>
                            {!! Form::close() !!}
                            '>Change Status</a>
    <span class="btn btn-rounded btn-warning pull-right">Status: {{order_status($order->status)}}</span>
</h1>

{!! errors($errors) !!}

@if($order)

<div class="row">
    <section class="col-sm-8 col-xs-12">
        
        <div class="col-xs-12">
                
            <h2 class="panel-heading">
                Label
                <a href="#" class="btn btn-primary btn-rounded pull-right" data-toggle="modal" data-target="#edit-label-modal"><i class="fa fa-edit"></i> Edit Label & Shipping</a>
            </h2>
            
            <div class="col-sm-6 col-xs-12">
                <h2 class="section-heading">Buyer</h2>
                <p>Name: {{$label->buyer_name}}</p>
                <p>Email: {{$label->buyer_email}}</p>
                <p>Phone: {{$label->buyer_phone}}</p>
                <p>Address: {{$label->buyer_addressLines}}</p>
                <p>City: {{$label->buyer_cityTown}}</p>
                <p>State: {{$label->buyer_stateProvince}}</p>
                <p>Postcode: {{$label->buyer_postalCode}}</p>
                <p>Country: {{$label->buyer_countryCode}}</p>
            </div>
            
            <div class="col-sm-6 col-xs-12">
                <h2 class="section-heading">Receiver</h2>
                <p>Name: {{$label->receiver_name}}</p>
                <p>Email: {{$label->receiver_email}}</p>
                <p>Phone: {{$label->receiver_phone}}</p>
                <p>Address: {{$label->receiver_addressLines}}</p>
                <p>City: {{$label->receiver_cityTown}}</p>
                <p>State: {{$label->receiver_stateProvince}}</p>
                <p>Postcode: {{$label->receiver_postalCode}}</p>
                <p>Country: {{$label->receiver_countryCode}}</p>
            </div>
        
        </div>
        
        <div class="col-xs-12">
            
            <h2 class="panel-heading">Shipping Data</h2>
            
            <p class="col-sm-6 col-xs-12 no-padding">Parcel Type: {{$label->rates_parcelType}}</p>                
            <p class="col-sm-6 col-xs-12 no-padding">Shipping Agent: {{$label->rates_carrier}}</p>                
            <p class="col-sm-6 col-xs-12 no-padding">Box Dimension: Height-{{$label->parcel_dimension_height}}, Width-{{$label->parcel_dimension_width}}, Length-{{$label->parcel_dimension_length}} Inch</p>                
            <p class="col-sm-6 col-xs-12 no-padding">Box Capacity: {{$label->parcel_weight_amount}} OZ</p>                
            
        </div>
    
        <div class="col-xs-12">
            
            <h2 class="panel-heading">Payment</h2>
            
            <div class="col-xs-12 scrollable">
                
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Shipping</th>
                            <th>Airposted Margin</th>
                            <th>Transaction</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$payment->product_price}}</td>
                            <td>{{$order->shipping_cost}}</td>
                            <td>{{$payment->airposted_commission}}</td>
                            <td>{{$payment->transaction_charge}}</td>
                            <td>{{$payment->payment}}</td>
                            <td>{{payment_status($payment->status)}}</td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            
        </div>
        
        
        
        <div class="col-xs-12 scrollable push-up-20">
            <h2 class="panel-heading">Products</h2>
            <ul class="summary-products no-padding list-unstyled col-xs-12">
                @if( count($products) > 0 )
                @foreach( $products as $product )
                <li class="well">
                    <p class="text-right">
                        <a href="#" class="btn btn-xs btn-rounded btn-warning" data-toggle="modal" data-target="#edit-order-product-{{$product->id}}"><i class="fa fa-edit"></i></a>
                        <a href="#" data-box="#del-order-product-{{$product->id}}" class="btn btn-xs btn-rounded btn-success mb-control"><i class="fa fa-trash-o"></i></a>
                        
                        @section('bodyScope')
                        
                        
                        <!--Modal : EDIT ORDER PRODUCT-->
                        <div class="modal fade" id="edit-order-product-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="edit-order-product-{{$product->id}}">
                          <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                
                              {!! Form::open(['url'=> action('Order_products@update', $product->id), 'method'=> 'PATCH']) !!}
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="edit-order-product-{{$product->id}}">Edit <span class="small">{{$product->name}}</span></h4>
                              </div>
                              <div class="modal-body">
                                
                                
                                <section class="row">
                                    
                                    <div class="col-xs-12 col-sm-4">
                                        {!! Form::text('name', $product->name, ['class'=> 'form-control push-up-10', 'placeholder'=> 'Name of the product'] ) !!}
                                        {!! Form::text('source', $product->source, ['class'=> 'form-control push-up-10', 'placeholder'=> 'Amazon or elsewhere'] ) !!}
                                        {!! Form::text('product_url', $product->product_url, ['class'=> 'form-control push-up-10', 'placeholder'=> 'URL of the product'] ) !!}
                                        {!! Form::select('category_id', \App\Category::lists('name', 'id'), $product->category_id, ['class'=> 'form-control push-up-10', 'placeholder'=> 'Category of the product'] ) !!}
                                        {!! Form::text('price', $product->price, ['class'=> 'form-control push-up-10', 'placeholder'=> 'Price (USD)'] ) !!}
                                        {!! Form::text('quantity', $product->quantity, ['class'=> 'form-control push-up-10', 'placeholder'=> 'quantity'] ) !!}
                                        <h4 class="push-up-20">Dimension (L*W*H)</h4>
                                        {!! Form::select('length', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], $product->length, ['class'=> 'form-control push-up-10', 'placeholder'=> 'Length (Inch)'] ) !!}
                                        {!! Form::select('width', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], $product->width, ['class'=> 'form-control push-up-10', 'placeholder'=> 'Width (Inch)'] ) !!}
                                        {!! Form::select('height', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], $product->height, ['class'=> 'form-control push-up-10', 'placeholder'=> 'Height (Inch)'] ) !!}
                                        <h4 class="push-up-20">Weight (OZ)</h4>
                                        {!! Form::text('weight', $product->weight, ['class'=> 'form-control push-up-10', 'placeholder'=> 'weight (Gm)'] ) !!}
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-8 push-up-10">
                                        {!! Form::textarea('note', $product->note, ['class'=> 'form-control', 'placeholder'=> 'note'] ) !!}
                                    </div>
                                    
                                </section>
                                
                                
                              </div>
                              <div class="modal-footer">
                                <a class="btn btn-default" data-dismiss="modal">Close</a>
                                <button class="btn btn-primary" type="submit">Save</button>
                              </div>
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                        <!--End Modal : EDIT ORDER PRODUCT-->

                        
                        <!-- DELETE ORDER PRODUCT-->
                        <div class="message-box animated fadeIn" data-sound="alert" id="del-order-product-{{$product->id}}">
                            <div class="mb-container">
                                <div class="mb-middle">
                                    <div class="mb-title"><span class="fa fa-trash-o"></span> Remove <strong>{{$product->name}}</strong> ?</div>
                                    <div class="mb-content">
                                        <p>Are you sure you want to remove "{{$product->name}}" from this order?</p>                    
                                        <p>Press No if you want to continue work. Press Yes to remove it product from this order.</p>
                                    </div>
                                    <div class="mb-footer">
                                        <div class="pull-right">
                                            {!! deletes('order_products', $product->id, 'Yes', ['class'=>'btn btn-danger btn-lg']) !!}
                                        </div>
                                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @stop
                        
                    </p>
                    
                    <span class="cart-summary-img pull-left">
                        <a href="{{$product->product_url}}" target="_blank">
                            <img src="{{$product->product_image}}" class="img-responsive img-thumbnail" width="100"></img>
                        </a>
                    </span>
                    
                    <span class="row push-20">
                        <p>
                            <a href="{{$product->product_url}}" target="_blank">{{$product->name}} ({{$product->source}}):</a> 
                            <span class="pull-right">${{$product->price}} * {{$product->quantity}} = ${{ $product->price * $product->quantity }}</span>
                        </p>
                        <p>Size: <span class="pull-right">{{$product->length}} * {{$product->width}} * {{$product->height}} Inches * {{$product->quantity}}</span></p>
                        <p>Weight: <span class="pull-right">{{ $product->weight }} Gm * {{$product->quantity}}</span></p>
                    </span>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    
    </section>
    
    <section class="col-sm-4 col-xs-12 order-logs">
        <h2 class="panel-heading">
            Log
            <a href="#" class="btn btn-primary btn-rounded pull-right" data-toggle="modal" data-target="#add-log-modal"><i class="fa fa-plus"></i> Log</a>
        </h2>
        
        
        
        @if($order->order_logs()->count() > 0)
        @foreach($order->order_logs as $log)
        <div class="col-xs-12 no-padding push-up-10">
            <p>
                <span class="pull-right small darkGray-text">{{$log->createdBy->name}} | {{$log->created_at->format('M-d-Y')}}</span>
                <span class="blue-text">{{$log->name}}</span>
            </p>
            <p>{{$log->log_detail}}</p>
        </div>
        @endforeach
        @endif
        
    </section>
</div>

<!--Modal : Add Log-->
<div class="modal fade" id="add-log-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
        
      {!! Form::open(['url'=> action('Order_logs@store'), 'class'=> 'save-order-log']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Log <span class="small">(Visible to Buyer)</span></h4>
      </div>
      <div class="modal-body">
        
        
        <section class="row">
            {!! Form::hidden('order_id', $order->id) !!}
            {!! Form::hidden('user_id', $order->user_id) !!}
            
            <div class="col-xs-12">
                {!! Form::text('name', null, ['class'=> 'form-control', 'placeholder'=> 'Name the Log'] ) !!}
            </div>
            
            <div class="col-xs-12 push-up-10">
                {!! Form::textarea('log_detail', null, ['class'=> 'form-control', 'placeholder'=> 'Write log in detail']) !!}
            </div>
            
            <div class="col-xs-12 push-up-10">
                <p class="message"></p>
            </div>
            
        </section>
        
        
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">Close</a>
        <button class="btn btn-primary" type="submit">Save Log</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!--End Modal : Add Log-->

<!--Modal : Edit Label-->
<div class="modal fade" id="edit-label-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        
      {!! Form::open(['url'=> action('Labels@updateOrderLabel', $order->label_id), 'method'=>'post']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit <span class="small">Label data for this order</span></h4>
      </div>
      <div class="modal-body">
        
        
        <section class="row">
            
            <section class="col-sm-6 col-xs-12">
                        
                <h2 class="section-heading black-text small-heading">Sender</h2>
                
                <div class="col-xs-12">
                    {!! Form::label('sender_name', 'Name') !!}
                    {!! Form::text('sender_name', $label->buyer_name, ['class'=> 'form-control', 'placeholder'=> 'Full Name of Sender', 'required'=>'required']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('sender_company', 'Company') !!}
                    {!! Form::text('sender_company', $label->buyer_company, ['class'=> 'form-control', 'placeholder'=> 'Sender company (if any)']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('sender_country_id', 'Country') !!}
                    <div class="row">
                        {!! Form::select('sender_country_id', \App\Country::lists('name','id'), $label->sender_country_id, ['class'=> 'form-control select2']) !!}
                    </div>
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('sender_city_id', 'City') !!}
                    <div class="row">
                        {!! Form::select('sender_city_id', \App\Country::where('code','US')->first()->cities()->lists('name', 'id'), $label->buyer_cityTown, ['class'=> 'form-control select2', 'placeholder'=> 'Select your city.']) !!}
                    </div>
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('sender_state', 'State') !!}
                    {!! Form::text('sender_state', $label->buyer_stateProvince, ['class'=> 'form-control', 'placeholder'=> 'State', 'required'=>'required']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('sender_address', 'Address') !!}
                    {!! Form::text('sender_address', $label->buyer_addressLines, ['class'=> 'form-control', 'placeholder'=> 'Address', 'required'=>'required']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('sender_postcode', 'Postcode') !!}
                    {!! Form::text('sender_postcode', $label->buyer_postalCode, ['class'=> 'form-control', 'placeholder'=> 'Postcode', 'required'=>'required']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('sender_phone', 'Phone no.') !!}
                    {!! Form::text('sender_phone', $label->buyer_phone, ['class'=> 'form-control', 'placeholder'=> 'Phone no.', 'required'=>'required']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('sender_email', 'Email') !!}
                    {!! Form::text('sender_email', $label->buyer_email, ['class'=> 'form-control', 'placeholder'=> 'Email', 'required'=>'required']) !!}
                </div>
                
            </section>
            
            <section class="col-sm-6 col-xs-12">
                
                <h2 class="section-heading black-text small-heading">Receiver</h2>
                
                <div class="col-xs-12">
                    {!! Form::label('receiver_name', 'Name') !!}
                    {!! Form::text('receiver_name', $label->receiver_name, ['class'=> 'form-control', 'placeholder'=> 'Full Name of receiver', 'required'=>'required']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('receiver_company', 'Company') !!}
                    {!! Form::text('receiver_company', $label->receiver_company, ['class'=> 'form-control', 'placeholder'=> 'receiver company (if any)']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('receiver_country_id', 'Country') !!}
                    <div class="row">
                        {!! Form::select('receiver_country_id', \App\Country::orderBy('name')->lists('name', 'id'), \App\Country::where('code', $label->receiver_countryCode)->first()->id, ['class'=> 'form-control select2 get_cities', 'placeholder'=> 'Country where you want to send the parcel', 'required'=>'required']) !!}
                    </div>
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('receiver_city_id', 'City') !!}
                    <div class="row">
                        {!! Form::select('receiver_city_id', [], $label->receiver_cityTown, ['class'=> 'form-control select2', 'placeholder'=> 'Select the city where you want to send the Parcel']) !!}
                    </div>
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('receiver_state', 'State/Provice') !!}
                    {!! Form::text('receiver_state', $label->receiver_stateProvince, ['class'=> 'form-control', 'placeholder'=> 'State']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('receiver_address', 'Address') !!}
                    {!! Form::text('receiver_address', $label->receiver_addressLines, ['class'=> 'form-control', 'placeholder'=> 'Address', 'required'=>'required']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('receiver_postcode', 'Postcode') !!}
                    {!! Form::text('receiver_postcode', $label->receiver_postalCode, ['class'=> 'form-control', 'placeholder'=> 'Postcode', 'required'=>'required']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('receiver_phone', 'Phone no.') !!}
                    {!! Form::text('receiver_phone', $label->receiver_phone, ['class'=> 'form-control', 'placeholder'=> 'Phone no.', 'required'=>'required']) !!}
                </div>
                
                <div class="col-xs-12">
                    {!! Form::label('receiver_email', 'Email') !!}
                    {!! Form::text('receiver_email', $label->receiver_email, ['class'=> 'form-control', 'placeholder'=> 'Email', 'required'=>'required']) !!}
                </div>
                
            </section>
            
            <section class="col-xs-12">
                
                <h2 class="section-heading push-up-20">Label data</h2>
                
                <div class="col-sm-6 col-xs-12">
                    
                    <div class="col-xs-12 push-up-10">
                        {!! Form::label('parcel_type', 'Parcel type') !!}
                        {!! Form::select('parcel_type', ['GIFT' => 'Gift','COMMERCIAL_SAMPLE' => 'Commercial Sample','MERCHANDISE' => 'Merchandise','DOCUMENTS' => 'Documents','RETURNED_GOODS' => 'Returned Goods','OTHER' => 'Other'], $label->parcel_type, ['class'=> 'form-control']) !!}
                    </div>
                    
                    <div class="col-xs-12 push-up-10">
                        {!! Form::label('shipping_agent', 'Shipping agent') !!}
                        {!! Form::select('shipping_agent', ['usps' => 'USPS'], $label->shipping_agent, ['class'=> 'form-control']) !!}
                    </div>
                    
                    <div class="col-xs-12 push-up-10">
                        {!! Form::label('box_weight', 'Box Capacity (GM)') !!}
                        {!! Form::text('box_weight', oz_to_gm($label->parcel_weight_amount), ['class'=> 'form-control', 'placeholder'=> 'box capacity (OZ)']) !!}
                    </div>
                    
                </div>
                
                <div class="col-sm-6 col-xs-12">
                    
                    <div class="col-xs-12 push-up-10">
                        {!! Form::label('box_height', 'Height') !!}
                        {!! Form::select('box_height', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], $label->parcel_dimension_height, ['class'=> 'form-control', 'placeholder'=> '-Select height-']) !!}
                    </div>
                    
                    <div class="col-xs-12 push-up-10">
                        {!! Form::label('box_width', 'Width') !!}
                        {!! Form::select('box_width', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], $label->parcel_dimension_width, ['class'=> 'form-control', 'placeholder'=> '-Select width-']) !!}
                    </div>
                    
                    <div class="col-xs-12 push-up-10">
                        {!! Form::label('box_length', 'Length') !!}
                        {!! Form::select('box_length', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], $label->parcel_dimension_length, ['class'=> 'form-control', 'placeholder'=> '-Select length-']) !!}
                    </div>
                    
                </div>
                
            </section>
            
            <section class="col-xs-12">
                
                <h2 class="section-heading push-up-20">Shipping Cost</h2>
                
                <div class="col-xs-12 col-sm-6">
                    {!! Form::label('rates_totalCarrierCharge', 'Label/Shipping cost in USD') !!}
                    {!! Form::text('rates_totalCarrierCharge', $label->rates_totalCarrierCharge, ['class'=> 'form-control', 'placeholder'=> 'Shipping Cost (USD)']) !!}
                </div>
                
                <div class="col-sm-6 col-xs-12">
                    <a href="#" class="btn btn-primary btn-rounded btn-block push-up-20 get-shipping-rates">Apply USPS label rate</a>
                    <div class="col-xs-12 shipping-rate-list"> </div>
                </div>
                
            </section>
            
        </section>
        
        
      </div>
      <div class="modal-footer">
        <a class="btn btn-default" data-dismiss="modal">Close</a>
        <button class="btn btn-primary" type="submit">Save Label</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!--End Modal : Edit Label-->

@else

    <h3>No data found.</h3>

@endif

@stop
        