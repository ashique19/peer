<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use Socialite;
use Illuminate\Http\Request;
use App\NavRole;

use App\Http\Requests;
use App\Http\Requests\signupRequest;
use App\Http\Requests\passwordRecoveryRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mails;
use Carbon\Carbon;

class AccessController extends Controller
{
    
    public function login()
    {
        if( Auth::user() )
        {
            
            return redirect()->route('dashboard');
        
        } else{
            
            return view('admin.login');
            
        }
    }
    
    
    public function postLogin(Request $request, NavRole $navrole)
    {
        
        $user   = \App\User::where('email',$request->input('email'))->first();
        
        if($user)
        {
            
            // if($user->expiry_date < Carbon::now())
            // {
                
            //     return back()->withErrors('Account has expired. Please contact admin to re-activate');
                
            // }
            
            if($user->active == 0)
            {
                return back()->withErrors('Your account is de-active. Please contact admin for help.');
            }
            
        }
        
        
        
        if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]))
        {
            
            $leftnav_parent = $navrole->auth()->parent()->leftnav()->active()->get();
            $leftnav_child  = $navrole->auth()->child()->leftnav()->active()->get();
            
            $topnav_parent  = $navrole->public()->parent()->topnav()->active()->get();
            $topnav_child   = $navrole->public()->child()->topnav()->active()->get();
            
            $permissions    = auth()->user()->roles()->first()->permissions()->lists('permissions.name','permissions.id');
            
            session(['leftnav_parent'=>$leftnav_parent, 'leftnav_child'=>$leftnav_child]);
            session(['topnav_parent'=>$topnav_parent, 'topnav_child'=>$topnav_child]);
            session(['permissions' => $permissions]);
            
            return redirect()->route('dashboard');
            
        } else{
            
            return back()->withErrors('authentication failed')->withInput();
            
        }
        
    }
    
    
    public function logout()
    {
    
        Auth::logout();
        
        return redirect()->route('login');
        
    }
    
    
    public function forgotPassword()
    {
        
        return back();
        
    }
    
    
    public function postForgotPassword(passwordRecoveryRequest $request, Mails $mail)
    {
        
        $email  = $request->input('recovery_email');
        
        $user = \App\User::where('email',$email)->first();
        
        if($user)
        {
            
            $new_password = $user->firstname.date('YMD');
            
            $user->password = $new_password;
            
            $user->save();
            
            $mail->forgotPassword($user->id, $new_password);
            
            return back()->withErrors('A new password has been sent to your email address.');
        
        } else{
            
            return back()->withErrors('Sorry! User could not be found in database.');
            
        }
        
        
        
        
    }
    
    
    public function signup()
    {
        
        return view('public.pages.signup');
        
    }
    
    
    public function postSignup(signupRequest $request)
    {
        
        $user_data = $request->all();
        
        //$user_data['active'] = 1;   // active
        //$user_data['active'] = 2;   // inactive
        //$user_data['active'] = 3;   // waiting for review
        
        $user_data['role'] = 3;     // client 
        //$user_data['role'] = 3;     // employee
        
        $user_data['name'] = $request->input('firstname').' '.$request->input('lastname');
        
        if($user = \App\User::create($user_data))
        {
            
            if($user_data['active'] == 1)
            {
                
                return redirect(route('login'))->withErrors('Congrates! Signup has been sucessful. Please login.');
                
            } elseif($user_data['active'] == 3)
            {
                
                return back()->withErrors('Thank you for signing up. Please wait for your request to be reviewed.');
                
            }
            
        } else{
            
            return back()->withErrors('Failed to signup. Please check the required data.')->withInput();
            
        }
        
        
    }
    
    
    public function internalLogin($user, $navrole)
    {
        
        Auth::login($user);
        
        if(auth()->user())
        {
            
            $leftnav_parent    = $navrole->auth()->parent()->leftnav()->active()->get();
            $leftnav_child     = $navrole->auth()->child()->leftnav()->active()->get();
            
            $topnav_parent    = $navrole->public()->parent()->topnav()->active()->get();
            $topnav_child     = $navrole->public()->child()->topnav()->active()->get();
            
            session(['leftnav_parent'=>$leftnav_parent, 'leftnav_child'=>$leftnav_child]);
            session(['topnav_parent'=>$topnav_parent, 'topnav_child'=>$topnav_child]);
            
            return redirect()->route('dashboard');
            
        } else{
            
            return redirect(route('login'))->withErrors('authentication failed')->withInput();
            
        }
        
    }
    
    
    public function internalSignup($data, $navrole)
    {
        
        $user = \App\User::create($data);
        
        return $this->internalLogin($user, $navrole);
        
    }
    
    
    public function social($social, Request $request, NavRole $navrole)
    {
        
        // example of $social = facebook, google, twitter... all stored at socials table at DB
        
        if($request->has('code'))
        {
            
            $user = Socialite::driver($social)->user();
            
            $existing_user = \App\User::where('email', $user->email)->first();
            
            if(count($existing_user) > 0)
            {
                
                return $this->internalLogin($existing_user, $navrole);
                
            } else{
                
                $name = ($user->name) ? explode(' ',$user->name) : ['',''];
                
                $lastname = array_pop($name);
                
                $firstname = implode($name,' ');
                
                $signup_data = [
                    'firstname' => $firstname,
                    'lastname'  => $lastname,
                    'name'      => ($user->name) ? $user->name : "_",
                    'email'     => $user->email,
                    'contact'   => '',
                    'password'  => bcrypt(round(rand(10000, 50000))),
                    'role'      => 3,
                    'social_id' => (\App\Social::where('name', $social)->first()) ? \App\Social::where('name', $social)->first()->id : 1,
                ];
                
                return $this->internalSignup($signup_data, $navrole);
                
            }
            
            
        }
        
        return Socialite::driver($social)->redirect();
        
    }
 
    
}
