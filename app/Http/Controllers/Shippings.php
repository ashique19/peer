<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\shippingsStoreRequest;
use App\Http\Controllers\Controller;
use App\Shipping;
use App\Http\Controllers\Pitneybowes;

class Shippings extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.shippings.index', ['shippings'=> Shipping::paginate(20)]);
        
    }
    
    /**
     * Searches the listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchIndex(Request $request)
    {
    
        $search = array_filter($request->all());
        unset($search['_token']);
        
        $result =   new Shipping;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('cost'))   ? $result = $result->where('cost', 'like', '%'.$request->input('cost').'%') : false;
					($request->input('delivery_days'))   ? $result = $result->where('delivery_days', 'like', '%'.$request->input('delivery_days').'%') : false;
        
        return view('admin.shippings.index', ['shippings'=> $result->paginate(20)]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.shippings.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(shippingsStoreRequest $request)
    {
        
        
        
        if(Shipping::create($request->all())){
        
            return redirect()->action('Shippings@index')->withErrors('Data has been stored successfully.');
        
        } else{
            
            return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return view('admin.shippings.show', ['shipping'=> Shipping::find($id)] );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return view('admin.shippings.edit', ['shipping'=> Shipping::find($id)] );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(shippingsStoreRequest $request, $id)
    {
        $shipping = Shipping::find($id);
        
        
        
        if(Shipping::find($id)->update($request->all()))
        {
        
            return redirect()->action('Shippings@index')->withErrors('Data has been updated successfully.');
        
        } else{
            
            return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        
        $shipping = Shipping::find($id);
        
        if($shipping)
        {
    
    
            if($shipping->delete())
            {
            
                return redirect()->action('Shippings@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    public function getLabel()
    {   
        
        // session(['user_type'=>'buyer']);
        
        $rates = [];
        
        return view('user.pages.labels', compact('rates') );
        
    }
    
    
    
    public function postLabel(Request $request)
    {
        
        $label_to_delete = $request->has('delete_label') ? $request->input('delete_label') : null;
        
        if( ! $request->input('item_name') ) return back()->withErrors('Please add products for your Shipping Label.')->withInput();
        
        $customs = $this->prepareCustomsInfo($request);
        
        if( ! $customs ) return back()->withErrors('Your parcel weight seems greater than your box capacity. Please select a box size with higher capacity.');
        
        $rates = $this->getPitneybowesRates($request);
        
        $from_or_error = array_shift($rates);

        if( array_key_exists( 'errorCode', $from_or_error ) ) return back()->withInput()->withErrors('Failed to get rates for your given parameters. Please change values and try again.');
        
        $data = [
            'from'      => (array) json_decode( json_encode( $from_or_error ), true ),
            'to'        => (array) json_decode( json_encode($rates['toAddress']), true ),
            'parcel'    => (array) json_decode( json_encode($rates['parcel']), true ),
            'rates'     => (array) json_decode( json_encode($rates['rates']), true ),
            'customs'   => (array) $customs,
        ];
        
        session(['label_purchase_preference'=> $data]);
        
        return view('user.pages.labels-buy', compact('data', 'parcel_parameters', 'label_to_delete') );
        
    }
    
    
    
    public function returnPitneybowesRates(Request $request)
    {
        
        $rates = ( new \App\Http\Controllers\BuyOrders )->pitneybowesRateForNewOrder($request);
        
        $shipping = 0;
        
        
        if( count( $rates['rates'] ) > 0 )
        {
            
            foreach( $rates['rates'] as $rate )
            {
                
                if( $rate['serviceId'] == 'PMI' )
                {
                    
                    $shipping = $rate['totalCarrierCharge'];
                    
                }
                
            }
            
        }
        
        
        
        
        $amazon_items = $request->has('amazon_quantity') ? $request->input('amazon_quantity') : [];
        $amazon_price = $request->has('amazon_price') ? $request->input('amazon_price') : [];
        $other_items = $request->has('other_quantity') ? $request->input('other_quantity') : [];
        $other_price = $request->has('other_price') ? $request->input('other_price') : [];
        
        $order_value = 0;
        
        if( count($amazon_items) > 0 )
        {
            
            for( $i = 0; $i < count( $amazon_items ); $i++ )
            {
                
                $order_value += $amazon_items[$i] * $amazon_price[$i];
                
            }
            
        }
        
        if( count($other_items) > 0 )
        {
            
            for( $i = 0; $i < count( $other_items ); $i++ )
            {
                
                $order_value += $other_items[$i] * $other_price[$i];
                
            }
            
        }
        
        
        
        $airposted_fee = round( ( $shipping + $order_value ) * env('AIRPOSTED_ORDER_MARGIN_PERCENTAGE') / 100, 2 );
        
        $gateway_fee = gateway_charge( $order_value + $shipping + $airposted_fee );
        
        $total_fee = $shipping + $airposted_fee + $gateway_fee;
        
        return $total_fee;
        
    }
    
    
    
    public function returnAllPitneybowesRates(Request $request)
    {
        
        return ( new \App\Http\Controllers\BuyOrders )->pitneybowesRateForNewOrder($request);
        
        
    }
    
    
    
    public function getPitneybowesRates($request)
    {
        
        $pitneybowes = new Pitneybowes;
        
        $parcel_parameters = [
                                "fromAddress"=>[
                                     "addressLines"=> strlen( $request->input('sender_address')) > 40 ? [ substr($request->input('sender_address'), 0, 38), substr($request->input('sender_address'), 38, 76)] : [$request->input('sender_address')],
                                     "cityTown"=> \App\City::find( $request->input('sender_city_id') ) ? \App\City::find( $request->input('sender_city_id') )->name : "",
                                     "stateProvince"=> strtoupper($request->input('sender_state')),
                                     "postalCode"=> $request->input('sender_postcode'),
                                     "countryCode"=> "US",
                                     "name"=> $request->input('sender_name'),
                                     "company"=> $request->input('sender_company'),
                                     "phone"=> $request->input('sender_phone'),
                                     "email"=> $request->input('sender_email'),
                                     "residential" => true,
                                     "status"=>"NOT_CHANGED"
                                ],
                                "toAddress"=>[
                                     "addressLines"=> strlen( $request->input('receiver_address')) > 40 ? [ substr($request->input('receiver_address'), 0, 38), substr($request->input('receiver_address'), 38, 76)] : [$request->input('receiver_address')],
                                     "cityTown"=> \App\City::find($request->input('receiver_city_id')) ? \App\City::find($request->input('receiver_city_id'))->name : "",
                                     "stateProvince"=> strtoupper($request->input('receiver_state')),
                                     "postalCode"=> $request->input('receiver_postcode'),
                                     "countryCode"=> \App\Country::find( $request->input('receiver_country_id') ) ? \App\Country::find($request->input('receiver_country_id'))->code : "",
                                     "name"=> $request->input('receiver_name'),
                                     "company"=> $request->input('receiver_company'),
                                     "phone"=> $request->input('receiver_phone'),
                                     "email"=> $request->input('receiver_email'),
                                     "residential"=> true,
                                     "status"=>"NOT_CHANGED"
                                ],
                                "parcel"=>[
                                    "weight"=>[
                                        "unitOfMeasurement"=>"OZ",
                                        "weight"=> round( $request->input('box_weight') * env('GM_TO_OZ'), 4),
                                        ],
                                    "dimension"=>[
                                    "unitOfMeasurement"=>"IN",
                                    "length"=> $request->input('box_length'),
                                    "width"=> $request->input('box_width'),
                                    "height"=> $request->input('box_height'),
                                    "irregularParcelGirth"=>0.002
                                    ]
                                ],
                                "rates"=>[
                                    [
                                    "carrier"=> $request->input('shipping_agent'),
                                    // "serviceId"=> "EMI", // Ignore it for Pitney to show options to select from
                                    "parcelType"=>"PKG",
                                    "inductionPostalCode"=>$request->input('sender_postcode'),
                                    ]
                                ],
                                
                            ];
        // return $parcel_parameters;
        $rates = $pitneybowes->getRates( $parcel_parameters );
        
        $rates = (array) json_decode( json_encode($rates), true );
        
        return $rates;
        
    }
    
    
    /**
     * Create Label object at database to "labels" & "payments" table
     * 
     * @return @redirect to Paypal / Stripe (Payment Gateway) for Payment
    */
    public function draftLabel(Request $request)
    {
        
        $request->has('delete_label') ? \App\Label::find( $request->input('delete_label') )->payment()->delete() : false;
        
        $pitneybowes = new Pitneybowes;
        
        $data = session('label_purchase_preference');
        
        $data['rate'] = $data['rates'][ $request->input('rate_id') ];
        
        $rates = [
            [
                "carrier"=> $data['rate']['carrier'],
                "serviceId"=> $data['rate']['serviceId'],
                "parcelType"=> $data['rate']['parcelType'],
                "inductionPostalCode"=> $data['from']['postalCode'],
                "rateTypeId" => $data['rate']['rateTypeId']
            ]
        ];
        
        $preparedData = [
            "fromAddress"   => $data['from'],
            "toAddress"     => $data['to'],
            "parcel"=> [
                "weight"=> [
                    "unitOfMeasurement"=> "OZ",
                    "weight"=> $data['parcel']['weight']['weight']
                ],
                "dimension"=> [
                    "unitOfMeasurement"=> "IN",
                    "length"=> $data['parcel']['dimension']['length'],
                    "width"=> $data['parcel']['dimension']['width'],
                    "height"=> $data['parcel']['dimension']['height'],
                    "irregularParcelGirth"=> 0.002
                ]
            ],
            "rates"=> [ $data['rate'] ],
            "documents"=> [ 
                [
                    "type"=> "SHIPPING_LABEL",
                    "contentType"=> "URL",
                    "size"=> "DOC_8X11",
                    "fileFormat"=> "PDF",
                    "printDialogOption"=> "EMBED_PRINT_DIALOG"
                ] 
            ],
            "customs" => $data['customs'],
            "shipmentOptions"=> [ 
                [
                "name"=> "SHIPPER_ID",
                "value"=> $pitneybowes->getShipperID()
                ],
                [
                "name"=> "ADD_TO_MANIFEST",
                "value"=> "true"
                ],
                [
                "name"=> "HIDE_TOTAL_CARRIER_CHARGE",
                "value"=> "true"
                ],
                [
                "name"=> "PRINT_CUSTOM_MESSAGE_1",
                "value"=> "YOUR BEST VALUE FOR MONEY WITH AIRPOSTED"
                ],
                [
                "name"=> "SHIPPING_LABEL_RECEIPT",
                "value"=> "NO_OPTIONS"
                ] 
            ]
        ];
        
        session([ 'label_detail' => $preparedData ]);
        
        /**
         * Steps:
         *  - Create Payment object
         *  - Create Label object
         *  - Redirect to Paypal
         *  - If Paypal succeeds, redirect to Shippings@buyLabel to purchase label
        */
        
        $payment = $this->createLabelPayment( $preparedData, $request->input('gateway_id') );
        
        $label = $this->createLabel( $payment, $preparedData );
        
        if( $request->input('gateway_id') == 1 )
        {
            
            return \Redirect::to( action('Payments@payNowPaypal', $payment->id) );
            
        } elseif( $request->input('gateway_id') == 2 )
        {
            
            return redirect()->action('Payments@stripePaymentPage', $payment->id);
            
        }
        
        
        return $label;
        
    }
    
    
    public function buyLabel()
    {
        
        $pitneybowes = new Pitneybowes;
        
        $createLabelData = session('label_detail');
        
        $label = json_decode($pitneybowes->createLabel($createLabelData));
        
        return $label;
        
    }
    
    
    public function updateDraftLabel( $purchasedLabel, $payment )
    {
        
        $purchasedLabel = (array) json_decode( json_encode($purchasedLabel), true );
        
        if( array_key_exists('errorCode', head($purchasedLabel)) )
        {
            
            if( $purchasedLabel[0]['errorCode'] == 1150003 )
            {
                
                ( new \App\Http\Controllers\Mails )->labelPurchaseFailedInsufficientBalanceAdmin($purchasedLabel[0], auth()->user(), $payment);
                
                ( new \App\Http\Controllers\Mails )->labelPurchaseFailedInsufficientBalanceUser($purchasedLabel[0], auth()->user(), $payment);
                
                return false;
            }
        
            ( new \App\Http\Controllers\Mails )->labelPurchaseFailedUnknownIssueAdmin($purchasedLabel[0], auth()->user(), $payment);
            
            ( new \App\Http\Controllers\Mails )->labelPurchaseFailedUnknownIssueUser($purchasedLabel[0], auth()->user(), $payment);
            
            return $purchasedLabel['message'];
            
        }
        
        if( $payment->label )
        {
            
            $payment->label()->update([
                'is_paid'   => 1,
                'documents_type' => $purchasedLabel['documents'][0]['type'],
                'documents_contentType' => $purchasedLabel['documents'][0]['contentType'],
                'documents_fileFormat' => $purchasedLabel['documents'][0]['fileFormat'],
                'documents_contents' => $purchasedLabel['documents'][0]['contents'],
                'shipmentId'    => $purchasedLabel['shipmentId'],
                'parcelTrackingNumber'  => $purchasedLabel['parcelTrackingNumber'],
            ]);
            
        }
        
        return true;
        
    }
    
    
    private function createLabelPayment( $data, $gatewayID )
    {
        
        return \App\Payment::create([
            'name'                  => 'Shipping Label',
            'payment_type'          => 3,
            'buyer_id'              => auth()->user()->id,
            'from_country_id'       => \App\Country::where('name','United States')->first()->id,
            'product_price'         => $data['rates'][0]['totalCarrierCharge'],
            'airposted_commission'  => round($data['rates'][0]['totalCarrierCharge'] * ( env('AIRPOSTED_SHIPPING_LABEL_MARGIN_PERCENTAGE') / 100), 2),
            'transaction_charge'    => 0,
            'payment'               => round($data['rates'][0]['totalCarrierCharge'] * (1 + env('AIRPOSTED_SHIPPING_LABEL_MARGIN_PERCENTAGE') / 100), 2),
            'gateway_id'            => $gatewayID,
            'status'                => 1,
            'is_delivered'          => 1
        ]);
        
    }
    
    
    private function createLabel( $payment, $data )
    {
        
        $label = \App\Label::create([
            'user_id' => auth()->user()->id,
            'payment_id' => $payment->id,
            'buyer_name' => $data['fromAddress']['name'],
            'buyer_company' => $data['fromAddress']['company'],
            'buyer_email' => $data['fromAddress']['email'],
            'buyer_phone' => $data['fromAddress']['phone'],
            'buyer_residential' => $data['fromAddress']['residential'],
            'buyer_addressLines' => implode(',', $data['fromAddress']['addressLines']),
            'buyer_cityTown' => $data['fromAddress']['cityTown'],
            'buyer_stateProvince' => $data['fromAddress']['stateProvince'],
            'buyer_postalCode' => $data['fromAddress']['postalCode'],
            'receiver_name' => $data['toAddress']['name'],
            'receiver_company' => $data['toAddress']['company'],
            'receiver_email' => $data['toAddress']['email'],
            'receiver_phone' => $data['toAddress']['phone'],
            'receiver_residential' => $data['toAddress']['residential'],
            'receiver_addressLines' => implode(',',$data['toAddress']['addressLines']),
            'receiver_cityTown' => $data['toAddress']['cityTown'],
            'receiver_stateProvince' => $data['toAddress']['stateProvince'],
            'receiver_postalCode' => $data['toAddress']['postalCode'],
            'receiver_countryCode' => $data['toAddress']['countryCode'],
            'parcel_weight_amount' => $data['parcel']['weight']['weight'],
            'parcel_weight_unitOfMeasurement' => $data['parcel']['weight']['unitOfMeasurement'],
            'parcel_dimension_unitOfMeasurement' => $data['parcel']['dimension']['unitOfMeasurement'],
            'parcel_dimension_length' => $data['parcel']['dimension']['length'],
            'parcel_dimension_width' => $data['parcel']['dimension']['width'],
            'parcel_dimension_height' => $data['parcel']['dimension']['height'],
            'parcel_dimension_irregularParcelGirth' => $data['parcel']['dimension']['irregularParcelGirth'],
            'rates_carrier' => $data['rates'][0]['carrier'],
            'rates_parcelType' => $data['rates'][0]['parcelType'],
            'rates_serviceId' => $data['rates'][0]['serviceId'],
            'rates_rateTypeId' => $data['rates'][0]['rateTypeId'],
            'rates_deliveryCommitment_minEstimatedNumberOfDays' => $data['rates'][0]['deliveryCommitment']['minEstimatedNumberOfDays'],
            'rates_deliveryCommitment_maxEstimatedNumberOfDays' => $data['rates'][0]['deliveryCommitment']['maxEstimatedNumberOfDays'],
            'rates_deliveryCommitment_estimatedDeliveryDateTime' => $data['rates'][0]['deliveryCommitment']['estimatedDeliveryDateTime'],
            'rates_deliveryCommitment_guarantee' => $data['rates'][0]['deliveryCommitment']['guarantee'],
            'rates_deliveryCommitment_additionalDetails' => $data['rates'][0]['deliveryCommitment']['additionalDetails'],
            'rates_baseCharge' => $data['rates'][0]['baseCharge'],
            'rates_totalCarrierCharge' => $data['rates'][0]['totalCarrierCharge'],
            'rates_destinationZone' => $data['rates'][0]['destinationZone'],
            'documents_type' => $data['documents'][0]['type'],
            'documents_contentType' => $data['documents'][0]['contentType'],
            'documents_size' => $data['documents'][0]['size'],
            'documents_fileFormat' => $data['documents'][0]['fileFormat'],
            'documents_contents' => $data['documents'][0]['printDialogOption'],
        ]);
        
        $product = new \App\Label_product;
        
        if( count($data['customs']['customsItems']) > 0 )
        {
            
            foreach($data['customs']['customsItems'] as $item)
            {
                
                $product->create([
                    'label_id' => $label->id,
                    'name' => $item['description'],
                    'quantity' => $item['quantity'],
                    'weight' => $item['unitWeight']['weight'],
                    'value' => $item['unitPrice'],
                    'country_id' => \App\Country::where('code', $item['originCountryCode'])->first()->id,
                    'hs_tarrif' =>$item['hSTariffCode'],
                ]);
                
            }
            
        }
        
        
        return $label;
        
    }
    
    
    private function prepareCustomsInfo($request)
    {
        
        
        $customsItems = [];
        
        $weight = 0;
        
        for( $i = 0; $i < count($request->input('item_name')); $i++ )
        {
            
            $customsItems[] = [
                                    "description"=> $request->input('item_name')[$i],
                                    "quantity"=> $request->input('item_quantity')[$i] * 1,
                                    "unitPrice"=> $request->input('item_value')[$i] * 1,
                                    "unitWeight"=> [
                                        "weight"=> gm_to_oz($request->input('item_weight')[$i]),
                                        "unitOfMeasurement"=> "OZ"
                                    ],
                                    "hSTariffCode"=> $request->input('item_hs_terrif')[$i],
                                    "originCountryCode"=> \App\Country::find($request->input('item_country')[$i])->code
                                ];
            
            $weight += $request->input('item_weight')[$i] * $request->input('item_quantity')[$i];
            
        }
        
        $customs = [
            "customsInfo"=> [
                "reasonForExport" => $request->input('parcel_type'),
                "comments" => "",
                "invoiceNumber" => "123456",    // needs to create order ID and place here
                "importerCustomsReference" => "",
                "insuredNumber" => "",
                "insuredAmount" => 0,
                "sdrValue" => 0,
                "EELPFC" => "NOEEI 30.2D2", // Dont know what to place here
                "fromCustomsReference" => "11111",
                "currencyCode" => "USD",
                "licenseNumber" => "",
                "certificateNumber" => ""
            ],
            "customsItems" => $customsItems
        ];
        
        if( $weight > $request->input('box_weight') * 1 ) return false;
            
        return $customs;
        
        
    }
    
}
