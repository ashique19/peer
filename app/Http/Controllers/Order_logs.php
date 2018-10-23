<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\order_logsStoreRequest;
use App\Http\Controllers\Controller;
use App\Order_log;

class Order_logs extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.order_logs.index', ['order_logs'=> Order_log::latest()->paginate(20)]);
        
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
        
        $result =   new Order_log;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('order_id'))   ? $result = $result->where('order_id', $request->input('order_id')) : false;
					($request->input('user_id'))   ? $result = $result->where('user_id', $request->input('user_id')) : false;
					($request->input('created_by'))   ? $result = $result->where('created_by', 'like', '%'.$request->input('created_by').'%') : false;
					($request->input('updated_by'))   ? $result = $result->where('updated_by', 'like', '%'.$request->input('updated_by').'%') : false;
					($request->input('log_detail'))   ? $result = $result->where('log_detail', 'like', '%'.$request->input('log_detail').'%') : false;
        
        return view('admin.order_logs.index', ['order_logs'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.order_logs.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(order_logsStoreRequest $request)
    {
        
        
        
        $save_success = Order_log::create($request->all());
        
        if($save_success){
        
            $log = \App\Order_log::find($save_success->id);
            
            \App\Notification::create([
                'name' => 'Note to your order:'.$log->log_detail,
                'link' => 'order-summary/'.$log->order_id ,
                'notification_to' => $log->user_id
            ]);
            
            return [
                
                    'name' => $log->name,
                    'detail' => $log->log_detail,
                    'created_by' => auth()->user()->name,
                    'created_at' => date('M-d-Y')
                
                ];
        
        } else{
            
            return 2;
            
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
    
        $order_log = Order_log::find($id); 
        
        return view('admin.order_logs.show', compact('order_log') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $order_log = Order_log::find($id); 
        
        return view('admin.order_logs.edit', compact('order_log') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(order_logsStoreRequest $request, $id)
    {
        $order_log = Order_log::find($id);
        
        
        $save_success = Order_log::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Order_logs@index')->withErrors('Data has been updated successfully.');
        
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
        
        $order_log = Order_log::find($id);
    
        
        if($order_log)
        {
    
    
            if($order_log->delete())
            {
            
                return redirect()->action('Order_logs@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    
    
}

        