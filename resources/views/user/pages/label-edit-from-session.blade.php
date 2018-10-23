@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav-label')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
        
            <div class="col-sm-10 col-xs-12">
            
                <h1 class="section-heading blue-text">Edit Shipping Label</h1>
                
                {!! errors($errors) !!}
                
                @if($label)
                
                {!! Form::open(['url'=> action('Shippings@postLabel'), 'enctype'=> 'multipart/form-data', 'class'=> 'blue-label buy-info-post' ]) !!}
                    
                    <section class="col-sm-6 col-xs-12">
                        
                        <h2 class="section-heading black-text small-heading">Sender Information</h2>
                        
                        <div class="col-xs-12">
                            {!! Form::label('sender_name', 'Name') !!}
                            {!! Form::text('sender_name', $label['from']['name'], ['class'=> 'form-control', 'placeholder'=> 'Full Name of Sender', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('sender_company', 'Company') !!}
                            {!! Form::text('sender_company', $label['from']['company'], ['class'=> 'form-control', 'placeholder'=> 'Sender company (if any)']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('sender_country_id', 'Country') !!}
                            {!! Form::select('none', ['US'=>'USA'], 'US', ['class'=> 'form-control select2', 'disabled'=>'disabled']) !!}
                            {!! Form::hidden('sender_country_id', \App\Country::where('code','US')->first()->id) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('sender_city_id', 'City') !!}
                            {!! Form::select('sender_city_id', \App\Country::where('code','US')->first()->cities()->lists('name', 'id'), $label['from']['cityTown'], ['class'=> 'form-control select2', 'placeholder'=> 'Select your city.']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('sender_state', 'State') !!}
                            {!! Form::text('sender_state', $label['from']['stateProvince'], ['class'=> 'form-control', 'placeholder'=> 'State', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('sender_address', 'Address') !!}
                            {!! Form::text('sender_address', implode(',', $label['from']['addressLines']), ['class'=> 'form-control', 'placeholder'=> 'Address', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('sender_postcode', 'Postcode') !!}
                            {!! Form::text('sender_postcode', $label['from']['postalCode'], ['class'=> 'form-control', 'placeholder'=> 'Postcode', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('sender_phone', 'Phone no.') !!}
                            {!! Form::text('sender_phone', $label['from']['phone'], ['class'=> 'form-control', 'placeholder'=> 'Phone no.', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('sender_email', 'Email') !!}
                            {!! Form::text('sender_email', $label['from']['email'], ['class'=> 'form-control', 'placeholder'=> 'Email', 'required'=>'required']) !!}
                        </div>
                        
                    </section>
                    
                    <section class="col-sm-6 col-xs-12">
                        
                        <h2 class="section-heading black-text small-heading">Receiver Information</h2>
                        
                        <div class="col-xs-12">
                            {!! Form::label('receiver_name', 'Name') !!}
                            {!! Form::text('receiver_name', $label['to']['name'], ['class'=> 'form-control', 'placeholder'=> 'Full Name of receiver', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('receiver_company', 'Company') !!}
                            {!! Form::text('receiver_company', $label['to']['company'], ['class'=> 'form-control', 'placeholder'=> 'receiver company (if any)']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('receiver_country_id', 'Country') !!}
                            {!! Form::select('receiver_country_id', \App\Country::orderBy('name')->lists('name', 'id'), \App\Country::where('code', $label['to']['countryCode'])->first()->id, ['class'=> 'form-control select2 get_cities', 'placeholder'=> 'Country where you want to send the parcel', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('receiver_city_id', 'City') !!}
                            {!! Form::select('receiver_city_id', [], $label['to']['cityTown'], ['class'=> 'form-control select2', 'placeholder'=> 'Select the city where you want to send the Parcel']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('receiver_state', 'State/Provice') !!}
                            {!! Form::text('receiver_state', $label['to']['stateProvince'], ['class'=> 'form-control', 'placeholder'=> 'State']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('receiver_address', 'Address') !!}
                            {!! Form::text('receiver_address', implode(',' , $label['to']['addressLines']), ['class'=> 'form-control', 'placeholder'=> 'Address', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('receiver_postcode', 'Postcode') !!}
                            {!! Form::text('receiver_postcode', $label['to']['postalCode'], ['class'=> 'form-control', 'placeholder'=> 'Postcode', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('receiver_phone', 'Phone no.') !!}
                            {!! Form::text('receiver_phone', $label['to']['phone'], ['class'=> 'form-control', 'placeholder'=> 'Phone no.', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12">
                            {!! Form::label('receiver_email', 'Email') !!}
                            {!! Form::text('receiver_email', $label['to']['email'], ['class'=> 'form-control', 'placeholder'=> 'Email', 'required'=>'required']) !!}
                        </div>
                        
                    </section>
                    
                    <section class="col-xs-12 push-up-30">
                        
                        <div class="col-xs-12 col-sm-6">
                            {!! Form::label('parcel_type', 'Parcel type') !!}
                            {!! Form::select('parcel_type', ['GIFT' => 'Gift','COMMERCIAL_SAMPLE' => 'Commercial Sample','MERCHANDISE' => 'Merchandise','DOCUMENTS' => 'Documents','RETURNED_GOODS' => 'Returned Goods','OTHER' => 'Other'], $label['customs']['customsInfo']['reasonForExport'], ['class'=> 'form-control select2', 'placeholder'=> 'Select the type of parcel you want to send', 'required'=>'required']) !!}
                        </div>
                        
                        <div class="col-xs-12 col-sm-6">
                            {!! Form::label('shipping_agent', 'Shipping Agent') !!}
                            {!! Form::select('shipping_agent', ['usps'=>'USPS'], old('shipping_agent'), ['class'=> 'form-control select2', 'required'=>'required']) !!}
                        </div>
                        
                        
                        <div class="col-xs-12">
                            <h2 class="section-heading">Select a suitable BOX size to fit your parcel</h2>
                            
                            <div class="col-sm-3 col-xs-12">
                                {!! Form::select('box_height', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], $label['parcel']['dimension']['height'], ['class'=> 'form-control select2', 'placeholder'=> '-Height (Inches)-'] ) !!}
                            </div>
                            
                            <div class="col-sm-3 col-xs-12">
                                {!! Form::select('box_width', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], $label['parcel']['dimension']['width'], ['class'=> 'form-control select2', 'placeholder'=> '-Width (Inches)-'] ) !!}
                            </div>
                            
                            <div class="col-sm-3 col-xs-12">
                                {!! Form::select('box_length', [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12, 13=>13, 14=>14, 15=>15, 16=>16, 17=>17, 18=>18, 19=>19, 20=>20], $label['parcel']['dimension']['length'], ['class'=> 'form-control select2', 'placeholder'=> '-Length (Inches)-'] ) !!}
                            </div>
                            
                            <div class="col-sm-3 col-xs-12">
                                {!! Form::select('box_weight', [500=>'0-500 Gm', 1000=>'500 Gm - 1 KG', 1500=>'1 KG - 1.5 KG', 2000=>'1.5 KG - 2 KG', 2500=>'2 KG - 2.5 KG', 3000=>'2.5 KG - 3 KG', 3500=>'3 KG - 3.5 KG', 4000=>'3.5 KG - 4 KG', 4500=>'4 KG - 4.5 KG', 5000=>'4.5 KG - 5 KG', 5500=>'5 KG - 5.5 KG', 6000=>'5.5 KG - 6 KG', 6500=>'6 KG - 6.5 KG', 7000=>'6.5 KG - 7 KG'], round( $label['parcel']['weight']['weight'] / env('GM_TO_OZ') ), ['class'=> 'form-control select2', 'placeholder'=> '-Capacity-'] ) !!}
                            </div>
                            
                        </div>
                        
                        
                        <div class="col-xs-12 push-up-20 shipping-products">
                            <h2 class="section-heading">Add Items to your Shipping Label <a href="#" class="btn btn-rounded green-bg white-text push-up-5 push-down-5 increment-shipping-label-item"><i class="fa fa-plus white-text"></i></a></h2>
                            
                            @if( count($label['customs']['customsItems']) > 0 )
                            @foreach( $label['customs']['customsItems'] as $k=>$v )
                            
                            <div class="row shipping-label-item">
                                <div class="col-xs-12">
                                    <a href="#" class="btn btn-sm btn-rounded orange-bg white-text @if($k == 0) hidden @endif del-label-item pull-right push-up-10 push-down-5">
                                        <i class="fa fa-trash-o white-text"></i>
                                    </a>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    {!! Form::text('item_name[]', $v['description'], ['class'=> 'form-control', 'placeholder'=> 'Item Description', 'required'=> 'required' ]) !!}
                                    {!! Form::text('item_quantity[]', $v['quantity'], ['class'=> 'form-control push-up-10', 'placeholder'=> 'Quantity', 'required'=> 'required' ]) !!}
                                </div>
                                
                                <div class="col-sm-4 col-xs-12">
                                    {!! Form::text('item_weight[]', $v['unitWeight']['weight'], ['class'=> 'form-control', 'placeholder'=> 'Weight (Gm)', 'required'=> 'required' ]) !!}
                                    {!! Form::text('item_value[]', $v['unitPrice'], ['class'=> 'form-control push-up-10', 'placeholder'=> 'Value of each (USD)', 'required'=> 'required' ]) !!}
                                </div>
                                
                                <div class="col-sm-4 col-xs-12">
                                    {!! Form::text('item_hs_terrif[]', $v['hSTariffCode'], ['class'=> 'form-control', 'placeholder'=> 'HS Terrif (optional)' ]) !!}
                                    {!! Form::select('item_country[]', \App\Country::lists('name', 'id'), \App\Country::where('code', $v['originCountryCode'] )->first()->id, ['class'=> 'form-control select2', 'placeholder'=>'Where this item made', 'required'=> 'required' ]) !!}
                                </div>
                            </div>
                            
                            @endforeach
                            @endif
                            
                        </div>
                        
                    </section>
                
                    <section class="row">
                        <div class="col-xs-12 text-center pull-up-20">
                            {!! Form::submit('Calculate Cost & Buy', ['class'=>'btn btn-lg blue-bg white-text large-font']) !!}
                        </div>
                    </section>
                
                {!! Form::close() !!}
                
                @else
                
                <h2 class="section-heading blue-text">No Editable Label was found. <a href="{{action('Shippings@getLabel')}}" class="btn btn-lg btn-rounded blue-bg white-text">Buy New Label</a></h2>
                
                @endif
                
            </div>
        </div>
        
        
    </div>
</section>


@stop