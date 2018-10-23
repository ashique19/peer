<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\blogvotesStoreRequest;
use App\Http\Controllers\Controller;
use App\Blogvote;

class Blogvotes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.blogvotes.index', ['blogvotes'=> Blogvote::latest()->paginate(20)]);
        
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
        
        $result =   new Blogvote;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('blog_id'))   ? $result = $result->where('blog_id', $request->input('blog_id')) : false;
					($request->input('user_id'))   ? $result = $result->where('user_id', $request->input('user_id')) : false;
        
        return view('admin.blogvotes.index', ['blogvotes'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.blogvotes.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(blogvotesStoreRequest $request)
    {
        
        
        
        $save_success = Blogvote::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Blogvotes@index')->withErrors('Data has been stored successfully.');
        
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
    
        $blogvote = Blogvote::find($id); 
        
        return view('admin.blogvotes.show', compact('blogvote') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $blogvote = Blogvote::find($id); 
        
        return view('admin.blogvotes.edit', compact('blogvote') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(blogvotesStoreRequest $request, $id)
    {
        $blogvote = Blogvote::find($id);
        
        
        $save_success = Blogvote::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Blogvotes@index')->withErrors('Data has been updated successfully.');
        
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
        
        $blogvote = Blogvote::find($id);
        
        if($blogvote)
        {
    
    
            if($blogvote->delete())
            {
            
                return back()->withErrors('Rating has been deleted successfully.');
                return redirect()->action('Blogvotes@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    public function voteMe($blogID, $vote)
    {
        
        $blog = \App\Blog::find($blogID);
        
        if($blog){
        
            if(Blogvote::create([ 'name'=> $vote, 'blog_id'=> $blog->id]))
            {
                
                return back()->withErrors(['vote_success'=> 'Thank you for your vote.']);
                
            } else {
                
                return back()->withErrors('Failed to save your vote. Please refresh the page and retry later.');
                
            }
        
        } else {
            
            return back()->withErrors('Blog could not be found. Please refresh the page and retry.');
            
        }
        
    }
    
    
    
}

        