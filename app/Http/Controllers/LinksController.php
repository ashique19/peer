<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Repository\CartRepository;
use Illuminate\Http\Request;
use App\Role;
use Carbon\Carbon;

use App\Http\Requests;
use App\Http\Requests\CreateRole;
use App\Http\Controllers\Controller;


class LinksController extends Controller
{
    private $CartRepository;

    public function __construct(CartRepository $CartRepository ) {
        $this->CartRepository = $CartRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $linkData = $this->CartRepository->incompleteCartData();

        return view('admin.links.index', ['productLink' => $linkData]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        return view('admin.roles.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateRole $request)
    {
        
        Role::create($request->all());
        
        return redirect(action('Roles@index'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
        return view('admin.roles.show', ['role'=>Role::find($id)]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('admin.links.edit', ['link' => Cart::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        if(Cart::find($id)->update($request->all()))
        {
        
            return back()->withErrors('success');
        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
         
        if(Cart::find($request->id)->delete())
        {
            
            return redirect()->back()->withErrors('Success');
            
        } else{
            
            return redirect()->back()->withErrors('Failed to delete the cart');
            
        }
    }
    
    
    public function navs($id)
    {
        
        $all_navs = \App\Nav::all();
        
        $permitted_navs = Role::find($id)->navs()->lists('nav_id')->toArray();
        
        return view('admin.roles.navs',[ 'role'=> $id, 'navs'=> $all_navs, 'permitted_navs'=> $permitted_navs ]);
            
    }
    
    
    
    public function postNavs(Request $request)
    {

        Role::find($request->role_id)->navs()->detach();
        
        Role::find($request->role_id)->navs()->attach($request->permissions);

        return back()->withErrors('Request processed successfully');
        
    }
    
    
    public function permissions($id)
    {
        
        $all_actions = \App\Permission::all();
        
        $permitted_actions = Role::find($id)->permissions()->lists('permission_id')->toArray();
        
        return view('admin.roles.permissions',[ 'role'=> $id, 'actions'=> $all_actions, 'permitted_actions'=> $permitted_actions ]);
            
    }
    
    
    
    public function postPermissions(Request $request)
    {
        
        Role::find($request->role_id)->permissions()->detach();
        
        Role::find($request->role_id)->permissions()->attach($request->permissions);

        return back()->withErrors('Request processed successfully');
        
    }
    
    
}
