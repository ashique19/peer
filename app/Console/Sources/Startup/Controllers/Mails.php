<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Mail;

class Mails extends Controller
{
    
    public function signup($id)
    {//return $id;
        
        if($user = User::find($id))
        {//return $user;
            switch($user->role)
            { 
                
                case 1:
                        Mail::send('mails.clientSignup', ['user'=>$user], function ($message) use ($user) {
                            $message->to($user->email, $user->firstname.$user->lastname);
                    	    $message->from('info@teamsourcing.com.bd', 'TeamSourcing Admin');
                    	    $message->subject('Welcome to TeamSourcing Bangladesh');
                    	    
                    	});
                    	
                    	
                    	if($user->referrer_id)
                    	{
                    	    
                    	    if(User::where('id',$user->referrer_id)->first())
                    	    {
                    	        $referrer = User::where('id',$user->referrer_id)->first();
                    	        
                    	        Mail::send('mails.clientSignupInfoToReferrer', ['user'=>$user, 'referrer'=>$referrer], function ($message) use ($user,$referrer) {
                                    $message->to($referrer->email, $referrer->firstname.$referrer->lastname);
                            	    $message->from('info@teamsourcing.com.bd', 'TeamSourcing Admin');
                            	    $message->subject('You have a new client at TeamSourcing (Bangladesh)');
                            	    
                            	});
                            	
                    	        
                    	    }
                    	    
                    	}
                    	
                    	//return view('mails.clientSignupInfoToReferrer',['user'=>$user, 'referrer'=>$referrer]);
                        break;
                case 2:
                    break;
                case 3:
                    break;
                case 4:
                        Mail::send('mails.clientSignup', ['user'=>$user], function ($message) use ($user) {
                            $message->to($user->email, $user->firstname.$user->lastname);
                    	    $message->from('info@teamsourcing.com.bd', 'TeamSourcing Admin');
                    	    $message->subject('Welcome to TeamSourcing Bangladesh');
                    	    
                    	});
                    	
                    	
                    	if($user->referrer_id)
                    	{
                    	    
                    	    if(User::where('id',$user->referrer_id)->first())
                    	    {
                    	        $referrer = User::where('id',$user->referrer_id)->first();
                    	        
                    	        Mail::send('mails.clientSignupInfoToReferrer', ['user'=>$user, 'referrer'=>$referrer], function ($message) use ($user,$referrer) {
                                    $message->to($referrer->email, $referrer->firstname.$referrer->lastname);
                            	    $message->from('info@teamsourcing.com.bd', 'TeamSourcing Admin');
                            	    $message->subject('You have a new client at TeamSourcing (Bangladesh)');
                            	    
                            	});
                            	
                    	        
                    	    }
                    	    
                    	}
                    	
                    break;
                case 6:
                        
                    	
                    	
                    break;
                case 5:
                    
                    break;
                default:
                    break;
                
            }
            
            
        }
        
    }
    
    
    public function accountActivation($id)
    {
        
        $user = User::where('id',$id)->first();
        
        if($user)
        {
            
            Mail::send('mails.clientAccountActivationConfirmation', ['user'=>$user], function ($message) use ($user) {
                $message->to($user->email, $user->firstname." ".$user->lastname);
        	    $message->from('info@teamsourcing.com.bd', 'TeamSourcing Admin');
        	    $message->subject('Your account has been activated at TeamSourcing (BD)');
        	    $message->bcc('ashique19@gmail.com', 'A3');
        	});
            
        }
        
    }
    
    
    public function forgotPassword($id, $new_password)
    {
        
        if($user = User::find($id)){
            
            
            Mail::send('mails.forgotPassword', ['user' => $user, 'new_password'=>$new_password], function ($m) use ($user) {
                $m->to($user->email, $user->firstname." ".$user->lastname)
                  ->subject('Password Recovery')
                  ->from('ashique19@gmail.com', 'Admin');
            });
            
        }
        
    }
    
   
    
}
