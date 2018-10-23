<?php

namespace App\Http\Controllers;

use App\Repository\CartRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\paymentsStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mails;
use App\Http\Controllers\Shippings;
use App\Payment;
use Paypal;
use Redirect;

class Payments extends Controller
{
    
    private $_apiContext;
    
    public function __construct()
    {
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.client_secret'));

        $this->_apiContext->setConfig(array(
            'mode' => config('services.paypal.mode'),
            'service.EndPoint' => config('services.paypal.service_endpoint'),
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));

    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.payments.index', ['payments'=> Payment::orderBy('id', 'desc')->paginate(20)]);
        
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
        
        $result =   new Payment;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('offer_id'))   ? $result = $result->where('offer_id', $request->input('offer_id')) : false;
					($request->input('buyer_id'))   ? $result = $result->where('buyer_id', $request->input('buyer_id')) : false;
					($request->input('traveller_id'))   ? $result = $result->where('traveller_id', $request->input('traveller_id')) : false;
					($request->input('from_country_id'))   ? $result = $result->where('from_country_id', $request->input('from_country_id')) : false;
					($request->input('to_country_id'))   ? $result = $result->where('to_country_id', $request->input('to_country_id')) : false;
					($request->input('product_price'))   ? $result = $result->where('product_price', 'like', '%'.$request->input('product_price').'%') : false;
					($request->input('agreed_price'))   ? $result = $result->where('agreed_price', 'like', '%'.$request->input('agreed_price').'%') : false;
					($request->input('airposted_commission'))   ? $result = $result->where('airposted_commission', 'like', '%'.$request->input('airposted_commission').'%') : false;
					($request->input('payment'))   ? $result = $result->where('payment', 'like', '%'.$request->input('payment').'%') : false;
					($request->input('gateway_id'))   ? $result = $result->where('gateway_id', $request->input('gateway_id')) : false;
					($request->input('status'))   ? $result = $result->where('status', 'like', '%'.$request->input('status').'%') : false;
					($request->input('is_delivered'))   ? $result = $result->where('is_delivered', 'like', '%'.$request->input('is_delivered').'%') : false;
					($request->input('gateway_payment_id'))   ? $result = $result->where('gateway_payment_id', $request->input('gateway_payment_id')) : false;
					($request->input('gateway_payer_id'))   ? $result = $result->where('gateway_payer_id', $request->input('gateway_payer_id')) : false;
        
        return view('admin.payments.index', ['payments'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.payments.create'  );
        
    }
    
    public function add1(CartRepository $cartRepository)
    {
        $data = $cartRepository->cart();
        return view('user.pages.product.payment', ['data' => $data]);
        
    }
    public function confirmation()
    {

        return view('user.pages.product.payment-confirmation');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(paymentsStoreRequest $request)
    {
        
        
        
        $save_success = Payment::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Payments@index')->withErrors('Data has been stored successfully.');
        
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
    
        $payment = Payment::find($id); 
        
        return view('admin.payments.show', compact('payment') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $payment = Payment::find($id); 
        
        return view('admin.payments.edit', compact('payment') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(paymentsStoreRequest $request, $id)
    {
        $payment = Payment::find($id);
        
        
        $save_success = Payment::find($id)->update($request->all());
        
        if($save_success)
        {
            
            if($payment->status == 2)
            {
                
                $updated_payment = Payment::find($id);
                
                if($updated_payment->status == 3)
                {
                    
                    $mail = new Mails;
                    
                    $mail->adminVerifiedPaymentNotifyBuyer($updated_payment->buyer_id);
                    
                    $mail->adminVerifiedPaymentNotifyTraveler($updated_payment->traveller_id);
                    
                }
                
            }
            
            return redirect()->action('Payments@index')->withErrors('Data has been updated successfully.');
        
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
        
        $payment = Payment::find($id);
        
        if($payment)
        {
    
    
            if($payment->delete())
            {
            
                return redirect()->action('Payments@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    public function buyer(Payment $payment)
    {
        
        $payments   = $payment->myBuys()->orderBy('id', 'desc')->paginate(20);
        // return $payments->first()->order;
        return view('user.pages.buyer-payment', compact('payments') );
        
    }
    
    
    public function paidByBuyer(Payment $payment)
    {
        
        $payments   = $payment->myBuys()->whereIn('status', [2,3])->orderBy('id', 'desc')->paginate(20);
        
        return view('user.pages.buyer-payment-paid', compact('payments') );
        
    }
    
    
    public function unpaidByBuyer(Payment $payment)
    {
        
        $payments   = $payment->myBuys()->whereIn('status', [0,1])->orderBy('id', 'desc')->paginate(20);
        
        return view('user.pages.buyer-payment-unpaid', compact('payments') );
        
    }
    
    
    public function traveller(Payment $payment)
    {
        
        $payments   = $payment->myCarries()->orderBy('id', 'desc')->paginate(20);
        
        return view('user.pages.traveller-payment', compact('payments') );
        
    }
    
    
    public function paidForTraveller(Payment $payment)
    {
        
        $payments   = $payment->myCarries()->whereIn('status', [2,3])->orderBy('id', 'desc')->paginate(20);
        
        return view('user.pages.traveller-payment-paid', compact('payments') );
        
    }
    
    
    public function unpaidForTraveller(Payment $payment)
    {
        
        $payments   = $payment->myCarries()->whereIn('status', [0,1])->orderBy('id', 'desc')->paginate(20);
        
        return view('user.pages.traveller-payment-unpaid', compact('payments') );
        
    }
    
    
    public function payzaSuccess(Request $request, $paymentID)
    {
        
        if( ! starts_with( \URL::previous() , 'https://payza.com' )  )
        {
            
            return redirect()->route('home')->withErrors('Who are you ???');
            
        }
        
        // return $request->all();
        
        $payment = Payment::where('id',$paymentID)
                        ->where('buyer_id', auth()->user()->id)
                        ->where('status', '<', 2)
                        ->first();
        
        $success = $payment->update([
                                'status'=> 2,
                                'gateway_id'=> 2,
                                'gateway_payment_id'=> '', // Payza payment ID
                                'gateway_payer_id'=> '' // Payza payer ID
                        ]);
        
        if( $success )
        {
            
            $mail = new Mails;
            
            $mail->buyerPaidForProductAcknowledgement();
            
            $mail->buyerPaidNotifyTraveler($payment->traveller_id);
            
            return redirect()->action('Payments@buyer')->withErrors('Transaction is successful. We will notify Traveler about your payment.');
            
        } else {
            
            return redirect()->action('Payments@buyer')->withErrors('Failed to process your transaction. Please retry later.');
            
        }
        
        // Clear the shopping cart, write to database, send notifications, etc.
    
        // Thank the user for the purchase
        return view('checkout.done');
        
    }
    
    /**
     * Receiving the payment request from buyer for the first time
     * 
     * @param $id = Payment ID
     * 
     * @check order details
     * 
     * @return redirect to PAYPAL
     * 
    */
    public function payNowPaypal($id, Payment $payments)
    {
        
        $payment = $payments->where('id', $id)->unpaid()->first();
        
        if( ! $payment )
        {
            
            return back()->withErrors('Your transaction could not be validated. If you think this was an error, please contact admin.');
            
        }
        
        session(['payment'=> $payment]);
        
        $payer = PayPal::Payer();
        $payer->setPaymentMethod('paypal');
    
        $amount = PayPal:: Amount();
        $amount->setCurrency('USD');
        $amount->setTotal( $payment->payment); // This is the simple way,
        // you can alternatively describe everything in the order separately;
        // Reference the PayPal PHP REST SDK for details.
    
        $transaction = PayPal::Transaction();
        $transaction->setAmount($amount);
        
        if( $payment->payment_type == 1 )
        {
        
            $transaction->setDescription('Airposted Payment ID: '.$payment->id.'. Product: '.$payment->name.' Amount: '.$payment->payment.'.USD Buyer ID: '.$payment->buyer_id.' Traveler ID: '.$payment->traveller_id);
            
        } elseif( $payment->payment_type == 3 )
        {
            
            $transaction->setDescription('Airposted_Pitneybowes Payment ID: '.$payment->id.'. Product: '.$payment->name.' Amount: '.$payment->payment.'.USD Buyer ID: '.$payment->buyer_id);
            
        }
        
        $redirectUrls = PayPal:: RedirectUrls();
        $redirectUrls->setReturnUrl(action('Payments@getDone'));
        $redirectUrls->setCancelUrl(action('Payments@getCancel'));
    
        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));
    
        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;
    
        return Redirect::to( $redirectUrl );
    }
    
    /**
     * 
     * If buyer and card is verified and ready to be charged, Paypal redirects here
     * 
     * @process charge the card or paypal and save order details at database
     * 
     * @return redirect to payment page
     * 
    */
    public function getDone(Request $request)
    {
        
        $session_payment = session('payment');
        
        $id = $request->get('paymentId');
        
        $token = $request->get('token');
        
        $payer_id = $request->get('PayerID');
    
        $payment = PayPal::getById($id, $this->_apiContext);
    
        $paymentExecution = PayPal::PaymentExecution();
    
        $paymentExecution->setPayerId($payer_id);
        
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);
        
        $payment_is_successful = Payment::find($session_payment['id'])->update(['status'=> 2, 'gateway_id'=> 1, 'gateway_payment_id'=> $id, 'gateway_payer_id'=> $payer_id]);
        
        if( $payment_is_successful )
        {
            
            return ( new \App\Http\Controllers\PostPaymentSteps )->all();
            
        } else
        {
            
            return redirect()->action('Payments@buyer')->withErrors('Failed to process your transaction. Please retry later.');
            
        }
        
        
        return view('checkout.done');
    }
    
    /**
     * 
     * If buyer cancels the transaction, Paypal redirects here
     * 
     * @return redirect to payment page
     * 
    */
    public function getCancel(Request $request)
    {
        
        return redirect()->action('Payments@buyer')->withErrors('Sorry to see you cancelling the transaction. If you need help, please call or email us.');
        
        return view('checkout.cancel');
    }
    
    
    
    public function earningHistory(Payment $payment)
    {
        
        $payments   = $payment->myBuys()->where('status', 4)->latest()->paginate(20);
        
        return view('user.pages.traveller-earning', compact('payments') );
        
    }
    
    
    
    /**
     * Traveler saied - He/She gave product to buyer
     * 
    */
    public function TravellerGaveProductToBuyer($id)
    {
        
        $payment = \App\Payment::where('id', $id)->where('traveller_id', auth()->user()->id)->first();
        
        if($payment){
        
            if($payment->update(['is_delivered'=> 1]))
            {
                
                $mail = new Mails;
                
                $mail->travelerDeliveredProduct($payment->traveller_id);
                
                $mail->travelerDeliveredProductNotifyBuyer($payment->buyer_id);
                
                $mail->travelerDeliveredProductNotifyAdmin($payment->traveller_id, $payment->buyer_id, $payment);
                
                return back()->withErrors('Payment Marked as Traveler handed over the product to buyer.');
                
            } else{
                
                return back()->withErrors('Failed to process the payment. Please contact admin.');
                
            }
        
        }
        
    }
    
    /**
     * Buyer said, He/She got the product
     * 
    */
    public function buyerReceivedProductFromTraveller($id)
    {
        
        $payment = \App\Payment::where('id', $id)->where('buyer_id', auth()->user()->id)->first();
        
        if($payment){
        
            if( $payment->update(['is_delivered'=> 2]) )
            {
                
                $payment->traveller->increment('balance',$payment->traveller_commission);
                
                $mail = new Mails;
                
                $mail->buyerReceivedProduct($payment->buyer_id);
                
                $mail->buyerReceivedProductNotifyTraveler($payment->traveller_id);
                
                $mail->buyerReceivedProductNotifyAdmin($payment->traveller_id, $payment->buyer_id, $payment);
                
                return back()->withErrors('Payment Marked as Buyer received the product from Traveler.');
                
            } else{
                
                return back()->withErrors('Failed to process the payment. Please contact admin.');
                
            }
        
        }
        
    }
    
    
    
    
    public function stripePaymentPage($paymentID)
    {
        
        $payment = Payment::where('id',$paymentID)->where('buyer_id', auth()->user()->id)->where('status', 1)->first();
        
        return view('user.pages.stripe-payment-page', compact('payment'));
        
    }
    
    
}

