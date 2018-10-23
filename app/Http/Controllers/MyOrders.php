<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BuyerNew;
use App\Models\TravellerCart;

class MyOrders extends Controller
{
    
    public function index()
    {
        
        $buys = BuyerNew::where('user_id', auth()->user()->id )->latest()->paginate(30);
        
        $travels = TravellerCart::where('user_id', auth()->user()->id )->latest()->paginate(30);
        
        // return BuyerNew::all();
        
        // return $travels->first();
        
        return view('user.pages.product.my-orders', compact('buys', 'travels') );
        
    }
    
}
