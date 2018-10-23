@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav-label')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
        
            <div class="col-sm-10 col-xs-12">
            
                <h1 class="section-heading blue-text">Buy Label</h1>
                <h2 class="section-heading black-text small-heading">Select Rate for your Shipment</h2>
                
                {!! errors($errors) !!}
                
                {!! Form::open(['url'=> action('Shippings@draftLabel'), 'enctype'=> 'multipart/form-data', 'class'=> 'blue-label buy-info-post' ]) !!}
                    
                    @if($label_to_delete != null)
                    
                    {!! Form::hidden('delete_label', $label_to_delete) !!}
                    
                    @endif
                    
                    @if( count($data['rates']) > 0 )
                    <section class="col-xs-12 push-down-20 box-group">
                        <h2 class="section-heading black-text small-heading">Rates</h2>
                        @for($i=0; $i < count($data['rates']); $i++)
                        <div class="col-xs-12 col-sm-6 col-md-4 panel-body">
                            <div class="box-option well col-xs-12 pull-10">
                                {!! Form::radio('rate_id', $i, old('rate_id'), ['required'=>'required']) !!}
                                <h3>Price : {{ round( $data['rates'][$i]['totalCarrierCharge'] * (1 + env('AIRPOSTED_SHIPPING_LABEL_MARGIN_PERCENTAGE') / 100 ) , 2) }} USD</h3>
                                <p>Delivery time (Approximate): {{$data['rates'][$i]['deliveryCommitment']['minEstimatedNumberOfDays']}}-{{$data['rates'][$i]['deliveryCommitment']['maxEstimatedNumberOfDays']}} Days</p>
                                <p class="small green-text">( {{shippingServiceCodes($data['rates'][$i]['serviceId'])}} )</p>
                            </div>
                        </div>
                        @endfor
                    </section>
                    
                    <section class="col-xs-12 push-down-20">
                        <h2 class="section-heading black-text small-heading">Select Payment Gateway</h2>
                        <div class="col-xs-12 col-sm-6 col-md-4 panel-body">
                            <div class="gateway-option well col-xs-12 pull-10">
                                {!! Form::radio('gateway_id', 1, old('gateway_id'), ['required'=>'required']) !!}
                                <h3>PayPal</h3>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 panel-body">
                            <div class="gateway-option well col-xs-12 pull-10">
                                {!! Form::radio('gateway_id', 2, old('gateway_id'), ['required'=>'required']) !!}
                                <h3>Debit/Credit Card</h3>
                            </div>
                        </div>
                    </section>
                    @endif
                    
                    <section class="col-sm-6 col-xs-12">
                        
                        <h2 class="section-heading black-text small-heading">Sender Information</h2>
                        
                        <table class="table table-responsive table-theme-1 table-condensed">
                            <tbody>
                                <tr>
                                    <td width="100">Name</td><td>{{$data['from']['name']}}</td>
                                </tr>
                                <tr>
                                    <td>Company</td><td>{{$data['from']['company']}}</td>
                                </tr>
                                <tr>
                                    <td>Country</td><td>{{$data['from']['countryCode']}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td><td>{{implode('',$data['from']['addressLines'])}}</td>
                                </tr>
                                <tr>
                                    <td>City</td><td>{{$data['from']['cityTown']}}</td>
                                </tr>
                                <tr>
                                    <td>State</td><td>{{$data['from']['stateProvince']}}</td>
                                </tr>
                                <tr>
                                    <td>Postcode</td><td>{{$data['from']['postalCode']}}</td>
                                </tr>
                                <tr>
                                    <td>Phone no.</td><td>{{$data['from']['phone']}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td><td>{{$data['from']['email']}}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </section>
                    
                    <section class="col-sm-6 col-xs-12">
                        
                        <h2 class="section-heading black-text small-heading">Receiver Information</h2>
                        
                        <table class="table table-responsive table-theme-1 table-condensed">
                            <tbody>
                                <tr>
                                    <td width="100">Name</td><td>{{$data['to']['name']}}</td>
                                </tr>
                                <tr>
                                    <td>Company</td><td>{{$data['to']['company']}}</td>
                                </tr>
                                <tr>
                                    <td>Country</td><td>{{$data['to']['countryCode']}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td><td>{{implode('', $data['to']['addressLines'])}}</td>
                                </tr>
                                <tr>
                                    <td>City</td><td>{{$data['to']['cityTown']}}</td>
                                </tr>
                                <tr>
                                    <td>State</td><td>{{$data['to']['stateProvince']}}</td>
                                </tr>
                                <tr>
                                    <td>Postcode</td><td>{{$data['to']['postalCode']}}</td>
                                </tr>
                                <tr>
                                    <td>Phone no.</td><td>{{$data['to']['phone']}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td><td>{{$data['to']['email']}}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </section>
                    
                    <section class="col-xs-12 push-up-30">
                        
                        <h2 class="section-heading black-text small-heading">Parcel Box Summary</h2>
                        
                        <table class="table table-responsive table-theme-1 table-condensed">
                            <thead>
                                <tr>
                                    <th>Agent</th>
                                    <th>Height</th>
                                    <th>Width</th>
                                    <th>Length</th>
                                    <th>Capacity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ strtoupper($data['rates'][0]['carrier']) }} ({{ str_replace('_', ' ', $data['customs']['customsInfo']['reasonForExport']) }})</td>
                                    <td>{{$data['parcel']['dimension']['height']}} Inch</td>
                                    <td>{{$data['parcel']['dimension']['width']}} Inch</td>
                                    <td>{{$data['parcel']['dimension']['length']}} Inch</td>
                                    <td>{{ round( $data['parcel']['weight']['weight'] /env('GM_TO_OZ') ) > 1000 ? round( $data['parcel']['weight']['weight'] / env('GM_TO_OZ') ) / 1000 : round( $data['parcel']['weight']['weight'] / env('GM_TO_OZ') ) }} {{round( $data['parcel']['weight']['weight'] / env('GM_TO_OZ') ) > 1000 ? 'KG' : 'GM'}}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </section>
                    
                    <section class="col-xs-12 push-up-30 scrollable">
                        
                        <h2 class="section-heading black-text small-heading">Parcel Items</h2>
                        
                        <table class="table table-responsive table-theme-1 table-condensed">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Weight (Gm)</th>
                                    <th>Value</th>
                                    <th>Made in</th>
                                    <th>HS Tarrif</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( count($data['customs']['customsItems']) > 0 )
                                @foreach( $data['customs']['customsItems'] as $item )
                                <tr>
                                    <td> {{$item['description']}} </td>
                                    <td> {{$item['quantity']}} </td>
                                    <td> {{$item['unitPrice']}} </td>
                                    <td> {{ oz_to_gm($item['unitWeight']['weight']) }} </td>
                                    <td> {{$item['originCountryCode']}} </td>
                                    <td> {{$item['hSTariffCode']}} </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        
                    </section>
                
                    <section class="row">
                        <div class="col-xs-12 text-center pull-up-20">
                            {!! Form::submit('Buy Label', ['class'=>'btn btn-lg green-bg white-text large-font']) !!}
                            <a href="{{action('Labels@sessionEditByUser')}}" class="btn btn-lg btn-rounded orange-bg white-text large-font">Edit Details</a>
                        </div>
                    </section>
                    {!! Form::close() !!}
                
            </div>
        </div>
        
        
    </div>
</section>


@stop