<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\chatsStoreRequest;
use App\Http\Controllers\Controller;
use App\Chat;

class Chats extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.chats.index', ['chats'=> Chat::latest()->paginate(20)]);
        
    }
    
    
    /**
     * Searches the listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchIndex(Request $request)
    {
    
        $search = array_filter($request->all());
        unset($search['_token']);
        
        $result =   new Chat;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('chat_image'))   ? $result = $result->where('chat_image', 'like', '%'.$request->input('chat_image').'%') : false;
					($request->input('message_from'))   ? $result = $result->where('message_from', 'like', '%'.$request->input('message_from').'%') : false;
					($request->input('message_to'))   ? $result = $result->where('message_to', 'like', '%'.$request->input('message_to').'%') : false;
					($request->input('is_read_by_from'))   ? $result = $result->where('is_read_by_from', 'like', '%'.$request->input('is_read_by_from').'%') : false;
					($request->input('is_read_by_to'))   ? $result = $result->where('is_read_by_to', 'like', '%'.$request->input('is_read_by_to').'%') : false;
        
        return view('admin.chats.index', ['chats'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.chats.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(chatsStoreRequest $request)
    {
        
        
        
        $save_success = Chat::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Chats@index')->withErrors('Data has been stored successfully.');
        
        } else{
            
            return back()->withInput()->withErrors('Failed to store data. Please check data and retry.');
            
        }
    
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
        $chat = Chat::find($id); 
        
        return view('admin.chats.show', compact('chat') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $chat = Chat::find($id); 
        
        return view('admin.chats.edit', compact('chat') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(chatsStoreRequest $request, $id)
    {
        $chat = Chat::find($id);
        
        
        $save_success = Chat::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Chats@index')->withErrors('Data has been updated successfully.');
        
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
        
        $chat = Chat::find($id);
        
        if($chat)
        {
    
    
            if($chat->delete())
            {
            
                return redirect()->action('Chats@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    
    
}

        