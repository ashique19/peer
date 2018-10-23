<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Mail;

class Mails extends Controller
{
    
    public function signup($id)
    {//return $id;
        
        if($user = User::find($id))
        {//return $user;
            switch($user->role)
            { 
                
                case 1:
                        Mail::send('mails.clientSignup', ['user'=>$user], function ($message) use ($user) {
                            $message->to($user->email, $user->firstname.$user->lastname);
                    	    $message->from( env('MAIL_INFO') , 'Airposted Admin');
                    	    $message->subject('Welcome to Airposted');
                    	    
                    	});
                    	
                    	
                    	if($user->referrer_id)
                    	{
                    	    
                    	    if(User::where('id',$user->referrer_id)->first())
                    	    {
                    	        $referrer = User::where('id',$user->referrer_id)->first();
                    	        
                    	        Mail::send('mails.clientSignupInfoToReferrer', ['user'=>$user, 'referrer'=>$referrer], function ($message) use ($user,$referrer) {
                                    $message->to($referrer->email, $referrer->firstname.$referrer->lastname);
                            	    $message->from( env('MAIL_INFO') , 'Airposted Admin');
                            	    $message->subject('You have a new client at Airposted (Bangladesh)');
                            	    
                            	    
                            	});
                            	
                    	        
                    	    }
                    	    
                    	}
                    	
                        break;
                case 2:
                    break;
                case 3:
                    Mail::send('mails.clientSignup', ['user'=>$user], function ($message) use ($user) {
                        $message->to($user->email, $user->firstname.$user->lastname);
                	    $message->from( env('MAIL_INFO') , 'Airposted Admin');
                	    $message->subject('Welcome to Airposted');
                	    
                	    
                	});
                    
                    Mail::send('mails.clientSignupToAdmin', ['user'=>$user], function ($message) use ($user) {
                        $message->to( env('MAIL_INFO') , 'Admin of Airposted' );
                	    $message->from( env('MAIL_INFO') , 'Airposted Notification System');
                	    $message->subject('New Client has signed up at Airposted');
                	    
                	    
                	});
                    break;
                case 4:
                        Mail::send('mails.clientSignup', ['user'=>$user], function ($message) use ($user) {
                            $message->to($user->email, $user->firstname.$user->lastname);
                    	    $message->from( env('MAIL_INFO') , 'Airposted Admin');
                    	    $message->subject('Welcome to Airposted');
                    	    
                    	    
                    	});
                    	
                    	
                    	if($user->referrer_id)
                    	{
                    	    
                    	    if(User::where('id',$user->referrer_id)->first())
                    	    {
                    	        $referrer = User::where('id',$user->referrer_id)->first();
                    	        
                    	        Mail::send('mails.clientSignupInfoToReferrer', ['user'=>$user, 'referrer'=>$referrer], function ($message) use ($user,$referrer) {
                                    $message->to($referrer->email, $referrer->firstname.$referrer->lastname);
                            	    $message->from( env('MAIL_INFO') , 'Airposted Admin');
                            	    $message->subject('You have a new client at Airposted (Bangladesh)');
                            	    
                            	    
                            	});
                            	
                    	        
                    	    }
                    	    
                    	}
                    	
                    break;
                case 6:
                        
                    	
                    	
                    break;
                case 5:
                    
                    break;
                default:
                    break;
                
            }
            
            
        }
        
    }
    
    
    public function accountActivation($id)
    {
        
        $user = User::where('id',$id)->first();
        
        if($user)
        {
            
            Mail::send('mails.clientAccountActivationConfirmation', ['user'=>$user], function ($message) use ($user) {
                $message->to($user->email, $user->firstname." ".$user->lastname);
        	    $message->from( env('MAIL_INFO') , 'Airposted Admin');
        	    $message->subject('Your account has been activated at Airposted (BD)');
        	    $message->bcc('ashique19@gmail.com', 'A3');
        	    
        	});
            
        }
        
    }
    
    
    public function forgotPassword($id, $new_password)
    {
        
        if($user = User::find($id)){
            
            
            Mail::send('mails.forgotPassword', ['user' => $user, 'new_password'=>$new_password], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Password Recovery')
                  ->from( env('MAIL_INFO') , 'Airposted recovery system')
                  ;
            });
            
        }
        
    }
    
    
    public function buyWishPosted()
    {
        
        $user   = User::find(auth()->user()->id);
        
        if($user){
            
            Mail::send('mails.buy-wish-posted', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Your buy wish has been posted at Airposted')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function travelWishPosted()
    {
        
        $user   = User::find(auth()->user()->id);
        
        if($user){
            
            Mail::send('mails.travel-wish-posted', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Your travel detail has been posted at Airposted')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function buyerPaidForProductAcknowledgement()
    {
        
        $user   = User::find(auth()->user()->id);
        
        if($user){
            
            Mail::send('mails.buyer-paid-for-product-acknowledgement', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Your payment has been successfully recorded at Airposted')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function buyerPaidNotifyTraveler($traveler_id)
    {
        
        $user   = User::find($traveler_id);
        
        if($user){
            
            Mail::send('mails.buyer-paid-for-product-acknowledgement', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted received payment for your offer')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function buyerPaidNotifyAdmin($payment)
    {
        
        
        if(auth()->user()){
            
            Mail::send('mails.buyer-paid-notify-admin', ['payment' => $payment], function ($m) use ($payment) {
                $m->to('codebar2007@gmail.com', "Mithun Molla" )
                  ->subject('Airposted received a new payment')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ->bcc( 'ashique19@gmail.com' , 'Mail Delivery System');
            });
            
        }
        
    }
    
    
    public function buyerReceivedProduct($buyer_id)
    {
        
        $user   = User::find($buyer_id);
        
        if($user){
            
            Mail::send('mails.buyer-received-product', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Congratulations on a successful shipping with Airposted')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function buyerReceivedProductNotifyTraveler($traveler_id)
    {
        
        $user   = User::find($traveler_id);
        
        if($user){
            
            Mail::send('mails.buyer-received-product-notify-traveler', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted buyer received the product')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function buyerReceivedProductNotifyAdmin($traveler_id, $buyer_id, $payment)
    {
        
        $user   = User::find($traveler_id)->toArray();
        
        $buyer  = User::find($buyer_id)->toArray();
        
        $payment= collect($payment);
        
        $payment= (array) $payment->toArray();
        
        if($user){
            
            Mail::send('mails.buyer-received-product-notify-traveler', ['traveler' => $user, 'buyer' => $buyer, 'payment'=> $payment], function ($m) use ($user) {
                $m->to( env('MAIL_ADMIN') , 'Admin of Airposted' )
                  ->subject('Congratulations on a successful transaction with Airposted')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function travelerDeliveredProduct($traveler_id)
    {
        
        $user   = User::find($traveler_id);
        
        if($user){
            
            Mail::send('mails.traveler-delivered-product', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Congratulations on a successful transaction with Airposted')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function travelerDeliveredProductNotifyBuyer($buyer_id)
    {
        
        $user   = User::find($buyer_id);
        
        if($user){
            
            Mail::send('mails.traveler-delivered-product-notify-buyer', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Your Airposted traveler delivered your product')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function travelerDeliveredProductNotifyAdmin($traveler_id, $buyer_id, $payment)
    {
        
        $user   = User::find($traveler_id)->toArray();
        
        $buyer  = User::find($buyer_id)->toArray();
        
        $payment= collect($payment);
        
        $payment= (array) $payment->toArray();
        
        if($user){
            
            Mail::send('mails.traveler-delivered-product-notify-admin', ['traveler' => $user, 'buyer' => $buyer, 'payment'=> $payment], function ($m) use ($user) {
                $m->to( env('MAIL_ADMIN') , 'Admin of Airposted' )
                  ->subject('Traveler sais, Product delivered to Buyer')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function offerMadeByTraveller($receiver_id, $sender_id)
    {
        
        $user   = User::find($receiver_id);
        
        $sender = User::find($sender_id);
        
        if($user){
            
            Mail::send('mails.offer-made-by-traveller', ['user' => $user, 'sender'=> $sender], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('You received a delivery offer')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function offerMadeByBuyer($receiver_id, $sender_id, $offer_id, $buypost_id)
    {
        
        $users = new User;
        
        $offer = \App\Offer::find( $offer_id );
        
        $buypost = \App\Buyer::find( $buypost_id );
        
        /**
         * 
         * Acknowledge Traveler that Buyer sent an offer
         * 
        */
        $user   = $users->find($receiver_id);
        
        $sender = $users->find($sender_id);
        
        if($user){
            
            
            Mail::send('mails.offer-made-by-buyer', ['user' => $user, 'sender'=> $sender, 'offer'=> $offer, 'buypost'=> $buypost], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Your request has been sent to the traveler')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
        
        /**
         * 
         * Acknowledge Buyer that his/her offer has been sent to traveler
         * 
        */
        $re_user    = $sender;
        
        $re_sender  = $user;
        
        if($re_user){
            
            
            Mail::send('mails.offer-made-by-buyer-acknowledged', ['user' => $re_user, 'sender'=> $re_sender], function ($m) use ($re_user) {
                $m->to($re_user->email, $re_user->firstname." ".$re_user->lastname)
                  ->subject('Your offer has been sent to the Traveler')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function offerReplyByBuyer($receiver_id, $sender_id)
    {
        
        $users = new User;
        
        /**
         * 
         * Acknowledge Traveler that Buyer sent an offer
         * 
        */
        $user   = $users->find($receiver_id);
        
        $sender = $users->find($sender_id);
        
        if($user){
            
            
            Mail::send('mails.offer-reply-by-buyer', ['user' => $user, 'sender'=> $sender], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted buyer made you an offer')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }

        
    }
    
    
    public function offerReplyByTraveller($receiver_id, $sender_id)
    {
        
        $users = new User;
        
        /**
         * 
         * Acknowledge Traveler that Buyer sent an offer
         * 
        */
        $user   = $users->find($receiver_id);
        
        $sender = $users->find($sender_id);
        
        if($user){
            
            
            Mail::send('mails.offer-reply-by-traveler', ['user' => $user, 'sender'=> $sender], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted buyer made you an offer')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }

        
    }
    
    
    public function offerRejectedByBuyer($receiver_id, $sender_id)
    {
        
        $users = new User;
        
        /**
         * 
         * Acknowledge Traveler that Buyer sent an offer
         * 
        */
        $user   = $users->find($receiver_id);
        
        $sender = $users->find($sender_id);
        
        if($user){
            
            
            Mail::send('mails.offer-rejected-by-buyer', ['user' => $user, 'sender'=> $sender], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted buyer rejected your offer')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }

        
    }
    
    
    public function offerRejectedByTraveler($receiver_id, $sender_id)
    {
        
        $users = new User;
        
        /**
         * 
         * Acknowledge Traveler that Buyer sent an offer
         * 
        */
        $user   = $users->find($receiver_id);
        
        $sender = $users->find($sender_id);
        
        if($user){
            
            
            Mail::send('mails.offer-rejected-by-traveler', ['user' => $user, 'sender'=> $sender], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted traveler rejected your offer')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }

        
    }
    
    
    public function offerAcceptedByTraveller($receiver_id, $sender_id)
    {
        
        $user   = User::find($sender_id);
        
        $sender = User::find($receiver_id);
        
        if($user){
            
            
            Mail::send('mails.offer-accepted-by-traveller', ['user' => $user, 'sender'=> $sender], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Thank you for accepting the offer')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
        $re_user   = $sender;
        
        $re_sender = $user;
        
        if($re_user){
            
            
            Mail::send('mails.offer-accepted-by-traveller-notify-buyer', ['user' => $re_user, 'sender'=> $re_sender], function ($m) use ($re_user) {
                $m->to($re_user->email, $re_user->firstname." ".$re_user->lastname)
                  ->subject('Airposted Traveler accepted your offer')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function offerAcceptedByBuyer($receiver_id, $sender_id)
    {
        
        $users  = new User;
        
        $user   = $users->find($sender_id);
        
        $sender = $users->find($receiver_id);
        
        if($user){
            
            
            Mail::send('mails.offer-accepted-by-buyer', ['user' => $user, 'sender'=> $sender], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted Offer accepted')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
        $re_user   = $sender;
        
        $re_sender = $user;
        
        if($re_user){
            
            
            Mail::send('mails.offer-accepted-by-buyer-notify-traveler', ['user' => $re_user, 'sender'=> $re_sender], function ($m) use ($re_user) {
                $m->to($re_user->email, $re_user->firstname." ".$re_user->lastname)
                  ->subject('Airposted Buyer accepted your offer')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function messageReply($receiver_id, $sender_id, $message)
    {
        
        $user   = User::find($receiver_id);
        
        $sender = User::find($sender_id);
        
        if($user){
            
            Mail::send('mails.message-reply', ['user' => $user, 'sender'=> $sender, 'details'=>$message], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('New mesage at Airposted')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function messageToBuyerTraveller($receiver_id, $sender_id, $subject, $message)
    {
        
        $user   = User::find($receiver_id);
        
        $sender = User::find($sender_id);
        
        if($user){
            
            
            Mail::send('mails.message-to-traveller-buyer', ['user' => $user, 'sender'=> $sender, 'subject'=> $subject, 'details'=>$message], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('New mesage at Airposted')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function adminVerifiedPaymentNotifyBuyer($buyer_id)
    {
        
        $user = User::find($buyer_id);
        
        if($user){
            
            
            Mail::send('mails.admin-verified-payment-notify-buyer', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted Payment Verified')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function adminVerifiedPaymentNotifyTraveler($traveler_id)
    {
        
        $user = User::find($traveler_id);
        
        if($user){
            
            
            Mail::send('mails.admin-verified-payment-notify-traveler', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted Payment Verified')
                  ->from( env('MAIL_INFO') , 'Airposted notification system')
                  ;
            });
            
        }
        
    }
    
    
    public function contactToAdmin($request)
    {
        
        Mail::send('mails.contact-to-admin', ['request'=>$request], function ($message) use ($request) {
                            $message->to( 'support@airposted.com' , 'Airposted support contact')
                                    ->from( env('MAIL_SUPPORT') , 'Notification System')
                    	            ->subject('New Contact Request has arrived at Airposted')
                    	            ;
                    	    
                    	});
        
    }

    
    public function contactToRequester($request)
    {
        
        Mail::send('mails.contact-to-requester', ['request'=>$request], function ($message) use ($request) {
                            $message->to( $request['email'], 'To whom it may concern')
                                    ->from( env('MAIL_SUPPORT') , 'Airposted Notification System')
                    	            ->subject('Message received by Airposted')
                    	            ;
                    	    
                    	});
        
    }
    
    
    public function labelPurchaseFailedInsufficientBalanceAdmin($error, $user, $payment)
    {
        
        if($user){
            
            Mail::send('mails.label-purchase-failed-insufiicient-balance-admin', ['user' => $user, 'error'=> $error, 'payment'=> $payment], function ($m) use ($user) {
                $m->to( env('MAIL_INFO'), "Airposted Admin")
                  ->subject('Warning! Insufficient balance in Pitneybowes. Buyer charged but label not Purchased.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
   
    public function labelPurchaseFailedInsufficientBalanceUser($error, $user, $payment)
    {
        
        if($user){
            
            Mail::send('mails.label-purchase-failed-insufiicient-balance-user', ['user' => $user, 'error'=> $error, 'payment'=> $payment], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Shipping Label purchased failed. We are taking care of your Payment.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
   
    public function labelPurchaseFailedUnknownIssueAdmin($error, $user, $payment)
    {
        
        if($user){
            
            Mail::send('mails.label-purchase-failed-unknown-issue-admin', ['user' => $user, 'error'=> $error, 'payment'=> $payment], function ($m) use ($user) {
                $m->to( env('MAIL_INFO'), "Airposted Admin")
                  ->subject('Warning! Pitneybowes label purchased failed - Unknown Issue. Buyer was charged.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
   
    public function labelPurchaseFailedUnknownIssueUser($error, $user, $payment)
    {
        
        if($user){
            
            Mail::send('mails.label-purchase-failed-unknown-issue-user', ['user' => $user, 'error'=> $error, 'payment'=> $payment], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Shipping Label purchased Failed. We are taking care of your payment.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
   
    public function labelPurchaseSuccessNotifyBuyer($user, $label)
    {
        
        $label = \App\Label::find($label->id);
        
        if($user){
            
            Mail::send('mails.label-purchase-success-user', ['user' => $user, 'label'=> $label], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted Shipping Label purchased Success.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
   
    public function labelPurchaseSuccessNotifyAdmin($user, $label, $payment)
    {
        
        if($user){
            
            Mail::send('mails.label-purchase-success-admin', ['user' => $user, 'label'=> $label, 'payment'=> $payment], function ($m) use ($user) {
                $m->to( env('MAIL_INFO'), "Airposted Admin")
                  ->subject('Shipping Label has been purchased.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
   
    public function orderPlacedUser($user)
    {
        
        
        
        if($user){
            
            Mail::send('mails.order-placed-success-user', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted - Order has been placed successfully.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
   
    public function orderPlacedAdmin($user, $order)
    {
        
        if($user){
            
            Mail::send('mails.order-place-success-admin', ['user' => $user, 'order'=> $order], function ($m) use ($user) {
                $m->to( env('MAIL_INFO'), "Airposted Admin")
                  ->subject('New purchase order has been placed.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
   
    public function OrderStatusUpdateToUser($order, $user)
    {
        
        
        
        if($user){
            
            Mail::send('mails.order-status-update-user', ['user' => $user, 'order'=> $order], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted - Order status has been updated.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
    
    public function paymentReceivedOrderProductUser($order, $payment, $user)
    {
        
        
        
        if($user){
            
            Mail::send('mails.payment-received-order-product-user', ['user' => $user, 'order'=> $order, 'payment'=> $payment], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted - Your payment has been received successfully.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
   
    public function paymentReceivedOrderProductAdmin($order, $payment, $user)
    {
        
        if($user){
            
            Mail::send('mails.payment-received-order-product-admin', ['user' => $user, 'order'=> $order, 'payment'=> $payment], function ($m) use ($user) {
                $m->to( env('MAIL_INFO'), "Airposted Admin")
                  ->subject('New payment has arrived for Ordered Products.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
   
    
    public function paymentReceivedOrderShippingUser($order, $payment, $user)
    {
        
        
        
        if($user){
            
            Mail::send('mails.payment-received-order-shipping-user', ['user' => $user, 'order'=> $order, 'payment'=> $payment], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Airposted - Your payment has been received successfully.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
   
    public function paymentReceivedOrderShippingAdmin($order, $payment, $user)
    {
        
        if($user){
            
            Mail::send('mails.payment-received-order-shipping-admin', ['user' => $user, 'order'=> $order, 'payment'=> $payment], function ($m) use ($user) {
                $m->to( env('MAIL_INFO'), "Airposted Admin")
                  ->subject('Payment has been received for Order shipping.')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
    
    
    public function notification($notification_id)
    {
        
        $notification = \App\Notification::find( $notification_id );
        
        $user = $notification ? \App\User::find( $notification->notification_to ) : null;
        
        if($notification && $user){
            
            Mail::send('mails.notification', [ 'user' => $user, 'notification'=> $notification ], function ($m) use ($user) {
                $m->to( env('MAIL_INFO'), "Airposted Admin")
                  ->subject('You received a new notification at Airposted')
                  ->from( env('MAIL_INFO') , 'Airposted notification system');
            });
            
        }
        
    }
   
    
}
