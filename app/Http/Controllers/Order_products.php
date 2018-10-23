<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\order_productsStoreRequest;
use App\Http\Controllers\Controller;
use App\Order_product;

class Order_products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.order_products.index', ['order_products'=> Order_product::latest()->paginate(20)]);
        
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
        
        $result =   new Order_product;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('order_id'))   ? $result = $result->where('order_id', $request->input('order_id')) : false;
					($request->input('source'))   ? $result = $result->where('source', 'like', '%'.$request->input('source').'%') : false;
					($request->input('product_url'))   ? $result = $result->where('product_url', 'like', '%'.$request->input('product_url').'%') : false;
					($request->input('category_id'))   ? $result = $result->where('category_id', $request->input('category_id')) : false;
					($request->input('price'))   ? $result = $result->where('price', 'like', '%'.$request->input('price').'%') : false;
					($request->input('height'))   ? $result = $result->where('height', 'like', '%'.$request->input('height').'%') : false;
					($request->input('width'))   ? $result = $result->where('width', 'like', '%'.$request->input('width').'%') : false;
					($request->input('length'))   ? $result = $result->where('length', 'like', '%'.$request->input('length').'%') : false;
					($request->input('weight'))   ? $result = $result->where('weight', 'like', '%'.$request->input('weight').'%') : false;
					($request->input('dimension_unit'))   ? $result = $result->where('dimension_unit', 'like', '%'.$request->input('dimension_unit').'%') : false;
					($request->input('weight_unit'))   ? $result = $result->where('weight_unit', 'like', '%'.$request->input('weight_unit').'%') : false;
					($request->input('product_image'))   ? $result = $result->where('product_image', 'like', '%'.$request->input('product_image').'%') : false;
					($request->input('quantity'))   ? $result = $result->where('quantity', 'like', '%'.$request->input('quantity').'%') : false;
					($request->input('note'))   ? $result = $result->where('note', 'like', '%'.$request->input('note').'%') : false;
        
        return view('admin.order_products.index', ['order_products'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.order_products.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(order_productsStoreRequest $request)
    {
        
        
        
        $save_success = Order_product::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Order_products@index')->withErrors('Data has been stored successfully.');
        
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
    
        $order_product = Order_product::find($id); 
        
        return view('admin.order_products.show', compact('order_product') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $order_product = Order_product::find($id); 
        
        return view('admin.order_products.edit', compact('order_product') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(order_productsStoreRequest $request, $id)
    {

        $order_product = Order_product::find($id);
        
        $orderID = $order_product ? $order_product->order_id : null;
        
        $save_success = Order_product::find($id)->update($request->all());
        
        if($save_success)
        {
            
            (new \App\Http\Controllers\Orders)->updateOrderPricing( $orderID );
            
            \App\Notification::create([
                'name' => 'Your order has been modified. Check detail for new item and values.',
                'link' => 'order-summary/'.$orderID ,
                'notification_to' => $order_product->order->user_id
            ]);
            
            return back()->withErrors('Data has been updated successfully.');
        
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
        
        
        $order_product = Order_product::find($id);
    
        
        if($order_product)
        {
            
            $orderID = $order_product->order_id;
            
            if($order_product->delete())
            {
                
                (new \App\Http\Controllers\Orders)->updateOrderPricing( $orderID );
            
                return back()->withErrors('Order has been updated successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    
    
}

        