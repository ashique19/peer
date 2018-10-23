<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;

use App\Http\Controllers\Controller;
use App\User;
use Response;
use Storage;
use Excel;


class Users extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return view( 'admin.users.index', [ 'users' => User::paginate(20) ]);
        
    }
    
    
    /**
     * Display a listing of the Buyers and Travelers (Role = 3).
     *
     * @return Response
     */
    public function buyersTravelers()
    {

        return view( 'admin.users.buyers-travelers', [ 'users' => User::buyerTraveler()->latest()->paginate(20) ]);
        
    }
    
    
    /**
     * Display a listing of the Buyers and Travelers (Role = 3).
     *
     * @return Response
     */
    public function viewAdmins()
    {

        return view( 'admin.users.admin-list', [ 'users' => User::admins()->latest()->paginate(20) ]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        return view('admin.users.create');
    
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createBuyersTravelers()
    {
        
        return view('admin.users.create-buyer-traveler');
    
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createAdmins()
    {
        
        return view('admin.users.create-admins');
    
    }
    
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {
        
        if($request->hasFile('picture'))
        {
            if($request->file('picture')->isValid())
            {

                $photo  = date('Ymdhis').'.'.$request->file('picture')->getClientOriginalExtension();
                
                if($request->file('picture')->move(public_path().'/img/users/', $photo))
                {
                    
                    $request['user_photo'] = '/public/img/users/'.$photo;
                    
                }
                
            }
                        
        }

        $request['name'] = $request->input('firstname')." ".$request->input('lastname');
        
        if(User::create($request->all()))
        {
            
            return redirect(action('Users@index'));
            
        } else
        {
            
            return back()->withErrors('Failed to process request.')->withInput();
            
        }
        
    
    }
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
        return view('admin.users.show', ['user'=>User::find($id)]);
        
    }
    
    
    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        
        return view('admin.users.edit', ['user'=>User::find($id) , 'roles'=> \App\Role::lists('name','id') ]);
        
    }
    
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        
        if( 
            
            User::where( ['id' => $id, 'email' => $request->email] )->count() == 1
            
            ||
            
            User::where( 'id', '!=', $id )->where( 'email', $request->email )->count() == 0
        
        )
        {
            
            
            if(!$request->input('password')) unset($request['password']);
            
            $request['name'] = $request->input('firstname')." ".$request->input('lastname');
            
            if($request->hasFile('picture'))
            {
                if($request->file('picture')->isValid())
                {
    
                    if(Storage::has(User::find($id)->user_photo))
                    {
                        
                        Storage::delete(User::find($id)->user_photo);
                        
                    }
                    
                    $photo  = date('Ymdhis').'.'.$request->file('picture')->getClientOriginalExtension();
                    
                    if($request->file('picture')->move(public_path().'/img/users/', $photo))
                    {
                        
                        $request['user_photo'] = '/public/img/users/'.$photo;
                        
                    }
                    
                }
                            
            }
            
            if(User::find($id)->update($request->all()))
            {
            
                return back()->withErrors('Request processed successfully');
            
            } else{
                
                return back()->withErrors('Failed to update record. Please retry.');
                
            }
            
        } else{
            
            return back()->withErrors('Email address is already in use. Please try another one.');
            
        }
        
        
    }
    
    
    
    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        
        /**
        *
        *
        *   If User is found, remove it.
        * 
        * 
        */
         
        if(User::find($request->id)->delete())
        {
            
            return back()->withErrors('Success');
            
        } else{
            
            return back()->withErrors('Failed to delete the user');
            
        }
        
        
        
    }
    
    
    public function postSearch(Request $request)
    {
        
        $users = new User;
        
        (strlen($request->input('name')) > 0) ? $users = $users->where('name', 'like', '%'.$request->input('name').'%') : false;
        (strlen($request->input('email')) > 0) ? $users = $users->where('email', 'like', '%'.$request->input('email').'%') : false;
        (strlen($request->input('phone')) > 0) ? $users = $users->where('contact', 'like', '%'.$request->input('phone').'%') : false;
        (strlen($request->input('address')) > 0) ? $users = $users->where('address', 'like', '%'.$request->input('address').'%') : false;
        (strlen($request->input('role')) > 0) ? $users = $users->where('role', $request->input('role')) : false;
        (strlen($request->input('country_id')) > 0) ? $users = $users->where('country_id', $request->input('country_id')) : false;
        (strlen($request->input('active')) > 0) ? $users = $users->where('active', $request->input('active')) : false;
        
        $users = $users->latest()->paginate(20);
        
        return view( 'admin.users.index', compact('users') );
    }
    
    
    public function ajaxSearch($param)
    {
        
        return \App\User::where('name', 'like', '%'.$param.'%')->orWhere('email', 'like', '%'.$param.'%')->select('id', 'name as text')->take(20)->get()->toArray();
        
    }
    
    
    public function getExport()
    {
        
        return view('admin.users.export');
        
    }
    
    
    public function postExport(Request $request, User $users)
    {

        $users = $users->where('role', 3);
        
        ( strlen(trim( $request->input('joined_after') )) > 0 ) ? $users = $users->where('users.created_at', '>', trim($request->input('joined_after')).' 00:00:00') : false;
        ( strlen(trim( $request->input('joined_before') )) > 0 ) ? $users = $users->where('users.created_at', '<', trim($request->input('joined_before')).' 23:59:59') : false;
        $format = ( $request->has('format') ) ? $request->input('format') : 'csv' ;
        
        $users = $users ->select('email')
                        ->take(10000)
                        ->get();
                        
        
        return Excel::create('buyers_travelers', function($excel) use($users) {
            
            // Set the title
            $excel->setTitle('Airposted Buyers and Travelers');
        
            // Chain the setters
            $excel->setCreator('Airposted')
                  ->setCompany('Airposted');
        
            // Call them separately
            $excel->setDescription('Users data of Airposted users');
            
            $excel->sheet('user_data', function($sheet) use($users) {
                
                $sheet  ->fromArray($users)
                        ->setFreeze('A2')
                        ->setAutoFilter();
                
            });
            
        })->download( $format );
        
    }

    public function emailDuplicateCheck(Request $request)
    {
        $isUserExist = User::where( ['email' => $request->email] )->count();

        return Response::json([
            'data' => $isUserExist,
            'status'=> ($isUserExist) ? 200 : 204,
            'message' => ($isUserExist) ? 'Email already exist' : 'not found'
        ]);
    }
}
