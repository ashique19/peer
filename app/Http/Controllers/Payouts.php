<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Payout;

class Payouts extends Controller
{
    
    public function index()
    {
        
        $payouts = Payout::latest()->paginate(30);
        
        return view('admin.payouts.index', compact('payouts') );
        
    }
    
    public function update(Request $request, $id)
    {
        
        
        $payout = Payout::find( $id );
        
        if( $payout )
        {
            
            $payout->update( $request->all() );
            
            return back()->withErrors('Update was successful');
            
        } else{
            
            return back()->withErrors('Update failed');
            
        }
        
        return $request->all();
        
    }
    
}
