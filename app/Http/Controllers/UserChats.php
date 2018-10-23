<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Chat;
use App\Offer;

class UserChats extends Controller
{
    
    use \App\Http\Traits\Images;
    
    
    private function getContacts()
    {
        
        $ISentMessagesTo = auth()->user()->sentChats()->latest()->select('message_to', 'chats.created_at')->get()->toArray();
        
        $IReceivedMessagesFrom = auth()->user()->receivedChats()->latest()->select('message_from', 'chats.created_at')->get()->toArray();
        
        if( session('user_type') == 'buyer' ){
        
            $IMadeOffersTo = auth()->user()->buyOffers()->latest()->select('traveller_id', 'offers.created_at')->get()->toArray();
        
        } else{

            $IMadeOffersTo = auth()->user()->carryOffers()->latest()->select('buyer_id', 'offers.created_at')->get()->toArray();

        }
        
        
        $contactList = array_merge($ISentMessagesTo, $IReceivedMessagesFrom, $IMadeOffersTo);
        
        $contactList = array_reverse( array_sort($contactList,function($v){ return $v['created_at']; }) );
        
        $c = [];
        
        array_map(function($v) use (&$c) {
            
            if(array_search( reset($v), $c) === false) $c[] = reset($v);
            
        }, $contactList);
        
        $contacts = User::whereIn('id', $c)->take(100)->select('id', 'user_photo', 'firstname')->get();

        $users = [];
        
        array_map(function($v) use (&$users, $contacts){
            
            $userdata = (array) json_decode( json_encode($contacts->where('id', $v)->first()), true);
            
            if( count($userdata) > 0 ){
                
                $users[] =  array_merge( 
                            $userdata, 
                            [
                                'chat'=> auth()->user()->receivedChats()->unread()->where('message_from', $v)->count(), 
                                'offer'=> ( session('user_type') == 'buyer' ) ? auth()->user()->buyOffers()->notReply()->notAgreed()->where('traveller_id', $v)->count() :  auth()->user()->carryOffers()->notReply()->notAgreed()->where('buyer_id', $v)->count()
                            ]
                        );
            }
            
        }, $c);

        return $users;
        
    }
    
    
    public function indexAndOffers()
    {
        
        $contacts = $this->getContacts();
        
        return view('user.pages.buyer-offer-inbox', compact('contacts') );
        
    }
    
    
    public function getChatUpdates($traveler, $time)
    {
        
        $messages = Chat::whereIn('message_from', [ auth()->user()->id,  $traveler])
                        ->whereIn('message_to', [ auth()->user()->id,  $traveler ])
                        ->where('created_at', '>', $time)
                        ->latest()
                        ->take(100)
                        ->get()
                        ->reverse();
        
        return view('user.partials.inbox-update', compact('messages'));
        
    }
    
    
    public function getOfferUpdates($travelerOrBuyer, $time)
    {
        
        if( session('user_type') == 'buyer' )
        {
            
            if( Offer::where('updated_at', '>', $time)->count() > 0 )
            {
                
                $offers = Offer::where('buyer_id', auth()->user()->id )
                            ->where('traveller_id', $travelerOrBuyer )
                            ->notReply()
                            ->orderBy('updated_at')
                            ->take(30)
                            ->get()
                            ->reverse();
                
                $contact= User::find($travelerOrBuyer);
                
                return view('user.partials.buyer-offers', compact('offers', 'contact'));
                
                    
            }
            
        } else{
            
            if( Offer::where('updated_at', '>', $time)->count() > 0 )
            {
            
                $offers = Offer::where('traveller_id', auth()->user()->id )
                            ->where('buyer_id', $travelerOrBuyer )
                            ->notReply()
                            ->orderBy('updated_at')
                            ->take(30)
                            ->get()
                            ->reverse();
                
                $contact= User::find($travelerOrBuyer);
    
                return view('user.partials.traveler-offers', compact('offers', 'contact'));
                
            }
            
        }
        
        
    }
    
    
    public function getContactUpdates()
    {
        
        $contacts = $this->getContacts();
        
        return view('user.partials.chat-offer-contact', compact('contacts'));
        
    }
    
    
    public function store(Request $request, $id)
    {
        
        $chatImage = $this->storeImage($request, 'chat_image', 'chat');
        
        $saved = Chat::create([
            'name'          => $request->input('name'),
            'message_from'  => auth()->user()->id,
            'message_to'    => $id,
            'chat_image'    => $chatImage,
        ]);
        
        return 1;
        
    }
    
    
    public function markRead($id)
    {
        
        
        if( auth()->user()->receivedChats()->where('is_read_by_to', 0)->update([ 'is_read_by_to'=> 1 ]) )
        {
            
            return 1;
            
        }
        
    }
    
    
}
