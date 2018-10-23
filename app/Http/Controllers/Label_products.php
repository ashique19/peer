<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\label_productsStoreRequest;
use App\Http\Controllers\Controller;
use App\Label_product;

class Label_products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.label_products.index', ['label_products'=> Label_product::latest()->paginate(20)]);
        
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
        
        $result =   new Label_product;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('label_id'))   ? $result = $result->where('label_id', $request->input('label_id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('quantity'))   ? $result = $result->where('quantity', 'like', '%'.$request->input('quantity').'%') : false;
					($request->input('weight'))   ? $result = $result->where('weight', 'like', '%'.$request->input('weight').'%') : false;
					($request->input('value'))   ? $result = $result->where('value', 'like', '%'.$request->input('value').'%') : false;
					($request->input('country_id'))   ? $result = $result->where('country_id', $request->input('country_id')) : false;
					($request->input('hs_tarrif'))   ? $result = $result->where('hs_tarrif', 'like', '%'.$request->input('hs_tarrif').'%') : false;
        
        return view('admin.label_products.index', ['label_products'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.label_products.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(label_productsStoreRequest $request)
    {
        
        
        
        $save_success = Label_product::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Label_products@index')->withErrors('Data has been stored successfully.');
        
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
    
        $label_product = Label_product::find($id); 
        
        return view('admin.label_products.show', compact('label_product') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $label_product = Label_product::find($id); 
        
        return view('admin.label_products.edit', compact('label_product') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(label_productsStoreRequest $request, $id)
    {
        $label_product = Label_product::find($id);
        
        
        $save_success = Label_product::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Label_products@index')->withErrors('Data has been updated successfully.');
        
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
        
        $label_product = Label_product::find($id);
    
        
        if($label_product)
        {
    
    
            if($label_product->delete())
            {
            
                return redirect()->action('Label_products@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    
    
}

        