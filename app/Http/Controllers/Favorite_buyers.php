<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\favorite_buyersStoreRequest;
use App\Http\Controllers\Controller;
use App\Favorite_buyer;

class Favorite_buyers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.favorite_buyers.index', ['favorite_buyers'=> Favorite_buyer::latest()->paginate(20)]);
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(favorite_buyersStoreRequest $request)
    {
        
        
        
        $save_success = Favorite_buyer::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Favorite_buyers@index')->withErrors('Data has been stored successfully.');
        
        } else{
            
            return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            
        }
    
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(favorite_buyersStoreRequest $request, $id)
    {
        $favorite_buyer = Favorite_buyer::find($id);
        
        
        $save_success = Favorite_buyer::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Favorite_buyers@index')->withErrors('Data has been updated successfully.');
        
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
        
        $favorite_buyer = Favorite_buyer::find($id);
        
        if($favorite_buyer)
        {
    
    
            if($favorite_buyer->delete())
            {
            
                return redirect()->action('Favorite_buyers@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    
    
}

        