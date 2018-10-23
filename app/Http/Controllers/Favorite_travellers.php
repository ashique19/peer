<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\favorite_travellersStoreRequest;
use App\Http\Controllers\Controller;
use App\Favorite_traveller;

class Favorite_travellers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.favorite_travellers.index', ['favorite_travellers'=> Favorite_traveller::latest()->paginate(20)]);
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(favorite_travellersStoreRequest $request)
    {
        
        
        
        $save_success = Favorite_traveller::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Favorite_travellers@index')->withErrors('Data has been stored successfully.');
        
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
    public function update(favorite_travellersStoreRequest $request, $id)
    {
        $favorite_traveller = Favorite_traveller::find($id);
        
        
        $save_success = Favorite_traveller::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Favorite_travellers@index')->withErrors('Data has been updated successfully.');
        
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
        
        $favorite_traveller = Favorite_traveller::find($id);
        
        if($favorite_traveller)
        {
    
    
            if($favorite_traveller->delete())
            {
            
                return redirect()->action('Favorite_travellers@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    
    
}

        