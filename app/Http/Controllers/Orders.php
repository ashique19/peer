<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ordersStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mails;
use App\Order;
use App\Order_log;

class Orders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.orders.index', ['orders'=> Order::latest()->paginate(20)]);
        
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
        
        $result =   new Order;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('user_id'))   ? $result = $result->where('user_id', $request->input('user_id')) : false;
					($request->input('status'))   ? $result = $result->where('status', 'like', '%'.$request->input('status').'%') : false;
					($request->input('no_of_products'))   ? $result = $result->where('no_of_products', 'like', '%'.$request->input('no_of_products').'%') : false;
					($request->input('product_cost'))   ? $result = $result->where('product_cost', 'like', '%'.$request->input('product_cost').'%') : false;
					($request->input('shipping_cost'))   ? $result = $result->where('shipping_cost', 'like', '%'.$request->input('shipping_cost').'%') : false;
					($request->input('airposted_margin'))   ? $result = $result->where('airposted_margin', 'like', '%'.$request->input('airposted_margin').'%') : false;
					($request->input('order_total'))   ? $result = $result->where('order_total', 'like', '%'.$request->input('order_total').'%') : false;
					($request->input('label_id'))   ? $result = $result->where('label_id', $request->input('label_id')) : false;
					($request->input('payment_id'))   ? $result = $result->where('payment_id', $request->input('payment_id')) : false;
        
        return view('admin.orders.index', ['orders'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.orders.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ordersStoreRequest $request)
    {
        
        
        
        $save_success = Order::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Orders@index')->withErrors('Data has been stored successfully.');
        
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
    
        $order = Order::find($id); 
        
        $label = $order ? $order->label : [];

        $products = $order ? $order->order_products : [];
        
        $payment = $order ? $order->payment : [];
        
        return view('admin.orders.show', compact('order', 'label', 'products', 'payment') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $order = Order::find($id); 
        
        return view('admin.orders.edit', compact('order') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ordersStoreRequest $request, $id)
    {
        $order = Order::find($id);
        
        
        $save_success = Order::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Orders@index')->withErrors('Data has been updated successfully.');
        
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
        
        $order = Order::find($id);
    
        
        if($order)
        {
    
    
            if($order->delete())
            {
            
                return redirect()->action('Orders@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    public function order_products($id)
    {
        
        return view('admin.orders.order_products', ['order' => Order::find($id) ,'order_products' => Order::find($id)->order_products()->latest()->paginate(20)]);
        
    }
    
    
    public function order_productsCreate($id)
    {
        
        return view('admin.orders.order_productsCreate', ['order' => Order::find($id) ]);
        
    }
    
    
    public function order_productsStore($id, Request $request)
    {
        
        $request['order_id'] = $id;
        
        if(\App\Order_product::create($request->all()) )
        {
            
            return redirect()->action('Orders@order_products', $id)->withErrors('order_product has been added successfully.');
            
        } else{
            
            return back()->withErrors('Please check all the fields.')->withInput();
            
        }
        
    }
    
    
    public function order_logs($id)
    {
        
        return view('admin.orders.order_logs', ['order' => Order::find($id) ,'order_logs' => Order::find($id)->order_logs()->latest()->paginate(20)]);
        
    }
    
    
    public function order_logsCreate($id)
    {
        
        return view('admin.orders.order_logsCreate', ['order' => Order::find($id) ]);
        
    }
    
    
    public function order_logsStore($id, Request $request)
    {
        
        $request['order_id'] = $id;
        
        if(\App\Order_log::create($request->all()) )
        {
            
            return redirect()->action('Orders@order_logs', $id)->withErrors('order_log has been added successfully.');
            
        } else{
            
            return back()->withErrors('Please check all the fields.')->withInput();
            
        }
        
    }
    
    
    public function updateOrderPricing($orderID)
    {
        
        $order = Order::find($orderID);
        
        if($order)
        {
            
            $label      = $order->label;
            $payment    = $order->payment;
            $products   = $order->order_products;
            $log        = new \App\Order_log;
            
            
            $product_price          = 0;
            
            if( $products )
            {
                
                foreach( $products as $product )
                {
                    
                    $product_price += round( $product->price * $product->quantity );
                    
                }
                
            }
            
            $shipping_charge        = round( $label->rates_totalCarrierCharge > 0 ? $label->rates_totalCarrierCharge : $order->shipping_cost );
            $airposted_commission   = round( ( $product_price + $shipping_charge ) * env('AIRPOSTED_ORDER_MARGIN_PERCENTAGE') / 100 );
            
            $total_before_transaction_charge = round( $product_price + $shipping_charge + $airposted_commission );
            $transaction_charge     = round( gateway_charge($total_before_transaction_charge) );
            
            $total_payment          = $total_before_transaction_charge + $transaction_charge;
            
            
            $payment->update([
                'product_price'         => $product_price,
                'airposted_commission'  => $airposted_commission,
                'transaction_charge'    => $transaction_charge,
                'payment'               => $total_payment
            ]);
            
            
            $order->update([
                'no_of_products'    => $products->sum('quantity'),
                'product_cost'      => $product_price,
                'shipping_cost'     => $shipping_charge,
                'airposted_margin'  => $airposted_commission,
                'order_total'       => $total_payment
            ]);
            
            $log->create([
                'name'      => 'Order updated',
                'order_id'  => $order->id,
                'user_id'   => auth()->user()->id,
                'log_detail'=> 'System: Order has been updated successfully.'
            ]);
            
        }
        
        return $order;
        
    }   
    
    
    public function updateStatus(Request $request, Mails $mail)
    {
        
        $order = Order::find($request->input('id'));
        
        if($order)
        {
            
            $old_status = order_status($order->status);
            
            $status_updated = $order->update(['status'=> $request->input('status') ]);
            
            if( ! $status_updated) return 0;
            
            Order_log::create([
                'name' => 'Status updated',
                'order_id' => $order->id,
                'user_id' => auth()->user()->id,
                'log_detail' => 'System: Status updated - '.$old_status.' > '. order_status($request->input('status'))
            ]);
            
            if( $request->has('notify_user') ) $mail->OrderStatusUpdateToUser($order, auth()->user());
            
            return 1;
            
        }
        
        return 0;
        
    }
    
    
}

        