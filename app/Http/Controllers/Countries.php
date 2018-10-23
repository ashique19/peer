<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\countriesStoreRequest;
use App\Http\Controllers\Controller;
use App\Country;

class Countries extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.countries.index', ['countries'=> Country::latest()->paginate(20)]);
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(countriesStoreRequest $request)
    {
        
        
        
        $save_success = Country::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Countries@index')->withErrors('Data has been stored successfully.');
        
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
    public function update(countriesStoreRequest $request, $id)
    {
        $country = Country::find($id);
        
        
        $save_success = Country::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Countries@index')->withErrors('Data has been updated successfully.');
        
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
        
        $country = Country::find($id);
        
        if($country)
        {
    
    
            if($country->delete())
            {
            
                return redirect()->action('Countries@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    public function airports($id)
    {
        
        return view('admin.countries.airports', ['country' => Country::find($id) ,'airports' => Country::find($id)->airports()->latest()->paginate(20)]);
        
    }
    
    
    public function airportsCreate($id)
    {
        
        return view('admin.countries.airportsCreate', ['country' => Country::find($id) ]);
        
    }
    
    
    public function airportsStore($id, Request $request)
    {
        
        $request['country_id'] = $id;
        
        if(\App\Airport::create($request->all()) )
        {
            
            return redirect()->action('Countries@airports', $id)->withErrors('airport has been added successfully.');
            
        } else{
            
            return back()->withErrors('Please check all the fields.')->withInput();
            
        }
        
    }
    
    
    
        
    
    
    
}

        