<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Favorite_product;
use App\Favorite_buyer;
use App\Favorite_traveller;

class Wishlist extends Controller
{
    
    /**
     * Get Favorite products of the loggedin user
     * 
     * @return json
    */
    public function getProducts(Favorite_product $products)
    {
        
        return $products->where('user_id', auth()->user()->id)->select('name', 'amazon_url as link', 'image_url as image', 'price')->get();
        
    }
    
    /**
     * Store Favorite products of the loggedin user
     * 
     * @return void
    */
    public function storeProducts(Request $request, Favorite_product $products)
    {
        
        if(!$products->where('amazon_url', 'like', $request->input('link'))->first()){
            $products->create([
                'name'          => $request->input('name'),
                'amazon_url'    => $request->input('link'),
                'image_url'     => $request->input('image'),
                'price'         => $request->input('price'),
                'user_id'       => auth()->user()->id,
            ]);
        }
        
    }
    
    /**
     * Delete Favorite products of the loggedin user
     * 
     * @return void
    */
    public function deleteProducts($id, Favorite_product $products)
    {
        
        return ($products->where('id', $id)->where('user_id', auth()->user()->id)->delete()) ? 1 : 0;
        
    }
    
    /**
     * Get Favorite buyers of the loggedin user
     * 
     * @return json
    */
    public function getBuyers(Favorite_buyer $buyers)
    {
        
        return $buyers->where('user_id', auth()->user()->id)->select('buyer_id as id')->get();
        
    }
    
    /**
     * Store Favorite buyers of the loggedin user
     * 
     * @return void
    */
    public function storeBuyers(Request $request, Favorite_buyer $buyers)
    {
        
        $buyers->firstOrCreate(['user_id'=>auth()->user()->id, 'buyer_id'=> $request->input('id')]);
        
    }
    
    /**
     * Delete Favorite buyers of the loggedin user
     * 
     * @return void
    */
    public function deleteBuyers($id, Favorite_buyer $buyers)
    {
        
        return ($buyers->where('user_id', auth()->user()->id)->where('buyer_id',$id)->delete()) ? 1 : 0;
        
    }
    
    /**
     * Get Favorite traveller of the loggedin user
     * 
     * @return json
    */
    public function getTravellers(Favorite_traveller $travel)
    {
        
        $travels = $travel->where('user_id', auth()->user()->id)->get();
        
        $travels_with_travelers = [];
        
        foreach($travels as $t)
        {
            
            $travels_with_travelers[] = ['id'=>$t->travel_id, 'traveler_id'=> $t->traveller->id, 'name'=> $t->traveller->name];
            
        }
        
        return $travels_with_travelers;
        
    }
    
    /**
     * Store Favorite traveller of the loggedin user
     * 
     * @return void
    */
    public function storeTravellers(Request $request, Favorite_traveller $travellers)
    {
        
        $traveller = \App\Travel::find($request->input('id'))->user;
        
        $saved_data = $travellers->firstOrCreate(['user_id'=>auth()->user()->id, 'travel_id'=>$request->input('id'), 'traveller_id'=> $traveller->id]);
        
    }
    
    /**
     * Delete Favorite buyers of the loggedin user
     * 
     * @return void
    */
    public function deleteTravellers($id, Favorite_traveller $travellers)
    {
        
        return ($travellers->where('user_id', auth()->user()->id)->where('travel_id', $id)->delete()) ? 1 : 0;
        
    }
    
    
    public function myWishlist()
    {
        
        $products   = Favorite_product::where('user_id', auth()->user()->id)->get();
        
        $app        = \App\Setting::first();
        
        if(session('user_type') == 'traveller'){
        
            $buyers     = Favorite_buyer::where('user_id', auth()->user()->id)->lists('buyer_id');
            
            $buyers     = \App\Buyer::whereIn('id', $buyers)->groupBy('user_id')->get();
            
            $travellers = [];
            
        } else{
            
            $travels    = Favorite_traveller::where('user_id', auth()->user()->id)->lists('travel_id');
        
            $travellers = \App\Travel::active()->valid()->whereIn('id', $travels)->groupBy('user_id')->orderBy('arrival_date', 'desc')->latest()->get();
            
            $buyers     = [];
            
        }
        
        return view('user.pages.my-wishlist', compact('products', 'buyers', 'travellers', 'app'));
        
    }
    
    
}
