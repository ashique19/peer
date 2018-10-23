<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\favorite_productsStoreRequest;
use App\Http\Controllers\Controller;
use App\Favorite_product;

class Favorite_products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.favorite_products.index', ['favorite_products'=> Favorite_product::latest()->paginate(20)]);
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(favorite_productsStoreRequest $request)
    {
        
        
        
        $save_success = Favorite_product::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Favorite_products@index')->withErrors('Data has been stored successfully.');
        
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
    public function update(favorite_productsStoreRequest $request, $id)
    {
        $favorite_product = Favorite_product::find($id);
        
        
        $save_success = Favorite_product::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Favorite_products@index')->withErrors('Data has been updated successfully.');
        
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
        
        $favorite_product = Favorite_product::find($id);
        
        if($favorite_product)
        {
    
    
            if($favorite_product->delete())
            {
            
                return redirect()->action('Favorite_products@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    
    
}

        