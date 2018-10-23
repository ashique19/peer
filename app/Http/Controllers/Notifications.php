<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\notificationsStoreRequest;
use App\Http\Controllers\Controller;
use App\Notification;

class Notifications extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        Notification::where('notification_to', auth()->user()->id )->update(['is_delivered'=> 1]);
        
        return view('admin.notifications.index', ['notifications'=> Notification::latest()->paginate(50)]);
        
    }
    
    
    public function sent()
    {
        
        Notification::where('notification_to', auth()->user()->id )->update(['is_delivered'=> 1]);
        
        return view('admin.notifications.index', ['notifications'=> Notification::sent()->latest()->paginate(50)])->withErrors('Sent Notifications');
        
    }
    
    
    public function received()
    {
        
        Notification::where('notification_to', auth()->user()->id )->update(['is_delivered'=> 1]);
        
        return view('admin.notifications.index', ['notifications'=> Notification::received()->latest()->paginate(50)])->withErrors('Received Notifications');
        
    }
    
    
    public function undelivered()
    {
        
        Notification::where('notification_to', auth()->user()->id )->update(['is_delivered'=> 1]);
        
        return view('admin.notifications.index', ['notifications'=> Notification::unDelivered()->latest()->paginate(50)])->withErrors('Undelivered Notifications');
        
    }
    
    
    public function byUser($user_id)
    {
        
        Notification::where('notification_to', auth()->user()->id )->update(['is_delivered'=> 1]);
        
        
        $notifications  = Notification::where('notification_from', auth()->user()->id)->where('notification_to', $user_id)->latest()->paginate(50);
        
        $user   = \App\User::find($user_id);
                
        return view('admin.notifications.user', compact('notifications', 'user') );
        
    }
    
    
    public function search(Request $request)
    {
        
        $user_id = (int) $request->input('search_name');
        
        if( $user_id < 2) return back()->withErrors('Sorry, your search does not seem to be valid. Please retry.');

        
        // Mark my received messages as delivered
        Notification::where('notification_to', auth()->user()->id )->update(['is_delivered'=> 1]);

        
        $user           = \App\User::find( $user_id );
        
        $notifications  = Notification::where('notification_from', $user_id )->orWhere('notification_to', $user_id )->latest()->paginate(50);
        
        return view('admin.notifications.user', compact('notifications', 'user') );
        
        
    }
    
    
    public function userView()
    {
        
        // Notification::where('notification_to', auth()->user()->id )->update(['is_delivered'=> 1]);
        
        $notifications  = Notification::where('notification_to', auth()->user()->id)->latest()->paginate(20);
        
        return view('user.pages.notification', compact('notifications') );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(notificationsStoreRequest $request)
    {
        
        $save_success = Notification::create($request->all());
        
        if($save_success){
        
            return back()->withErrors('Sent Success.');
        
        } else{
            
            return back()->withInput()->withErrors('Sending failed. Please check data and retry.');
            
        }
    
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(notificationsStoreRequest $request, $id)
    {
        $notification = Notification::find($id);
        
        
        $save_success = Notification::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Notifications@index')->withErrors('Data has been updated successfully.');
        
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
        
        $notification = Notification::find($id);
    
        
        if($notification)
        {
    
    
            if($notification->delete())
            {
            
                return back()->withErrors('Notification has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete notification. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    public function markRead()
    {
        
        auth()->user()->receivedNotifications()->where('is_delivered', 0)->update([ 'is_delivered' => 1 ]);
        
    }
    
    
}

        