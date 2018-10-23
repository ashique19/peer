<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Stripe;
use App\Payment;
use App\Http\Controllers\Mails;

class Stripes extends Controller
{
    
    private $stripe;
    
    public function __construct()
    {
        
        $this->stripe = Stripe::make( env('STRIPE_API_KEY') );
        
    }
    
    public function index(Request $request, $paymentID)
    {
        
        // return $request->all();
        
        $token      = $request->input('stripeToken');
        $tokenType  = $request->input('stripeTokenType');
        $email      = $request->input('stripeEmail');
        $customer   = false;
        $payment    = Payment::find($paymentID);
        
        /**
         * Get or create Stripe Customer data
        */
        if( $email == auth()->user()->email )
        {
            
            $stripe_id  = auth()->user()->stripe_id;
            
            if( strlen( $stripe_id ) > 0 )
            {
                
                $customer   = $this->stripe->customers()->find( $stripe_id );
                
            } else{
                
                $customer = $this->stripe->customers()->create(array(
                    'email'     => $email,
                    'source'    => $token
                ));
                
                auth()->user()->stripe_id = $customer->id;
                
            }
            
            
        } else{
            
            $customer = $this->stripe->customers()->create(array(
                'email'     => $email,
                'source'    => $token
            ));
            
        }
        
        if( ! $customer || ! $payment ) return redirect()->action('Payments@buyer')->withErrors('Failed to process your transaction. Pleaes retry later.');
        
        /**
         * END : Get or create Stripe Customer data
        */
        
        $charge = $this->stripe->charges()->create([
            'customer' => $customer['id'],
            'currency' => 'USD',
            'amount'   => $payment->payment,
        ]);
        
        if( $charge['status'] == 'succeeded' )
        {
            
            if( $payment->update(['status'=> 2, 'gateway_id'=> 3, 'gateway_payment_id'=> $charge['id'] ]) )
            {
                
                session(['payment' => $payment]);
                
                return ( new \App\Http\Controllers\PostPaymentSteps )->all();
                
                // $mail = new Mails;
                
                // $mail->buyerPaidForProductAcknowledgement();
                
                // $mail->buyerPaidNotifyTraveler($payment->traveller_id);
                
                // $mail->buyerPaidNotifyAdmin($payment);
                
                // return redirect()->action('Payments@buyer')->withErrors('Transaction is successful. We will notify Traveler about your payment.');
                
            } else {
                
                return redirect()->action('Payments@buyer')->withErrors('Failed to process your transaction. Please retry later.');
                
            }
            
            // Clear the shopping cart, write to database, send notifications, etc.
        
            // Thank the user for the purchase
            return view('checkout.done');
            
        } else{
            
            return redirect()->action('Payments@buyer')->withErrors('Failed to process your transaction. Please retry later.');
            
        }
        
        return $charge;
        
    }
    
}
