<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mails;
use App\Http\Controllers\Shippings;
use App\Payment;

class PostPaymentSteps extends Controller
{
    
    public function all()
    {
        
        $payment = Payment::find( session('payment')->id );
        
        $mail = new Mails;
        
        if( $payment )
        {
            
            switch( $payment->payment_type )
            {
                
                case 1: //  Shipping by Traveler, ordered by buyer
                        return $this->postPaymentOfTraveler( $payment, $mail );
                        break;
                        
                case 2: // Shipping by Airposted, ordered by buyer
                        return $this->postPaymentOfAirposted( $payment, $mail );
                        break;
                        
                case 3: // Shipping label sale by Airposted
                        return $this->postPaymentOfLabelSale( $payment, $mail );
                        break;
                
            }
            
        }
        
        return back()->withErrors('Failed to find Payment. Please retry later');
        
    }
    
    
    private function postPaymentOfTraveler( $payment, $mail )
    {
        
        $mail->buyerPaidForProductAcknowledgement();
            
        $mail->buyerPaidNotifyTraveler($payment->traveller_id);
        
        $mail->buyerPaidNotifyAdmin($payment);
        
        return redirect()->action('Payments@buyer')->withErrors('Transaction is successful. We will notify Traveler about your payment.');
        
        
    }
    
    
    private function postPaymentOfAirposted( $payment, $mail )
    {
        
        $label  = $payment->label;
        
        $order  = $payment->order;
        
        $log    = new \App\Order_log;
        
        if( $order->status == 3 )
        {
            
            $order->update([
                'status' => 4,
                'paid_amount' => $order->paid_amount + $payment->payment,
                'paid_for_product' => 1
            ]);
            
            $log->create([
                'name' => 'Payment Received',
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'log_detail' => 'Received payment for Product. Total received payment for this Order = USD '.$payment->payment
            ]);
            
            $mail->paymentReceivedOrderProductUser($order, $payment, auth()->user());
            $mail->paymentReceivedOrderProductAdmin($order, $payment, auth()->user());
            
        } elseif( $order->status == 6 )
        {
            
            $order->update([
                'status' => 7,
                'paid_amount' => $order->paid_amount + $payment->payment,
                'paid_for_shipping' => 1
            ]);
            
            $label->update([
                'is_paid' => 1
            ]);
            
            $log->create([
                'name' => 'Payment Received',
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'log_detail' => 'Received payment for Product and Shipping. Total received payment for this Order = USD '.$payment->payment
            ]);
            
            $mail->paymentReceivedOrderShippingUser($order, $payment, auth()->user());
            $mail->paymentReceivedOrderShippingAdmin($order, $payment, auth()->user());
            
        } elseif( $order->status == 9 )
        {
            
            $order->update([
                'status' => 7,
                'paid_amount' => $order->paid_amount + $payment->payment,
                'paid_for_product' => 1,
                'paid_for_shipping' => 1
            ]);
            
            $label->update([
                'is_paid' => 1
            ]);
            
            $log->create([
                'name' => 'Payment Received',
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'log_detail' => 'Received payment for Product and Shipping. Total received payment for this Order = USD '.$payment->payment
            ]);
            
            $mail->paymentReceivedOrderShippingUser($order, $payment, auth()->user());
            $mail->paymentReceivedOrderShippingAdmin($order, $payment, auth()->user());
            
        }
        
        
        return redirect()->action('BuyOrders@orderSummary', $order->id)->withErrors('Payment was successful. Please check log and mail for further detail.');
        
    }
    
    
    private function postPaymentOfLabelSale( $payment, $mail)
    {
        
        $shipping = new Shippings;
        
        $purchasedLabel = $shipping->buyLabel();
        
        $updateDraftLabel = ( new Shippings )->updateDraftLabel( $purchasedLabel, $payment );
        
        if( $updateDraftLabel )
        {
            
            $mail->labelPurchaseSuccessNotifyBuyer( $payment->buyer, $payment->label );
        
            $mail->labelPurchaseSuccessNotifyAdmin( $payment->buyer, $payment->label, $payment );
            
            return redirect()->action('Labels@showLabelToUser')->withErrors('Label has been Purchased. You can save or print it now.');
            
        } else{
            
            return redirect()->action('Labels@showLabelToUser')->withErrors('Sorry! Airposted could not record the label for you. Detail has been mailed to you and Airposted team for further steps.');
            
        }
        
        
        
    }
    
}
