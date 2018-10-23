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
use Geo;
use Validator;

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
        
        $user   = \App\User::where('email', $request->input('email'))->first();
        
        if($user)
        {
            
            if($user->active != 1)
            {
                return back()->withErrors('Your account is not active. Please contact admin for help.');
            }
            
        }
        
        
        
        if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]))
        {
            
            $geo_city = Geo::getCity() ?: "";
            
            $geo_state = Geo::getRegion() ?: "";
            
            $geo_postcode = Geo::getPostalCode() ?: "";
            
            $user->city = ( strlen($user->city) == 0 ) ? $geo_city : $user->city;
            
            $user->state = ( strlen($user->state) == 0 ) ? $geo_state : $user->state;
            
            $user->postcode = ( strlen($user->postcode) == 0 ) ? $geo_postcode : $user->postcode;
            
            $user->country_id = ( strlen($user->country_id) == null && \App\Country::where('code', 'like', Geo::getCountryCode() )->count() > 0) ? \App\Country::where('code', 'like', Geo::getCountryCode() )->first()->id : null;
            
            $user->save();
            
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
            
            return redirect()->route('login')->withErrors('authentication failed')->withInput();
            
        }
        
    }
    
    
    public function postAjaxLogin(Request $request, NavRole $navrole)
    {
        
        $user   = \App\User::where('email', $request->input('email'))->first();
        
        if($user)
        {
            
            if($user->active != 1)
            {
                return [
                            'result'=> 'failed',
                            'message' => 'Your account is not active. Please contact admin for help.',
                            'url' => ''
                    ];
            }
            
        }
        
        
        
        if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')]))
        {
            
            $geo_city = Geo::getCity() ?: "";
            
            $geo_state = Geo::getRegion() ?: "";
            
            $geo_postcode = Geo::getPostalCode() ?: "";
            
            $user->city = ( strlen($user->city) == 0 ) ? $geo_city : $user->city;
            
            $user->state = ( strlen($user->state) == 0 ) ? $geo_state : $user->state;
            
            $user->postcode = ( strlen($user->postcode) == 0 ) ? $geo_postcode : $user->postcode;
            
            if( Geo::getCountryCode() )
            {
            
                $user->country_id = ( ! $user->country_id ) ? \App\Country::where('code', 'like', Geo::getCountryCode() )->first()->id : $user->country_id;
            
            }
            
            $user->save();
            
            $leftnav_parent = $navrole->auth()->parent()->leftnav()->active()->get();
            $leftnav_child  = $navrole->auth()->child()->leftnav()->active()->get();
            
            $topnav_parent  = $navrole->public()->parent()->topnav()->active()->get();
            $topnav_child   = $navrole->public()->child()->topnav()->active()->get();
            
            $permissions    = auth()->user()->roles()->first()->permissions()->lists('permissions.name','permissions.id');
            
            session(['leftnav_parent'=>$leftnav_parent, 'leftnav_child'=>$leftnav_child]);
            session(['topnav_parent'=>$topnav_parent, 'topnav_child'=>$topnav_child]);
            session(['permissions' => $permissions]);
            $data['name'] = Auth::user()->name;
            $data['id'] = Auth::id();

            return [
                            'result'=> 'success',
                            'data' => $data,
                            'status'=> 200,
                            'message' => 'Success. Redirecting you to Dashboard.',
                            'url'   => route('dashboard')
                    ];
            
            // return redirect()->route('dashboard');
            
        } else{
            
            return [
                            'result'=> 'failed',
                            'message' => 'Authentication failed. Please check your credntials and retry.',
                            'url' => ''
                    ];
            
        }
        
    }
    
    
    public function logout()
    {
    
        Auth::logout();
        
        session()->forget('user_type');
        
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
            
            $new_password = str_random(20);
            
            $user->password = $new_password;
            
            $user->save();
            
            $mail->forgotPassword($user->id, $new_password);
            
            return redirect()->route('login')->withErrors('A new password has been sent to your email address.');
        
        } else{
            
            return redirect()->route('login')->withErrors('Sorry! User could not be found in database.');
            
        }
        
        
        
        
    }
    
    
    public function signup()
    {
        
        return view('public.pages.signup');
        
    }
    
    
    public function postSignup(Request $request, \App\Http\Controllers\Mails $mails)
    {
        
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email|unique:users',
            'firstname' => 'required',
            'lastname'  => 'required',
            'password'  => 'required|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9]).*$/|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->route('signup')
                        ->withErrors($validator)
                        ->withInput();
        }

        
        $user_data = $request->all();
        
        $user_data['active'] = 1;   // active
        //$user_data['active'] = 2;   // inactive
        //$user_data['active'] = 3;   // waiting for review
        
        $user_data['role'] = 3;     // client 
        //$user_data['role'] = 3;     // employee
        
        $user_data['name'] = $request->input('firstname').' '.$request->input('lastname');
        
        
        // GEO
                
        $geo_city = Geo::getCity() ?: "";
    
        $geo_state = Geo::getRegion() ?: "";
        
        $geo_postcode = Geo::getPostalCode() ?: "";
        
        $user_data['city']      = $geo_city;
        $user_data['state']     = $geo_state;
        $user_data['postcode']  = $geo_postcode;
        $user_data['country_id']= null;
        
        if( Geo::getCountryCode() )
        {
            
            $user_data['country_id']= ( \App\Country::where('code', 'like', Geo::getCountryCode() )->count() > 0) ? \App\Country::where('code', 'like', Geo::getCountryCode() )->first()->id : null;
        
        }

        $user = \App\User::create($user_data);
        
        if($user)
        {
            
            $mails->signup($user->id);
            
            if($user_data['active'] == 1)
            {
                return redirect()->route('login')->withErrors('Congrats! Sign up has been successful. Please login.');

            } elseif($user_data['active'] == 3)
            {
                
                return redirect()->route('login')->withErrors('Thank you for signing up. Please wait for your request to be reviewed.');
                
            }
            
        } else{
            
            return redirect()->route('signup')->withErrors('Failed to sign up. Please check the required data.')->withInput();
            
        }
        
        
    }
    
    
    public function postAjaxSignup(Request $request, \App\Http\Controllers\Mails $mails)
    {
        $message = [];
        if( ! (bool) preg_match('([a-zA-Z].*[@].*[a-zA-Z].*[.].*[a-zA-Z])', $request->input('email') ) )
        {
            $message[] = "Email address does not seem to valid.";
        }
        if( ! (bool) preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $request->input('password') )  || ! strlen($request->input('password')) > 7)
        {
            $message[] = "Password must be Alphanumeric and at least 8 characters long.";
        }
        if( strlen( $request->input('name') ) < 1 )
        {
            $message[] = "Name is required.";
        }
        if( \App\User::where('email', 'like', $request->input('email'))->count() > 0 )
        {
            $message[] = "This email address is already registered.";
        }
        if( count( $message ) > 0 )
        {
            return [
                    'status' => 'failed',
                    'message' => $message
                ];
        }
        $user_data = $request->all();
        $user_data['active'] = 1;   // active
        //$user_data['active'] = 2;   // inactive
        //$user_data['active'] = 3;   // waiting for review
        
        $user_data['role'] = 3;     // client 
        //$user_data['role'] = 3;     // employee
        $user_data['name'] = $request->input('name');
        // GEO
                
        $geo_city = Geo::getCity() ?: "";
    
        $geo_state = Geo::getRegion() ?: "";
        
        $geo_postcode = Geo::getPostalCode() ?: "";
        
        $user_data['city']      = $geo_city;
        $user_data['state']     = $geo_state;
        $user_data['postcode']  = $geo_postcode;
        $user_data['country_id']= null;
        
        if( Geo::getCountryCode() )
        {
            
            $user_data['country_id']= ( \App\Country::where('code', 'like', Geo::getCountryCode() )->count() > 0) ? \App\Country::where('code', 'like', Geo::getCountryCode() )->first()->id : null;
        
        }
        if($request->is('api/*')) {
            $token = md5($request->input('email').'API_TOKEN!@#$'.time());
            $user_data['api_token'] = $token;
        }
        $user = \App\User::create($user_data);
        
        if($user)
        {
//            $mails->signup($user->id);
            if($user_data['active'] == 1)
            {
                \Session::flash('success', 'Sign up has been successful.');

//                session(['success'=> 'Sign up has been successful.']);
                return [
                        'status' => 'success',
                        'message' => 'Sign up has been successful. Redirecting you to login page.',
                        'url' => route('login')
                    ];
                
                // return redirect()->route('login')->withErrors('Congrats! Sign up has been sucessful. Please login.');
                
                
            } elseif($user_data['active'] == 3)
            {
                
                return redirect()->route('login')->withErrors('Thank you for signing up. Please wait for your request to be reviewed.');
                
            }
            
        } else{
            
            return [
                        'status' => 'failed',
                        'message' => ['Failed to sign you up. Please retry.'],
                    ];
            
            // return redirect()->route('signup')->withErrors('Failed to sign up. Please check the required data.')->withInput();
            
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
            
            return redirect()->route('home');
            
        } else{
            
            return redirect()->route('login')->withErrors('authentication failed')->withInput();
            
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
            
            if( $user->email == null || strlen($user->email) < 5 || strlen($user->name) < 5 )
            {
                
                return redirect()->route('signup')->withErrors('Failed to retrieve enough data from Facebook to sign you up. Please fill in the form below to continue.');
                
            }
            
            $existing_user = \App\User::where('email', $user->email)->first();
            
            if(count($existing_user) > 0)
            {
                
                return $this->internalLogin($existing_user, $navrole);
                
            } else{
                
                $name = ($user->name) ? explode(' ',$user->name) : ['',''];
                
                $lastname = array_pop($name);
                
                $firstname = implode($name,' ');
                
                // GEO
                $geo_city = Geo::getCity() ?: "";
            
                $geo_state = Geo::getRegion() ?: "";
                
                $geo_postcode = Geo::getPostalCode() ?: "";
            
                
                $signup_data = [
                    'firstname' => $firstname,
                    'lastname'  => $lastname,
                    'name'      => ($user->name) ? $user->name : "_",
                    'email'     => $user->email,
                    'contact'   => '',
                    'password'  => bcrypt(round(rand(10000, 50000))),
                    'role'      => 3,
                    'city'      => $geo_city,
                    'state'     => $geo_state,
                    'postcode'  => $geo_postcode,
                    'country_id'=> ( \App\Country::where('code', 'like', Geo::getCountryCode() )->count() > 0) ? \App\Country::where('code', 'like', Geo::getCountryCode() )->first()->id : null,
                    'user_photo'=> ($social == 'facebook') ? $user->avatar_original : '',
                    'social_id' => (\App\Social::where('name', $social)->first()) ? \App\Social::where('name', $social)->first()->id : 1,
                ];
                
                return $this->internalSignup($signup_data, $navrole);
                
            }
            
            
        }
        
        return Socialite::driver($social)->redirect();
        
    }
    
    
    public function deactivateMyAccount(Request $request)
    {
        
        \App\User::find(auth()->user()->id)->update([ 'active'=>2, 'note'=> $request->input('note') ]);
        
        $this->logout();
        
        return redirect()->route('login')->withErrors('Your account has been marked for delete. We will review your request according to our schedule.');
        
    }
 
    
}
