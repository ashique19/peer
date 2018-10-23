<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\User;
use App\Http\Requests;
use App\Http\Requests\myProfileUpdateRequest;

class Clients extends Controller
{
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfile()
    {
        
        return view('clients.my-profile');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        
        return view('clients.my-profile-edit');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(myProfileUpdateRequest $request)
    {
        
        if($request->hasFile('picture'))
        {
            if($request->file('picture')->isValid())
            {

                if(Storage::has(User::find(auth()->user()->id)->user_photo))
                {
                    
                    Storage::delete(User::find(auth()->user()->id)->user_photo);
                    
                }
                
                $photo  = date('Ymdhis').'.'.$request->file('picture')->getClientOriginalExtension();
                
                if($request->file('picture')->move(public_path().'/img/users/', $photo))
                {
                    
                    $request['user_photo'] = '/public/img/users/'.$photo;
                    
                }
                
            }
                        
        }
        
        $request['name'] = $request->input('firstname')." ".$request->input('lastname');
        
        if(User::find(auth()->user()->id)->update($request->all()))
        {
            
            return redirect(action('Clients@showProfile'))->withErrors('Profile updated successfully.');
            
        } else{
            
            return back()->withErrors('Failed to update Profile.')->withInput();
            
        }
        
        
    }
    
    
    /**
    *
    * Get changed password view for the logged in user
    *
    */
    public function changePassword()
    {
        
        return view('clients.change-password');
        
    }
    
    
    /**
     *
     * Update password of the loggedin user
     *
     */
    public function updatePassword(Request $request)
    {
            
        if($request->input('newpass') == $request->input('repeatpass'))
        {
            
            if( Auth::attempt([ 'email'=> auth()->user()->email, 'password'=>$request->input('oldpass') ]))
            {
                
                if(\DB::table('users')->where('id',auth()->user()->id)->update(['password'=>bcrypt($request->input('newpass'))]))
                {
                    
                    return back()->withErrors('Password updated successfully.');
                    
                } else{
                    
                    return back()->withErrors('Failed to update password.')->withInput();
                    
                }
                
            } else{
                
                return back()->withErrors('Current password did not match.');
                
            }
            
        } else{
                
            return back()->withErrors('New Password and Repeat Password did not match.');
            
        }
            
        
        
        
    }
    
    
    /**
     * My Referrals
     *
     */
    public function myReferrals()
    {
        
        return view('clients.my-referrals', ['referrals'=> auth()->user()->referees]);
        
    }
    
    /**
     * My Orders
     *
     */
    public function myOrders()
    {
        
        return view('clients.my-orders', [ 'orders'=> auth()->user()->orders()->latest()->paginate(20) ]);
        
    }
    
    /**
     * Show my order
     *
     */
    public function showMyOrder($id)
    {
        
        return view('clients.show-my-order', [ 'order'=> auth()->user()->orders()->where('orders.id', $id)->first() ]);
        
    }
    
    /**
     * Track delivery status of my orders
     *
     */
    public function trackDeliveryOfMyOrders()
    {
        
        return view('clients.track-delivery', [ 'orders'=> auth()->user()->orders()->whereIn('order_status_id', [4,5] )->latest()->paginate(20) ]);
        
    }
    
    /**
     * Clients - My payment history
     *
     */
    public function myPaymentHistory()
    {
        
        return view('clients.payment-history', [ 'orders'=> auth()->user()->orders()->paid()->latest()->paginate(20) ]);
        
    }
    
    /**
     * Clients - My payment history
     *
     */
    public function myPoints()
    {
        
        return view('clients.my-points');
        
    }
    
}
