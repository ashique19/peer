<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    


    public function index(Request $request)
    {
        // $app            = \App\Setting::first();

        return view('user.pages.product.index');
        
        
    }
    
    public function details(Request $request)
    {
        $params = $request->request->all();
        
        return view('user.pages.product.details', $params);
        
        
    }

    public function amazon()
    {
        return view('user.pages.product.amazon');
    }
    public function amazon1()
    {
        return view('user.pages.product.amazon1');
    }

}
