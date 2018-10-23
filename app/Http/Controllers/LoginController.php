<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\NavRole;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Repository\CartRepository;
use Response;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    private $CartRepository;
 
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartRepository $CartRepository ){
        // $this->middleware('guest')->except('logout');
        $this->CartRepository = $CartRepository;
    } 

    public function login(Request $request, NavRole $navrole){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                
                $data['name'] = Auth::user()->name;
                $data['id'] = Auth::id();
                if($request->is('api/*')) {
                    $loggedInUser = Auth::User();
                    $token = md5($data['id'] . $data['name'].'API_TOKEN'.time());
                    $loggedInUser->api_token = $token;
                    $loggedInUser->save();
                    $data['token'] = $token;
                }
                if(Auth::check()){
                    \Session::put('cartCount', $this->CartRepository->cartCount());
                }

                $leftnav_parent = $navrole->auth()->parent()->leftnav()->active()->get();
                $leftnav_child  = $navrole->auth()->child()->leftnav()->active()->get();

                $topnav_parent  = $navrole->public()->parent()->topnav()->active()->get();
                $topnav_child   = $navrole->public()->child()->topnav()->active()->get();

                $permissions    = auth()->user()->roles()->first()->permissions()->lists('permissions.name','permissions.id');

                session(['leftnav_parent'=>$leftnav_parent, 'leftnav_child'=>$leftnav_child]);
                session(['topnav_parent'=>$topnav_parent, 'topnav_child'=>$topnav_child]);
                session(['permissions' => $permissions]);

                return Response::json([
                    'data' => $data,
                    'status'=>200, 
                    'message' => 'Login successful']);
            }

            return Response::json(['errors' => 'Username and password not matched']);
        }
        
        return Response::json(['errors' => $validator->errors()]);
    }

    
}
