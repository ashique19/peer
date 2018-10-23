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
    
}
