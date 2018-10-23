<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Offer;
use App\User;
use App\Http\Controllers\Mails;

class BuyerOffers extends Controller
{
    
    private $offers;
    
    
    public function __construct()
    {
        
        $this->offers = auth()->user()->buyOffers()->notReply();
        
    }
    
    
    public function storeCounter(Request $request, $traveler_id, $offer_id )
    {
        
        $offer  = $this->offers->where('offers.traveller_id', $traveler_id)->where('offers.id', $offer_id)->notDeleted()->notAgreed()->first();
        
        if( $offer )
        {
            
            $update = $offer->update([
                'is_offer_from_buyer' => 1,
                'is_offer_from_traveller' => 0,
                'offer_price' => $offer->product_price + $request->input('traveller_commission')
            ]);
            
            if($update)
            {
                
                $mails = new Mails;
                
                $mails->offerReplyByBuyer($offer->traveller_id , $offer->buyer_id);
                
            }
            
            return view('user.partials.buyer-offer', ['offer'=> Offer::find($offer->id)] );
            
        }
        
    }
    
    
    public function accept($travelerId)
    {
        
        $offer = $this->offers
                ->notAgreed()
                ->notDeleted()
                ->where('is_offer_from_traveller', 1)
                ->where('traveller_id', $travelerId)
                ->first();
        
        if($offer)
        {
            
            $update = $offer->update([
                        'is_offer_from_buyer' => 1,
                        'is_offer_from_traveller' => 0,
                        'is_agreed' => 1
                    ]);
                    
            if( $update )
            {
                
                $this->createPayment($offer);
                
                $mails = new Mails;
                
                $mails->offerAcceptedByBuyer($offer->traveller_id, $offer->buyer_id);
                
                
            }
            
            return view('user.partials.buyer-offer', ['offer'=> Offer::find($offer->id)] );
            
        }
                
    }
    
    
    public function reject(Request $request, $travelerId)
    {
        
        $offer = $this->offers
                ->notAgreed()
                ->notDeleted()
                ->where('is_offer_from_traveller', 1)
                ->where('traveller_id', $travelerId)
                ->first();
        
        if($offer)
        {
            
            $update = $offer->update([
                        'is_offer_from_buyer' => 1,
                        'is_offer_from_traveller' => 0,
                        'is_deleted' => 1,
                        'note' => $request->input('note')
                    ]);
                    
            if( $update )
            {
                
                $mail = new Mails;
                    
                $mail->offerRejectedByBuyer($offer->traveller_id, $offer->buyer_id);
                
                
            }
            
            return view('user.partials.buyer-offer', ['offer'=> Offer::find($offer->id)] );
            
        }
                
    }
    
    
    public function createPayment($offer)
    {
        
        $payment_data = [
            'name'                  => $offer->name,
            'offer_id'              => $offer->id,
            'buyer_id'              => $offer->buyer->id,
            'traveller_id'          => $offer->traveller->id,
            'from_country_id'       => $offer->traveller->country ? $offer->traveller->country->id : null,
            'to_country_id'         => $offer->buyer->country ? $offer->buyer->country->id : null,
            'product_price'         => $offer->product_price,
            'traveller_commission'  => ($offer->offer_price - $offer->product_price),
            'airposted_commission'  => ($offer->offer_price * settings()->commission / 100),
            'transaction_charge'    => ($offer->offer_price * settings()->transaction_charge / 100) + env('FIXED_TRANSACTION_CHARGE'),
            'payment'               => ($offer->offer_price + $offer->offer_price * settings()->commission / 100 + $offer->offer_price * settings()->transaction_charge / 100) + env('FIXED_TRANSACTION_CHARGE')
        ];
        
        $saved_payment = \App\Payment::insert($payment_data);
        
        
    }
    
}
