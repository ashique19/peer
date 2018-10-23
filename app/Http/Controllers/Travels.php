<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\travelsStoreRequest;
use App\Http\Controllers\Controller;
use App\Travel;

class Travels extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.travels.index', ['travels'=> Travel::latest()->paginate(20)]);
        
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
        
        $result =   new Travel;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('arrival_date'))   ? $result = $result->where('arrival_date', 'like', '%'.$request->input('arrival_date').'%') : false;
					($request->input('departure_date'))   ? $result = $result->where('departure_date', 'like', '%'.$request->input('departure_date').'%') : false;
					($request->input('travel_date'))   ? $result = $result->where('travel_date', 'like', '%'.$request->input('travel_date').'%') : false;
					($request->input('country_from'))   ? $result = $result->where('country_from', 'like', '%'.$request->input('country_from').'%') : false;
					($request->input('country_to'))   ? $result = $result->where('country_to', 'like', '%'.$request->input('country_to').'%') : false;
					($request->input('airport_from'))   ? $result = $result->where('airport_from', 'like', '%'.$request->input('airport_from').'%') : false;
					($request->input('airport_to'))   ? $result = $result->where('airport_to', 'like', '%'.$request->input('airport_to').'%') : false;
					($request->input('user_id'))   ? $result = $result->where('user_id', $request->input('user_id')) : false;
					($request->input('is_active'))   ? $result = $result->where('is_active', 'like', '%'.$request->input('is_active').'%') : false;
        
        $travelData = $result->latest()->paginate(20);
        if($request->is('api/*')) {
            if($travelData){
                return JsonResponse::create(['data' => $travelData, 'status' => 200, 'message' => 'Travel lists'], 200);
            } else{
                return JsonResponse::create(['data' => $travelData, 'status' => 400, 'message' => 'Not Found'], 200);
            }
        } else {
            return view('admin.travels.index', ['travels'=> $travelData]);
        }
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.travels.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(travelsStoreRequest $request)
    {
        
        
        
        $save_success = Travel::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Travels@index')->withErrors('Data has been stored successfully.');
        
        } else{
            
            return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            
        }
    
    }
    
    public function add()
    {
        
        return view('user.pages.product.travel-add', ['travels'=> Travel::latest()->paginate(20)]);
        
    }
    
    public function storeNew(travelsStoreRequest $request)
    {
        $save_success = Travel::create($request->all());
        if($request->is('api/*')) {
            if($save_success){
                return JsonResponse::create(['data' => $save_success, 'status' => 200, 'message' => 'Product added'], 200);
            } else{
                return JsonResponse::create(['data' => $save_success, 'status' => 400, 'message' => 'Bad request'], 200);
            }
        } else {
            if ($save_success) {
                return redirect()->action('Travels@index')->withErrors('Data has been stored successfully.');
            } else {
                return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            }
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
    
        $travel = Travel::find($id); 
        
        return view('admin.travels.show', compact('travel') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $travel = Travel::find($id); 
        
        return view('admin.travels.edit', compact('travel') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(travelsStoreRequest $request, $id)
    {
        $travel = Travel::find($id);
        
        
        $save_success = Travel::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Travels@index')->withErrors('Data has been updated successfully.');
        
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
        
        $travel = Travel::find($id);
        $isApi = $request->is('api/*');
        if($travel)
        {
            if($travel->delete())
            {
                return ($isApi) ? JsonResponse::create( ['data' => true, 'status' => 200, 'message' => 'Product added'], 200)
                        : redirect()->action('Travels@index')->withErrors('Data has been deleted successfully.');
            } else{
                return ($isApi) ? JsonResponse::create( ['data' => false, 'status' => 400, 'message' => 'Failed to delete data. Please retry later.'], 200)
                        : back()->withErrors('Failed to delete data. Please retry later.');
            }
        } else{
            return ($isApi) ? JsonResponse::create( ['data' => false, 'status' => 400, 'message' => 'Failed to delete data. Please retry later.'], 200)
                : back()->withErrors('Failed to delete data. Please retry later.');
        }
    }
    
    
    
    public function myTravels(\App\Travel $travels)
    {
        
        $myTravels = $travels->where('user_id', auth()->user()->id)->expired()->latest()->paginate(20);
        
        return view('user.pages.travel-history', compact('myTravels') );
            
    }
    
    public function myActiveTravels(\App\Travel $travels)
    {
        
        $myTravels = auth()->user()->tripPosts()->active()->valid()->latest()->paginate(20);
        
        return view('user.pages.active-travel-history', compact('myTravels') );
            
    }
    
    
    public function storeMyTravel(travelsStoreRequest $request, \App\Http\Controllers\Mails $mail)
    {
        
        $request['user_id'] = auth()->user()->id;

        $now = \Carbon::now();
        $departureDate = \Carbon::parse($request->input('departure_date'));
        $arrivalDate = \Carbon::parse($request->input('arrival_date'));

        if($departureDate->lt($now) || $arrivalDate->lt($now) || $arrivalDate->lt($departureDate) )
//        if($request->input('departure_date') < \Carbon::now() || $request->input('arrival_date') < \Carbon::now() || $request->input('arrival_date') < $request->input('departure_date') )
        {
            
            return back()->withInput()->withErrors('Please check your Arrival and Departure Date.');
            
        }
        
        if( $request->has('country') )
        {
            
            \App\User::find( auth()->user()->id )->update( [ 'country_id'=> $request->input('country') ] );
            
        }
        
        if( $request->has('phone_no') && $request->has('country_code') )
        {
            
            \App\User::find( auth()->user()->id )->update( ['contact'=> $request->input('country_code') . $request->input('phone_no')] );
            
        }
        
        if( !auth()->user()->country_id ) return back()->withInput()->withErrors('Please update your basic profile (current location)');
        $request->request->set('departure_date', $departureDate);
        $request->request->set('arrival_date', $arrivalDate);

        $save_success = Travel::create($request->all());

        if($save_success){
//            die(var_dump($save_success));
            // $mail->travelWishPosted();
        
            return redirect()->action('Buyers@search')->withErrors('Travel info has been stored successfully.');
            
            // return redirect()->action('Buyers@buyerSearchByTraveller')->withErrors('Travel info has been stored successfully.');
            
            // return back()->withErrors('Travel info has been stored successfully.');
        
        } else{
            
            return back()->withErrors('Failed to store data. Please check data and retry.');
            
        }
    
    }
    
    
    public function travellerSearchByBuyer()
    {
        
        $travellers = \App\Travel::active()->valid()->orderBy('arrival_date')->paginate(20);
        
        $countries  = \App\Country::all();
        
        // $airports   = \App\Airport::all();
        
        $app        = \App\Setting::first();
        
        return view('user.pages.search-for-traveller', compact('travellers', 'countries', 'app') );
        
    }
    
    
    public function postTravellerSearchByBuyer(Request $request)
    {
        // return $request->all();
        $travellers = Travel::active()->valid();
        
        /**
         * @ Airposted V2 - Traveler search
         *  Search by country and travel date has been withdrawn
        */
        
        (strlen($request->input('country_from')) > 0)   ? $travellers = $travellers->where('country_from', $request->input('country_from')) : false;
        // (strlen(trim($request->input('country_to'))) > 0)  ? $travellers = $travellers->where('country_to',$request->input('country_to')) : false;
        // (strlen(trim($request->input('airport_from'))) > 0)  ? $travellers = $travellers->where('airport_from',$request->input('airport_from')) : false;
        (count(array_filter($request->input('airport_to'))))  ? $travellers = $travellers->whereIn('airport_to',$request->input('airport_to')) : false;
        // (strlen($request->input('date_from')) > 0) ? $travellers = $travellers->where('arrival_date', '>=', $request->input('date_from')) : false;
        (strlen($request->input('date_to')) > 0)   ? $travellers = $travellers->where('arrival_date', '<=', $request->input('date_to')) : false;
        
        $travellers = $travellers->orderBy('arrival_date')->paginate(30);
        
        $countries  = \App\Country::all();
        
        $app        = \App\Setting::first();
        
        return view('user.pages.search-for-traveller', compact('travellers', 'countries', 'app') );
        
    }
    
    
    public function deactivateTravel(Request $request)
    {
        
        if(\App\Travel::where('id', $request->input('id'))->where('user_id', auth()->user()->id)->first()->update(['is_active'=> 0]))
        {
            
            return back()->withErrors('Travel has been deactivated successfully.');
            
        } else{
            
            return back()->withErrors('Failed to update travel info. Please contact admin for help.');
            
        }
        
    }
    
    
    public function activateTravel(Request $request)
    {
        
        if(\App\Travel::where('id', $request->input('id'))->where('user_id', auth()->user()->id)->first()->update(['is_active'=> 1]))
        {
            
            return back()->withErrors('Travel has been activated successfully.');
            
        } else{
            
            return back()->withErrors('Failed to update travel info. Please contact admin for help.');
            
        }
        
    }
    
    
    public function travellerDetails($id)
    {
        
        $traveller = \App\User::where('id',$id)->where('role', 3)->first();
        
        $travels    = ($traveller) ? $traveller->travels()->latest()->get() : [];
        
        $reviews    = ($traveller) ? $traveller->reviews()->get() : [];
        
        return view('user.pages.traveller-details', compact('traveller','travels', 'reviews') );
        
    }
    
    public function travellerReview($id, Request $request)
    {
        if( ($comment = $request->get('comment')) && $rating = $request->get('rating')) {
            $reviewData = \App\Review::create([
                'comment' => $comment,
                'rating' => $rating,
                'rate_by' => auth()->user()->id,
                'traveller_id' => $id
                ]);

            return json_encode(['data' => ['id' => $reviewData->id ], 'status' => 201, 'message' => 'review added']);
            
        } 
    
        return json_encode(['data' => [], 'status' => 400, 'message' => 'bad request']);
            
    }
}

