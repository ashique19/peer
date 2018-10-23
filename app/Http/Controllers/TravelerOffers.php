<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Offer;
use App\User;
use App\Http\Controllers\Mails;

class TravelerOffers extends Controller
{
    
    private $offers;
    
    
    public function __construct()
    {
        
        $this->offers = auth()->user()->carryOffers()->notReply();
        
    }
    
    
    public function storeCounter(Request $request, $buyer_id, $offer_id)
    {
        
        $offer  = $this->offers->where('offers.buyer_id', $buyer_id)->where('offers.id', $offer_id)->notDeleted()->notAgreed()->first();
        
        if( $offer )
        {
            
            $update = $offer->update([
                'is_offer_from_buyer' => 0,
                'is_offer_from_traveller' => 1,
                'offer_price' => $offer->product_price + $request->input('traveller_commission')
            ]);
            
            if($update)
            {
                
                $mails = new Mails;
                
                $mails->offerReplyByTraveller($offer->buyer_id, $offer->traveller_id);
                
            }
            
            return view('user.partials.traveler-offer', ['offer'=> Offer::find($offer->id)] );
            
        }
        
    }
    
    
    public function accept($buyerId)
    {
        
        $offer = $this->offers
                ->notAgreed()
                ->notDeleted()
                ->where('is_offer_from_buyer', 1)
                ->where('buyer_id', $buyerId)
                ->first();
        
        if($offer)
        {
            
            $update = $offer->update([
                        'is_offer_from_buyer' => 0,
                        'is_offer_from_traveller' => 1,
                        'is_agreed' => 1
                    ]);
                    
            if( $update )
            {
                
                $this->createPayment($offer);
                
                $mails = new Mails;
            
                $mails->offerAcceptedByTraveller($offer->buyer_id, $offer->traveller_id);
            
                
            }
            
            return view('user.partials.traveler-offer', ['offer'=> Offer::find($offer->id)] );
            
        }
                
    }
    
    
    public function reject(Request $request, $buyerId)
    {
        
        $offer = $this->offers
                ->notAgreed()
                ->notDeleted()
                ->where('is_offer_from_buyer', 1)
                ->where('buyer_id', $buyerId)
                ->first();
        
        if($offer)
        {
            
            $update = $offer->update([
                        'is_offer_from_buyer' => 0,
                        'is_offer_from_traveller' => 1,
                        'is_deleted' => 1,
                        'note' => $request->input('note')
                    ]);
                    
            if( $update )
            {
                
                $mail = new Mails;
                    
                $mail->offerRejectedByTraveler($offer->buyer_id, $offer->traveller_id);
                
                
            }
            
            return view('user.partials.traveler-offer', ['offer'=> Offer::find($offer->id)] );
            
        }
                
    }
    
    
    
    private function createPayment($offer)
    {
        
        $payment = \App\Payment::insert([
                'name'                  => $offer->name,
                'offer_id'              => $offer->id,
                'buyer_id'              => $offer->buyer->id,
                'traveller_id'          => $offer->traveller->id,
                'from_country_id'       => $offer->traveller->country ? $offer->traveller->country->id : null,
                'to_country_id'         => $offer->buyer->country ? $offer->buyer->country->id : null,
                'product_price'         => $offer->product_price,
                'traveller_commission'  => $offer->offer_price - $offer->product_price,
                'airposted_commission'  => $offer->offer_price * settings()->commission / 100,
                'transaction_charge'    => $offer->offer_price * settings()->transaction_charge / 100 + env('FIXED_TRANSACTION_CHARGE'),
                'payment'               => $offer->offer_price + $offer->offer_price * settings()->commission / 100 + $offer->offer_price * settings()->transaction_charge / 100 + env('FIXED_TRANSACTION_CHARGE'),
            ]);
        
    }
    
}
