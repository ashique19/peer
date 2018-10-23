<?php

namespace App\Http\Controllers;

use App\BuyerNew;
use App\Models\Cart;
use App\Repository\CartRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mails;
use App\Http\Controllers\Pitneybowes;
use App\Order;
use App\Label;
use App\Payment;
use App\Order_product;
use App\Order_log;
use App\Country;
use Illuminate\Support\Facades\Auth;


class BuyOrders extends Controller
{
    
    public function newOrder()
    {
        
        session(['user_type'=>'order']);
        
        return view('user.pages.orders-new');
        
    }
    
    
    public function pitneybowesRateForNewOrder($request)
    {
        
        $pitneybowes = new Pitneybowes;
        
        $dimension = ($request->input('box_weight') / 1000) * $request->input('box_length') * $request->input('box_width') * $request->input('box_height') / 5000;
        
        $parcel_parameters = [
                                "fromAddress"=>[    // From address = Airposted Address
                                     "addressLines"=> [ substr( '4445 Corporation Lane, STE 264', 0, 38), substr( '4445 Corporation Lane, STE 264', 38, 76)],
                                     "cityTown"=> 'Virginia Beach',
                                     "stateProvince"=> 'Virginia',
                                     "postalCode"=> '23462',
                                     "countryCode"=> "US",
                                     "name"=> 'Airposted, USA',
                                     "company"=> 'Airposted, USA',
                                     "phone"=> '123456',
                                     "email"=> 'support@airposted.com',
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
                                    "width"=> $dimension < $request->input('box_length') ? $request->input('box_width') : $request->input('box_width') - ($dimension - $request->input('box_length')) /2 - 0.02,
                                    "height"=> $dimension < $request->input('box_length') ? $request->input('box_height') : $request->input('box_height') - ($dimension - $request->input('box_length')) /2 - 0.02,
                                    "irregularParcelGirth"=>0.002
                                    ]
                                ],
                                "rates"=>[
                                    [
                                    "carrier"=> 'usps',
                                    // "serviceId"=> "EMI", // Ignore it for Pitney to show options to select from
                                    "parcelType"=>"PKG",
                                    "inductionPostalCode"=> '23462',
                                    ]
                                ],
                                
                            ];
                            
                            
        // return $parcel_parameters;
        return $pitneybowes->getRates($parcel_parameters);
        
    }
    
    
    public function postNewOrder(Request $request, \App\Country $countries, Mails $mail)
    {
        
        $shipping_rate = $this->pitneybowesRateForNewOrder($request);
        
        $shipping_charge = 0;
        
        
        if( count( $shipping_rate['rates'] ) > 0 )
        {
            
            foreach( $shipping_rate['rates'] as $rate )
            {
                
                if( $rate['serviceId'] == 'PMI' )
                {
                    
                    $shipping_charge = round( $rate['totalCarrierCharge'] );
                    
                }
                
            }
            
        }
        
        
        /**
         * Steps:
         * 1. create order
         * 2. create products > update order
         * 3. create payment > update order
         * 4. create label > update order
        */
        
        /**
         * Check if any product was added to order. 
         * 
         * @return back if not.
        */ 
        if( ! $request->has('amazon_name') && ! $request->has('other_name') ) return back()->withErrors('Sorry, we could not find any product in your order. Please place the order again to continue.');
        
        
        /**
         * Save Order
        */
        $saved_order = Order::create([
            'name' => $request->input('sender_name') .'('.$countries->find($request->input('sender_country_id'))->name .') > '. $request->input('receiver_name') .'('.$countries->find($request->input('receiver_country_id'))->name.')' ,
            'user_id' => auth()->user()->id,
            'shipping_cost' => round( $shipping_charge )
        ]);
        
        $order = Order::find($saved_order->id);
        
        
        /**
         * Save Product
        */
        $savedProducts = $this->saveProducts($request, $order); // returns array of inserted product id's
        
        // if any error in product data, return back.
        if( count($savedProducts) == 0 ) return back()->withErrors('Failed to save Order. No valid product data was found.');
        

        
        /**
         * Update Airposted commission and order total
        */         
        $order_value = 0;
        
        foreach( $savedProducts as $product )
        {
            
            $order_value += round( $product->price * $product->quantity );
            
        }
        
        $airposted_margin = ( $order_value + $shipping_charge ) * env('AIRPOSTED_ORDER_MARGIN_PERCENTAGE') / 100;
        
        $total_before_transaction_charge = round( $order_value + $shipping_charge + $airposted_margin );
        
        $transaction_charge = gateway_charge($total_before_transaction_charge);
        
        $order->update([ 'airposted_margin' => $airposted_margin, 'product_cost' => $order_value, 'order_total' => $total_before_transaction_charge + $transaction_charge  ]);
        
        // return $order;
        /**
         * Save Payment
        */
        $payment = $this->savePayment($request, $order, $transaction_charge);
        
        
        // if any error while saving payment, return back.
        if( ! $payment ) return back()->withErrors('Failed to save Order as Failed to save Payment. Please retry later.')->withInput();
        

        /**
         * Save Label
        */
        $label = $this->saveLabel($request, $order, $payment);
        
        
        /**
         * Save Log
        */
        $log = $this->saveLog('New Order', $order, $order->user_id, 'New Purchase order has been placed.');
        
        
        \App\Notification::create([
            'notification_to' => auth()->user()->id,
            'name' => 'Thanks for your order. You can track your order updates from ORDER HISTORY.',
            'link' => 'order-summary/'.$order->id ,
        ]);
        
        
        /**
         * Send confirmation email to User and Admin
        */
        $mail->orderPlacedUser(auth()->user());
        $mail->orderPlacedAdmin(auth()->user(), $order);
        
        
        return view('user.pages.orders-success');
        
    }
    
    
    public function history()
    {
        
        $orders = Order::where('user_id', auth()->user()->id)->latest()->paginate(30);
        
        return view('user.pages.orders-history', compact('orders'));
        
    }

    public function orderSummary($orderID, CartRepository $cartRepository)
    {
        $loggedInUserId = Auth::user()->id;
        $cartRepository->deleteByUser($loggedInUserId);
        $boughtItems = BuyerNew::where('user_id', '=', $loggedInUserId);
        //@todo need to add log at payment table
//        Payment::create(['user_id' => $loggedInUserId,
//            'payment_type' => 2, 'buyer_id' => $loggedInUserId, 'from_country_id', 'to_country_id', 'product_price', 'traveller_commission', 'airposted_commission', 'transaction_charge', 'payment', 'gateway_id', 'status', 'is_delivered']);
        return view('user.pages.product.payment-confirmation');
    }
//    public function orderSummary($orderID)
//    {
//
//        $order = auth()->user()->orders()->where('orders.id', $orderID)->first();
//
//        $label = $order ? $order->label : [];
//
//        $products = $order ? $order->order_products : [];
//
//        $payment = $order ? $order->payment : [];
//
//        return view('user.pages.orders-summary', compact('order', 'label', 'products', 'payment'));
//
//    }
    
    
    private function saveProducts($request, $order)
    {
        
        $productsToSave = [];
        $savedProducts  = [];
        $products       = new Order_product;
        $units          = 0;
        $cost           = 0;
        
        if( $request->has('amazon_name') )
        {
            
            for($i = 0; $i < count($request->input('amazon_name')); $i++)
            {
                
                $productsToSave[] = [
                    'name'          => $request->input('amazon_name')[$i],
                    'order_id'      => $order->id,
                    'source'        => 'amazon',
                    'product_url'   => $request->input('amazon_url')[$i],
                    'category_id'   => $request->input('amazon_category_id')[$i],
                    'price'         => $request->input('amazon_price')[$i],
                    'height'        => $request->input('amazon_height')[$i],
                    'width'         => $request->input('amazon_width')[$i],
                    'length'        => $request->input('amazon_length')[$i],
                    'weight'        => $request->input('amazon_weight')[$i],
                    'dimension_unit'=> 'inch',
                    'weight_unit'   => 'gm',
                    'product_image' => ( strlen( $request->input('amazon_image_url')[$i] ) > 5 && starts_with($request->input('amazon_image_url')[$i], 'data:image')) ? save_base64_image( $request->input('amazon_image_url')[$i], 'amazon_'.$order->id.'_'.$i, 'public/img/orders/' ) :  $request->input('amazon_image_url')[$i],
                    'quantity'      => $request->input('amazon_quantity')[$i],
                    'note'          => $request->input('amazon_note')[$i],
                ];
                
                $units  += $request->input('amazon_quantity')[$i];
                $cost   += $request->input('amazon_price')[$i];
                
            }
            
        }
        
        if( $request->has('other_name') )
        {
            
            for($i = 0; $i < count($request->input('other_name')); $i++)
            {
                
                $productsToSave[] = [
                    'name'          => $request->input('other_name')[$i],
                    'order_id'      => $order->id,
                    'source'        => 'others',
                    'product_url'   => $request->input('other_url')[$i],
                    'category_id'   => $request->input('other_category_id')[$i],
                    'price'         => $request->input('other_price')[$i],
                    'height'        => $request->input('other_height')[$i],
                    'width'         => $request->input('other_width')[$i],
                    'length'        => $request->input('other_length')[$i],
                    'weight'        => $request->input('other_weight')[$i],
                    'dimension_unit'=> 'inch',
                    'weight_unit'   => 'gm',
                    'product_image' => ( strlen( $request->input('non_amazon_image_url')[$i] ) > 5 && starts_with($request->input('non_amazon_image_url')[$i], 'data:image')) ? save_base64_image( $request->input('non_amazon_image_url')[$i], 'non_amazon_'.$order->id.'_'.$i, 'public/img/orders/' ) :  $request->input('non_amazon_image_url')[$i],
                    'quantity'      => $request->input('other_quantity')[$i],
                    'note'          => $request->input('other_note')[$i],
                ];
                
                $units  += $request->input('other_quantity')[$i];
                $cost   += $request->input('other_price')[$i];
                
            }
            
        }
        
        if( count($productsToSave) > 0 )
        {
            
            foreach($productsToSave as $product)
            {
                
                $savedProducts[] = $products->create($product);
                
            }
            
            $order->update([
                'no_of_products' => $units,
                'product_cost'   => $cost,
            ]);
            
        } else{
            
            $order->delete();
            
        }
        
        
        return $savedProducts;
        
    }
    
    
    private function savePayment($request, $order, $transaction_charge)
    {
        
        $saved_payment = Payment::create([
                        'name' => $order->name,
                        'payment_type' => 2,
                        'buyer_id' => auth()->user()->id,
                        'from_country_id'=> $request->input('sender_country_id'),
                        'to_country_id'=> $request->input('receiver_country_id'),
                        'product_price' => $order->product_cost,
                        'airposted_commission' => $order->airposted_margin,
                        'transaction_charge' => $transaction_charge,
                        'payment' => $order->order_total
                    ]);
                    
        $order->update(['payment_id'=> $saved_payment->id]);
        
        return Payment::find($saved_payment->id);
        
    }
    
    
    private function saveLabel($request, $order, $payment)
    {
        
        $saved_label = Label::create([
                        'name' => $order->name,
                        'user_id' => auth()->user()->id,
                        'payment_id' => $payment->id,
                        'type' => 2,
                        'buyer_name' => $request->input('sender_name'),
                        'buyer_company' => '',
                        'buyer_email' => $request->input('sender_email'),
                        'buyer_phone' => $request->input('sender_phone'),
                        'buyer_residential' => true,
                        'buyer_addressLines' => $request->input('sender_address'),
                        'buyer_cityTown' => \App\City::find($request->input('sender_city_id')) ? \App\City::find($request->input('sender_city_id'))->name : '',
                        'buyer_stateProvince' => $request->input('sender_state'),
                        'buyer_postalCode' => $request->input('sender_postcode'),
                        'buyer_countryCode' => \App\Country::find($request->input('sender_country_id'))->code,
                        'receiver_name' => $request->input('receiver_name'),
                        'receiver_company' => '',
                        'receiver_email' => $request->input('receiver_email'),
                        'receiver_phone' => $request->input('receiver_phone'),
                        'receiver_residential' => true,
                        'receiver_addressLines' => $request->input('receiver_address'),
                        'receiver_cityTown' => \App\City::find($request->input('receiver_city_id')) ? \App\City::find($request->input('receiver_city_id'))->name : '',
                        'receiver_stateProvince' => $request->input('receiver_state'),
                        'receiver_postalCode' => $request->input('receiver_postcode'),
                        'receiver_countryCode' => \App\Country::find($request->input('receiver_country_id'))->code,
                        'parcel_weight_amount' => round( $request->input('box_weight') * env('GM_TO_OZ'), 4),
                        'parcel_weight_unitOfMeasurement' => 'OZ',
                        'parcel_dimension_unitOfMeasurement' => 'IN',
                        'parcel_dimension_length' => $request->input('box_length'),
                        'parcel_dimension_width' => $request->input('box_width'),
                        'parcel_dimension_height' => $request->input('box_height'),
                        'parcel_dimension_irregularParcelGirth' => 0.002,
                        'rates_carrier' => 'usps',
                        'rates_parcelType' => '',
                        'rates_serviceId' => '',
                        'rates_rateTypeId' => '',
                        'rates_deliveryCommitment_minEstimatedNumberOfDays' => '',
                        'rates_deliveryCommitment_maxEstimatedNumberOfDays' => '',
                        'rates_deliveryCommitment_estimatedDeliveryDateTime' => '',
                        'rates_deliveryCommitment_guarantee' => '',
                        'rates_deliveryCommitment_additionalDetails' => '',
                        'rates_dimensionalWeight_weight' => '',
                        'rates_dimensionalWeight_unitOfMeasurement' => '',
                        'rates_baseCharge' => '',
                        'rates_totalCarrierCharge' => '',
                        'rates_alternateBaseCharge' => '',
                        'rates_currencyCode' => '',
                        'rates_destinationZone' => '',
                        'rates_alternateTotalCharge' => '',
                        'documents_type' => '',
                        'documents_contentType' => '',
                        'documents_size' => '',
                        'documents_fileFormat' => '',
                        'documents_contents' => '',
                        'shipperId' => '',
                        'shipmentId' => '',
                        'parcelTrackingNumber' => '',
                    ]);
        
        $label = Label::find($saved_label->id);
        
        $order->update(['label_id' => $label->id]);
        
        return $label;
        
    }
    
    
    private function saveLog($name, $order, $user, $detail)
    {
        
        $saved_log = Order_log::create([
            'name' => $name,
            'order_id' => $order->id,
            'user_id' => $user,
            'log_detail' => $detail
        ]);
        
        $log = Order_log::find($saved_log->id);
        
        return $log;
        
    }
    
}
