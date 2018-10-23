<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserAccounts extends Controller
{
    
    use \App\Http\Traits\Images;
    
    public function modify()
    {
        
        return view('user.pages.account-edit');
        
    }
    public function modifyNew()
    {

        return view('user.pages.product.account-edit');

    }
    
    public function modifyPassword()
    {
        
        return view('user.pages.password-edit');
        
    }
    public function modifyPasswordNew()
    {

        return view('user.pages.product.password-edit');

    }
    
    public function modifyPayoutPreference()
    {
        
        return view('user.pages.payout-preference-edit');
        
    }
    
    
    public function deleteAccount()
    {
        
        return view('user.pages.delete-account');
        
    }
    
    
    public function profile()
    {
        
        return view('user.pages.profile');
        
    }
    
    public function replaceProfileImage(Request $request)
    {
        
        $image = $this->updateImage($request, auth()->user(), 'user_photo', 'user_photo', 'users', auth()->user()->user_photo );
        
        if( auth()->user()->update([ 'user_photo'=> $image ] ) )
        {
            
            return 1;
            
        } else{
            
            return 0;
            
        }
        
    }

    public function dashboard()
    {
        return view('user.pages.product.dashboard');
    }
    
}
