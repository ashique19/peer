<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\offersStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mails;
use App\Offer;

class Offers extends Controller
{
    
    private $app;
    
    public function __construct()
    {
        
        $this->app = \App\Setting::first();
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.offers.index', ['offers'=> Offer::notReply()->latest()->paginate(20)]);
        
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
        
        $result =   new Offer;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('link'))   ? $result = $result->where('link', 'like', '%'.$request->input('link').'%') : false;
					($request->input('image_url'))   ? $result = $result->where('image_url', 'like', '%'.$request->input('image_url').'%') : false;
					($request->input('product_price'))   ? $result = $result->where('product_price', 'like', '%'.$request->input('product_price').'%') : false;
					($request->input('offer_price'))   ? $result = $result->where('offer_price', 'like', '%'.$request->input('offer_price').'%') : false;
					($request->input('is_reply'))   ? $result = $result->where('is_reply', 'like', '%'.$request->input('is_reply').'%') : false;
					($request->input('reply_of'))   ? $result = $result->where('reply_of', 'like', '%'.$request->input('reply_of').'%') : false;
					($request->input('is_agreed'))   ? $result = $result->where('is_agreed', 'like', '%'.$request->input('is_agreed').'%') : false;
					($request->input('is_offer_from_buyer'))   ? $result = $result->where('is_offer_from_buyer', 'like', '%'.$request->input('is_offer_from_buyer').'%') : false;
					($request->input('is_offer_from_traveller'))   ? $result = $result->where('is_offer_from_traveller', 'like', '%'.$request->input('is_offer_from_traveller').'%') : false;
					($request->input('traveller_id'))   ? $result = $result->where('traveller_id', $request->input('traveller_id')) : false;
					($request->input('buyer_id'))   ? $result = $result->where('buyer_id', $request->input('buyer_id')) : false;
					($request->input('note'))   ? $result = $result->where('note', 'like', '%'.$request->input('note').'%') : false;
        
        return view('admin.offers.index', ['offers'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.offers.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(offersStoreRequest $request)
    {
        
        
        
        $save_success = Offer::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Offers@index')->withErrors('Data has been stored successfully.');
        
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
    
        $offer = Offer::find($id);
        
        $replies = $offer ? $offer->replies : [] ;
        
        return view('admin.offers.show', compact( 'offer' , 'replies' ) );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $offer = Offer::find($id); 
        
        return view('admin.offers.edit', compact('offer') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(offersStoreRequest $request, $id)
    {
        $offer = Offer::find($id);
        
        
        $save_success = Offer::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Offers@index')->withErrors('Data has been updated successfully.');
        
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
        
        $offer = Offer::find($id);
        
        if($offer)
        {
    
    
            if($offer->delete())
            {
            
                return redirect()->action('Offers@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    /**
     * 
     * Buyer is offering the Traveller
     * 
     * @page - Search for Traveller
     * 
    */
    public function postOfferFromBuyer(Request $request)
    {
        
        $data       = $request->all();
        $traveller  = $data['traveller'];
        
        unset($data['traveller']);
        unset($data['_token']);
        
        $offer = [];
        
        for($i = 0; $i < count($data['name']); $i++)
        {
            
            $offer[$i] = [
                'name'                      => $data['name'][$i],
                'link'                      => $data['link'][$i],
                'image_url'                 => $data['image_url'][$i],
                'product_price'             => $data['product_price'][$i],
                'offer_price'               => ($data['offer_price'][$i] >= $data['product_price'][$i] + env('MIN_TRAVELER_COMMISSION')) ? $data['offer_price'][$i] : $data['product_price'][$i] + env('MIN_TRAVELER_COMMISSION'),
                'traveller_id'              => (int) $traveller,
                'buyer_id'                  => auth()->user()->id,
                'buypost_id'                => $data['buypost_id'][$i],
                'is_offer_from_buyer'       => 1,
                'is_offer_from_traveller'   => 0,
                'is_reply'                  => 0,
                'is_agreed'                 => 0,
                'is_deleted'                => 0,
            ];
            
        }
        
        $filtered_offer = [];
        
        array_walk($offer, function($v, $k) use (&$filtered_offer) { (strlen(trim($v['name'])) != 0) ? $filtered_offer[] = $v : false; });
        
        if(count($filtered_offer) < 1)
        {
            
            return 'Please select some product first.';
            
        }
        
        $total_offer = 0;
        
        foreach($filtered_offer as $k=>$v){ 
            
            $saved_offer = Offer::create( (array) $v);

            $reply             = $saved_offer->toArray();
            $reply['is_reply'] = 1;
            $reply['reply_of'] = $saved_offer['id'];
            
            unset($reply['id']);
            
            $saved = Offer::create($reply);
            
            /**
             * 
             * Mail - Send to Traveler, acknowledging the request
             * 
            */
            $mails = new Mails;
            
            $mails->offerMadeByBuyer( $saved->traveller_id , $saved->buyer_id, $saved_offer->id, $v['buypost_id'] );
            
            $total_offer++;
            
        }
        
        if($total_offer > 0)
        {
            
            return 'Request has been sent successfully. Negotiate or view your <a href="'.action('UserChats@indexAndOffers').'">offers</a>';
            
        } else {
            
            return 'Sorry! Failed to process request. Please check your data and retry.';
            
        }
        
    }
    
    /**
     * 
     * @page Buyer searching for products (Product search page)
     * 
    */
    public function postOfferFromProductSearch(Request $request, Mails $mail)
    {
        
        $data       = $request->all();
        
        if(!array_key_exists('traveller', $data))
        {
            
            return 'Please select atleast one traveller from the list.';
            
        }
        
        $settings   = \App\Setting::first();
        
        $traveller  = $data['traveller'];
        
        unset($data['traveller']);
        unset($data['_token']);
        
        $offer = [];
        
        for($i = 0; $i < count($traveller); $i++)
        {
            
            $offer[$i] = [
                'name'                      => $data['name'],
                'product_price'             => $data['price'],
                'image_url'                 => $data['image_url'],
                'link'                      => $data['link'],
                'offer_price'               => $data['price'],
                'transaction_charge'        => $data['price'] * $settings->transaction_charge / 100,
                'airposted_commission'      => $data['price'] * $settings->commission / 100,
                'total_price'               => $data['price'] + $data['price'] * $settings->transaction_charge / 100 + $data['price'] * $settings->commission / 100 ,
                'traveller_id'              => (int) $traveller[$i],
                'buyer_id'                  => auth()->user()->id,
                'is_offer_from_buyer'       => 1,
                'is_offer_from_traveller'   => 0,
                'is_reply'                  => 0,
                'is_agreed'                 => 0,
                'is_reply'                  => 0,
                'is_reply'                  => 0,
            ];
            
        }
        
        $filtered_offer = [];
        
        array_walk($offer, function($v, $k) use (&$filtered_offer) { (strlen($v['name']) != 0) ? $filtered_offer[] = $v : false; });
        
        if(count($filtered_offer) < 1)
        {
            
            return 'Please select some product first.';
            
        }
        
        array_walk($filtered_offer, function($v, $k) use ($mail){
            
            $saved_offer = Offer::create( (array) $v );
            
            $reply = $saved_offer->toArray();
            
            $reply['is_reply'] = 1;
            $reply['reply_of'] = $saved_offer->id;
            
            unset($reply['id']);
            
            $saved = Offer::create($reply);
            
            $mail = $mail ?: new Mails;
            $mail->offerMadeByBuyer($saved->traveller_id , $saved->buyer_id);
            
        });
        
        if(count($filtered_offer) > 0)
        {
            
            return 'Request has been sent successfully. Negotiate or view your <a href="'.action('UserChats@indexAndOffers').'">offers</a>';
            
        } else {
            
            return 'Sorry! Failed to process request. Please check your data and retry.';
            
        }
        
    }
    
    /**
     * 
     * @page Buyer searching for products (Product search page)
     * 
    */
    public function postOfferFromBuyerSearch(Request $request)
    {
        
        $settings = $this->app;
        
        $data                           = $request->all();
        $data['is_reply']               = 0;
        $data['is_agreed']              = 0;
        $data['is_offer_from_buyer']    = 0;
        $data['is_offer_from_traveller']= 1;
        $data['traveller_id']           = auth()->user()->id;
        $data['offer_price']            = $data['product_price'] + $data['traveller_commission'];
        
        $save_offer = \App\Offer::create($data);
        
        if($save_offer)
        {
            
            $reply = $save_offer->toArray();
            
            $reply['is_reply'] = 1;
            $reply['reply_of'] = $save_offer->id;
            
            unset($reply['id']);
            
            $saved = Offer::create($reply);
            
            $mail = new Mails;
            
            $mail->offerMadeByTraveller($saved->buyer_id, $saved->traveller_id);

            return 'Request has been sent successfully. View your <a href="'.action('UserChats@indexAndOffers').'">offers</a>';
            
        } else {
            
            return 'Sorry! Failed to process request. Please check your data and retry.';
            
        }
        
    }
    
    /**
     * 
     * @request GET
     * 
     * Traveller is checking the pending requests from Buyer
     * 
     * @return \Illuminate\Http\Response
     * 
    */
    public function offerFromBuyer(\App\Offer $offer)
    {
        
        $offers = $offer->where('traveller_id', auth()->user()->id)->notReply()->notAgreed()->notDeleted()->latest()->paginate(20);
        
        $mark   = 'pending';
        
        $app    = $this->app;
                
        return view('user.pages.offer-from-buyer', compact('offers', 'app', 'mark') );
        
    }
    
    
    /**
     * 
     * @request GET
     * 
     * Traveller is checking the Deleted requests from Buyer
     * 
     * @return \Illuminate\Http\Response
     * 
    */
    public function offerFromBuyerRejected(\App\Offer $offer)
    {
        
        $offers = $offer->where('traveller_id', auth()->user()->id)->notReply()->notAgreed()->deleted()->latest()->paginate(20);
        
        $mark   = 'rejected';
        
        $app    = $this->app;
                
        return view('user.pages.offer-from-buyer-rejected', compact('offers', 'app', 'mark') );
        
    }
    
    
    /**
     * 
     * @request GET
     * 
     * Traveller is checking the Accepted requests from Buyer
     * 
     * @return \Illuminate\Http\Response
     * 
    */
    public function offerFromBuyerAccepted(\App\Offer $offer)
    {
        
        $offers = $offer->where('traveller_id', auth()->user()->id)->notReply()->agreed()->notDeleted()->latest()->paginate(20);
        
        $mark   = 'accepted';
        
        $app    = $this->app;
                
        return view('user.pages.offer-from-buyer-accepted', compact('offers', 'app', 'mark') );
        
    }
    
    
    public function offerUpdateByTraveller(Request $request, Offer $offers)
    {
        
        if($request->input('product_price')*1 == 0 || $request->input('traveller_commission')*1 == 0) return 'Please enter Product price & Traveller commission.';
        
        $offer = $offers->find($request->input('id'))->toArray();
        
        if($offer)
        {
            
            $offer_price = $request->input('product_price') * 1 + $request->input('traveller_commission') * 1;
            
            $setting = \App\Setting::first();
            
            unset( $offer['id'], $offer['created_at'], $offer['updated_at'] );
            
            $offer['product_price']             = $request->input('product_price') * 1;
            $offer['is_reply']                  = 1;
            $offer['reply_of']                  = $request->input('id');
            $offer['offer_price']               = $offer_price;
            $offer['transaction_charge']        = $offer_price * $setting->transaction_charge/100;
            $offer['airposted_commission']      = $offer_price * $setting->commission/100;
            $offer['total_price']               = $offer_price + $offer_price * $setting->transaction_charge/100 + $offer_price * $setting->commission/100;
            $offer['is_offer_from_buyer']       = 0;
            $offer['is_offer_from_traveller']   = 1;
            $offer['note']                      = $request->input('note');
            
            $saved = $offers->create($offer);
            
            if($saved)
            {
                
                \App\Offer::find($request->input('id'))->update(['product_price'=> $request->input('product_price') * 1, 'offer_price'=> $offer_price]);
                
                $mails = new Mails;
                
                $mails->offerReplyByTraveller($saved->buyer_id, $saved->traveller_id);
                
                return 1;
            } else{
                
                return 'Failed to send invitation. Please check your data.';
                
            }
        } else{
            
            return 'Failed to send invitation. Please check your data.';
            
        }
        
    }
    
    
    public function offerAcceptedByTraveller($id, Offer $offers)
    {
        
        $offer = $offers->where('id',$id)->toMeFromBuyer()->notAgreed()->first();
        
        if( ! $offer->buyer->country ) return back()->withErrors('Please request the buyer to complete own profile so that you can accept the offer.');
        
        if( ! $offer->traveller->country ) return back()->withErrors('Please complete your profile to accept an offer.');
        
        if($offer->update(['is_agreed'=> 1]))
        {
            
            ($offer->replyParent) ? $offer->replyParent->update(['is_agreed'=>1]) : false;
            
            $settings = \App\Setting::first();
            
            $payment = \App\Payment::insert([
                'name'                  => $offer->name,
                'offer_id'              => $offer->id,
                'buyer_id'              => $offer->buyer->id,
                'traveller_id'          => $offer->traveller->id,
                'from_country_id'       => $offer->traveller->country->id,
                'to_country_id'         => $offer->buyer->country->id,
                'product_price'         => $offer->product_price,
                'traveller_commission'  => $offer->offer_price - $offer->product_price,
                'airposted_commission'  => $offer->offer_price * $settings->commission / 100,
                'transaction_charge'    => $offer->offer_price * $settings->transaction_charge / 100 + env('FIXED_TRANSACTION_CHARGE'),
                'payment'               => $offer->offer_price + $offer->offer_price * $settings->commission / 100 + $offer->offer_price * $settings->transaction_charge / 100 + env('FIXED_TRANSACTION_CHARGE'),
            ]);
            
            $mails = new Mails;
            
            $mails->offerAcceptedByTraveller($offer->buyer_id, $offer->traveller_id);
            
            return back()->withErrors('Thank you for accpecting the offer. We will notify you as your buyer makes the payment.');
            
        } else {
            
            return back()->withErrors('Failed to process your request. Please contact admin for assistance.');
            
        }
        
    }
    
    /**
     * 
     * @request GET
     * 
     * Buyer is checking the Pending requests from/to Traveller
     * 
     * @return \Illuminate\Http\Response
     * 
    */
    public function offerFromTraveller(\App\Offer $offer)
    {
        
        $offers = $offer->where('buyer_id', auth()->user()->id)->notReply()->notAgreed()->notDeleted()->latest()->paginate(20);
        
        $app    = $this->app;
        
        $mark   = 'pending';
        
        return view('user.pages.offer-to-traveller', compact('offers', 'app', 'mark') );
        
    }
    
    /**
     * 
     * @request GET
     * 
     * Buyer is checking the Accepted requests from/to Traveller
     * 
     * @return \Illuminate\Http\Response
     * 
    */
    public function offerFromTravellerAccepted(\App\Offer $offer)
    {
        
        $offers = $offer->where('buyer_id', auth()->user()->id)->agreed()->notReply()->notDeleted()->latest()->paginate(20);
        
        $app    = $this->app;
        
        $mark   = 'accepted';
        
        return view('user.pages.offer-to-traveller-accepted', compact('offers', 'app', 'mark') );
        
    }
    
    /**
     * 
     * @request GET
     * 
     * Buyer is checking the Rejected requests from/to Traveller
     * 
     * @return \Illuminate\Http\Response
     * 
    */
    public function offerFromTravellerRejected(\App\Offer $offer)
    {
        
        $offers = $offer->notReply()->notAgreed()->deleted()->where('buyer_id', auth()->user()->id)->latest()->paginate(20);
        
        $app    = $this->app;
        
        $mark   = 'rejected';
        
        return view('user.pages.offer-to-traveller-rejected', compact('offers', 'app', 'mark') );
        
    }
    
    
    public function offerUpdateByBuyer(Request $request, Offer $offers)
    {
        
        if($request->input('product_price')*1 == 0 || $request->input('traveller_commission')*1 == 0) return 'Please enter Product price & Traveller commission.';
        
        $offer = $offers->find($request->input('id'));
        
        $offer = $offer ? $offer->toArray() : [];
        
        if($offer)
        {
        
            $offer_price = $request->input('product_price') * 1 + $request->input('traveller_commission') * 1;
            
            $setting = \App\Setting::first();
            
            unset( $offer['id'], $offer['created_at'], $offer['updated_at'] );
            
            $offer['product_price']             = $request->input('product_price') * 1;
            $offer['is_reply']                  = 1;
            $offer['reply_of']                  = $request->input('id');
            $offer['offer_price']               = $offer_price;
            $offer['transaction_charge']        = $offer_price * $setting->transaction_charge/100;
            $offer['airposted_commission']      = $offer_price * $setting->commission/100;
            $offer['total_price']               = $offer_price + $offer_price * $setting->transaction_charge/100 + $offer_price * $setting->commission/100;
            $offer['is_offer_from_buyer']       = 1;
            $offer['is_offer_from_traveller']   = 0;
            $offer['note']                      = $request->input('note');
            
            $saved = $offers->create($offer);
            
            if($saved)
            {
                
                \App\Offer::find($request->input('id'))->update(['product_price'=> $request->input('product_price') * 1, 'offer_price'=> $offer_price]);
                
                $mails = new Mails;
                
                $mails->offerReplyByBuyer($saved->traveller_id , $saved->buyer_id);
                
                return 1;
                
            } else{
                
                return 'Failed to send invitation. Please check your data.';
                
            }
            
        } else{
            return 'Failed to send invitation. Please check your data.';
        }
        
    }
    
    
    public function offerAcceptedByBuyer($id, Offer $offers)
    {
        
        $offer = $offers->where('id',$id)->toMeFromTraveller()->notAgreed()->first();
        
        if($offer){
            
            $settings = \App\Setting::first();
            
            // if(!$offer->buyer->country || !$offer->buyer->paypal_email) return back()->withErrors('Please complete your profile and payout details to accept an offer.');
            
            if( ! $offer->buyer->country ) return back()->withErrors('Please complete your profile before you accept an offer.');
            
            if( ! $offer->traveller->country ) return back()->withErrors('Please request your traveller to complete own profile to accept an offer.');
            
            if($offer->update(['is_agreed'=> 1]))
            {
                
                $offer->replyParent()->update(['is_agreed'=> 1]);
                
                $payment_data = [
                    'name'                  => $offer->name,
                    'offer_id'              => $offer->id,
                    'buyer_id'              => $offer->buyer->id,
                    'traveller_id'          => $offer->traveller->id,
                    'from_country_id'       => $offer->traveller->country->id,
                    'to_country_id'         => $offer->buyer->country->id,
                    'product_price'         => $offer->product_price,
                    'traveller_commission'  => ($offer->offer_price - $offer->product_price),
                    'airposted_commission'  => ($offer->offer_price * $settings->commission / 100),
                    'transaction_charge'    => ($offer->offer_price * $settings->transaction_charge / 100) + env('FIXED_TRANSACTION_CHARGE'),
                    'payment'               => ($offer->offer_price + $offer->offer_price * $settings->commission / 100 + $offer->offer_price * $settings->transaction_charge / 100) + env('FIXED_TRANSACTION_CHARGE')
                ];
                
                $saved_payment = \App\Payment::insert($payment_data);
                
                $mails = new Mails;
                
                $mails->offerAcceptedByBuyer($offer->traveller_id, $offer->buyer_id);
                
                return redirect()->action('Payments@buyer')->withErrors('Thank you for accpecting the offer. Please make the payment.');
                
            } else {
                
                return back()->withErrors('Failed to process your request. Please contact admin for assistance.');
                
            }
        
        } else {
            
            return back()->withErrors('Failed to process your request. Please contact admin for assistance.');
            
        }
        
    }
    
    
    public function rejectOffer(Request $request, Offer $offers)
    {
        
        $offer = $offers->find($request->input('id'));
        
        if($offer)
        {
            
            $deleted_offer = [
                'name'                      => $offer->name,
                'link'                      => $offer->link,
                'image_url'                 => $offer->image_url,
                'product_price'             => $offer->product_price,
                'offer_price'               => $offer->offer_price,
                'transaction_charge'        => $offer->transaction_charge,
                'airposted_commission'      => $offer->airposted_commission,
                'total_price'               => $offer->total_price,
                'is_reply'                  => 1,
                'is_deleted'                => 1,
                'reply_of'                  => $offer->id,
                'is_agreed'                 => 0,
                'is_offer_from_buyer'       => $request->input('is_offer_from_buyer'),
                'is_offer_from_traveller'   => $request->input('is_offer_from_traveller'),
                'traveller_id'              => $offer->traveller_id,
                'buyer_id'                  => $offer->buyer_id,
                'note'                      => 'I rejected the offer because: '. $request->input('reason'),
            ];
            
            $delete_success = $offers->create($deleted_offer);
            
            if($delete_success)
            {
                
                $delete_success->replyParent()->update(['is_deleted'=> 1]);
                
                if(session('user_type') == 'buyer')
                {
                    
                    $mail = new Mails;
                    
                    $mail->offerRejectedByBuyer($delete_success->traveller_id, $delete_success->buyer_id);
                    
                } else{
                    
                    $mail = new Mails;
                    
                    $mail->offerRejectedByTraveler($delete_success->buyer_id, $delete_success->traveller_id);
                    
                }
                
                
                return back()->withErrors('Offer Rejected Successfully.');
                
            }
            
        } else{
            
            return back()->withErrors('Failed to perform the requested operation. Please contact admin.');
            
        }
        
        
    }
    
    
}

        