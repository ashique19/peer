<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\NavRole;
use App\Http\Controllers\Controller;
use App\Skill;
use App\Setting;

class Dashboard extends Controller
{
    
    /**
     * 
     * Contains Application Settings table data
     * 
     */
    private $app;
    
    
    public function __construct()
    {
        
        $this->app = Setting::first();
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index( Request $request)
    {
        
        $prefix = collect(explode('/',$request->path()))->first();
        
        /**
         * 
         * @if we logged in to checkout, we get redirected to checkout page
         * 
         */
        
        if(session()->has('redirect_to_checkout'))
        {
            
            if(session('redirect_to_checkout') == 1)
            {
                
                session(['redirect_to_checkout' => '0']);
                
                return redirect()->action('StaticPageController@orderCheckout');
                
            }
            
        }
        
        if(auth()->user())
        {
            
            switch(auth()->user()->role)
            {
                
                case '1': 
                    return $this->dev();
                    break;
                    
                case '2': 
                    return $this->admin();
                    break;
                    
                case '3': 
                    if($prefix != "user") return redirect()->route('userDashboard');
                    return $this->client();
                    break;
                    
                case '4': 
                    if($prefix != "user") return redirect()->route('userDashboard');
                    return $this->client();
                    break;
                    
                default:
                    return view('admin.dashboards.blank');
                    break;
                
            }
            
        } else{
            
            return redirect()->route('login');
            
        }
        
    }
    
    
    private function dev()
    {
        
        return view('admin.dashboards.dev', ['app'=> $this->app ]);
        
    }
    
    
    private function admin()
    {
        
        return view('admin.dashboards.admin', ['app'=> $this->app ]);
        
    }
    
    
    private function client()
    {
        
        $myBuys = \App\Buyer::where('user_id', auth()->user()->id)->latest()->paginate(20);
        
        $app    = \App\Setting::first();
        
        return view('user.dashboards.client', compact( 'myBuys', 'app') );
        
    }
    
    
    private function vendor()
    {
        
        return view('admin.dashboards.vendor', ['app'=> $this->app ]);
        
    }
    
    
    public function setUserTypeToBuyer()
    {
        
        session(['user_type'=>'buyer']);
        
        return redirect()->route('userDashboard')->withErrors(['user_type'=>'You have set yourself as a buyer. You can switch to traveler anytime.']);
        
    }
    
    
    public function setUserTypeToTraveller()
    {
        
        session(['user_type'=>'traveller']);
        
        return redirect()->route('userDashboard')->withErrors(['user_type'=>'You have set yourself as a traveler. You can switch to buyer anytime.']);
        
    }
    
}
