<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\blogcategoriesStoreRequest;
use App\Http\Controllers\Controller;
use App\Blogcategory;

class Blogcategories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.blogcategories.index', ['blogcategories'=> Blogcategory::latest()->paginate(20)]);
        
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
        
        $result =   new Blogcategory;
          
                    ($request->input('from'))  ? $result = $result->where('created_at', '>', $request->input('from').' 00:00:00') : false;
                    ($request->input('to'))    ? $result = $result->where('created_at', '<', $request->input('to').' 23:59:59') : false;
    
					($request->input('id'))   ? $result = $result->where('id', $request->input('id')) : false;
					($request->input('name'))   ? $result = $result->where('name', 'like', '%'.$request->input('name').'%') : false;
					($request->input('link'))   ? $result = $result->where('link', 'like', '%'.$request->input('link').'%') : false;
					($request->input('banner_photo'))   ? $result = $result->where('banner_photo', 'like', '%'.$request->input('banner_photo').'%') : false;
        
        return view('admin.blogcategories.index', ['blogcategories'=> $result->latest()->paginate(20)]);
        
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.blogcategories.create'  );
        
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(blogcategoriesStoreRequest $request)
    {
        
        
        if($request->hasFile('banner_photos'))
        {
            if($request->file('banner_photos')->isValid())
            {
                
                
                /**
                 * SimpleImage can't make dir. It returns error if directory does not exist.
                 * Make directory (if it dows not exists) before putting file in it
                 */
                $location   = public_path().'/img/banner/';
                if(!is_dir($location))
                {
                    
                    mkdir($location, 0777, true);
                                    
                }
                
                
                /**
                *
                * Prepare names for file at different sizes
                * 
                */
                $image_lg  = date('Ymdhis').'_lg.'.$request->file('banner_photos')->getClientOriginalExtension();
                $image_md  = date('Ymdhis').'_md.'.$request->file('banner_photos')->getClientOriginalExtension();
                $image_sm  = date('Ymdhis').'_sm.'.$request->file('banner_photos')->getClientOriginalExtension();
                $image_xs  = date('Ymdhis').'_xs.'.$request->file('banner_photos')->getClientOriginalExtension();
                
                // Instantiate SimpleImage class
                $image = new \App\Http\Controllers\SimpleImage($request->file('banner_photos'));
                
                
                // Size:lg
                $image->best_fit(1200,600);
                $image->save($location.$image_lg);
                
                // Size:md
                $image->best_fit(640,400);
                $image->save($location.$image_md);
                
                // Size:sm
                $image->best_fit(320,225);
                $image->save($location.$image_sm);
                
                // Size:xs
                $image->best_fit(100,75);
                $image->save($location.$image_xs);
                
                $request['banner_photo'] = '/public/img/banner/'.$image_lg;
                
            }
                        
        }
                
        
        $save_success = Blogcategory::create($request->all());
        
        if($save_success){
        
            return redirect()->action('Blogcategories@index')->withErrors('Data has been stored successfully.');
        
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
    
        $blogcategory = Blogcategory::find($id); 
        
        return view('admin.blogcategories.show', compact('blogcategory') );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $blogcategory = Blogcategory::find($id); 
        
        return view('admin.blogcategories.edit', compact('blogcategory') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(blogcategoriesStoreRequest $request, $id)
    {
        $blogcategory = Blogcategory::find($id);
        
        
        if($request->has('banner_photo_delete'))
        {
            
            if($blogcategory->banner_photo)
            {
                
                $image_to_delete_lg = $blogcategory->banner_photo;
                $image_to_delete_md = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'md'.substr($image_to_delete_lg, -4);
                $image_to_delete_sm = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'sm'.substr($image_to_delete_lg, -4);
                $image_to_delete_xs = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'xs'.substr($image_to_delete_lg, -4);
                
                if(\Storage::has($image_to_delete_lg))
                {
                    
                    \Storage::delete($image_to_delete_lg);
                    
                }
                
                if(\Storage::has($image_to_delete_md))
                {
                    
                    \Storage::delete($image_to_delete_md);
                    
                }
                
                if(\Storage::has($image_to_delete_sm))
                {
                    
                    \Storage::delete($image_to_delete_sm);
                    
                }
                
                if(\Storage::has($image_to_delete_xs))
                {
                    
                    \Storage::delete($image_to_delete_xs);
                    
                }
                
            }
            
        }
        
        
        if($request->hasFile('banner_photos'))
        {
            if($request->file('banner_photos')->isValid())
            {
                
                /**
                *
                * At first, remove previous items, if they exist
                * 
                */
                if($blogcategory->banner_photo)
                {
                    
                    $image_to_delete_lg = $blogcategory->banner_photo;
                    $image_to_delete_md = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'md'.substr($image_to_delete_lg, -4);
                    $image_to_delete_sm = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'sm'.substr($image_to_delete_lg, -4);
                    $image_to_delete_xs = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'xs'.substr($image_to_delete_lg, -4);
                    
                    if(\Storage::has($image_to_delete_lg))
                    {
                        
                        \Storage::delete($image_to_delete_lg);
                        
                    }
                    
                    if(\Storage::has($image_to_delete_md))
                    {
                        
                        \Storage::delete($image_to_delete_md);
                        
                    }
                    
                    if(\Storage::has($image_to_delete_sm))
                    {
                        
                        \Storage::delete($image_to_delete_sm);
                        
                    }
                    
                    if(\Storage::has($image_to_delete_xs))
                    {
                        
                        \Storage::delete($image_to_delete_xs);
                        
                    }
                    
                }
                
                /**
                 * SimpleImage can't make dir. It returns error if directory does not exist.
                 * Make directory (if it dows not exists) before putting file in it
                 */
                $location   = public_path().'/img/banner/';
                if(!is_dir($location))
                {
                    
                    mkdir($location, 0777, true);
                                    
                }
                
                
                /**
                *
                * Prepare names for file at different sizes
                * 
                */
                $image_lg  = date('Ymdhis').'_lg.'.$request->file('banner_photos')->getClientOriginalExtension();
                $image_md  = date('Ymdhis').'_md.'.$request->file('banner_photos')->getClientOriginalExtension();
                $image_sm  = date('Ymdhis').'_sm.'.$request->file('banner_photos')->getClientOriginalExtension();
                $image_xs  = date('Ymdhis').'_xs.'.$request->file('banner_photos')->getClientOriginalExtension();
                
                // Instantiate SimpleImage class
                $image = new \App\Http\Controllers\SimpleImage($request->file('banner_photos'));
                
                
                // Size:lg
                $image->best_fit(1200,600);
                $image->save($location.$image_lg);
                
                // Size:md
                $image->best_fit(640,400);
                $image->save($location.$image_md);
                
                // Size:sm
                $image->best_fit(320,225);
                $image->save($location.$image_sm);
                
                // Size:xs
                $image->best_fit(100,75);
                $image->save($location.$image_xs);
                
                $request['banner_photo'] = '/public/img/banner/'.$image_lg;
                
            }
                        
        }
        
        $save_success = Blogcategory::find($id)->update($request->all());
        
        if($save_success)
        {
            return redirect()->action('Blogcategories@index')->withErrors('Data has been updated successfully.');
        
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
        
        $blogcategory = Blogcategory::find($id);
        
        if($blogcategory)
        {
    
            if($blogcategory->banner_photo)
            {
                $image_to_delete_lg = $blogcategory->banner_photo;
                $image_to_delete_md = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'md'.substr($image_to_delete_lg, -4);
                $image_to_delete_sm = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'sm'.substr($image_to_delete_lg, -4);
                $image_to_delete_xs = substr($image_to_delete_lg, 0, strlen($image_to_delete_lg)-6).'xs'.substr($image_to_delete_lg, -4);
                
                if(\Storage::has($image_to_delete_lg))
                {
                    
                    \Storage::delete($image_to_delete_lg);
                    
                }
                
                if(\Storage::has($image_to_delete_md))
                {
                    
                    \Storage::delete($image_to_delete_md);
                    
                }
                
                if(\Storage::has($image_to_delete_sm))
                {
                    
                    \Storage::delete($image_to_delete_sm);
                    
                }
                
                if(\Storage::has($image_to_delete_xs))
                {
                    
                    \Storage::delete($image_to_delete_xs);
                    
                }
                
            }
        
                    
    
            if($blogcategory->delete())
            {
            
                return redirect()->action('Blogcategories@index')->withErrors('Data has been deleted successfully.');
            
            } else{
                
                return back()->withErrors('Failed to delete data. Please retry later.');
                
            }
        
        } else{
            
            return back()->withErrors('Failed to delete data. Please retry later.');
            
        }
        
        
    }
    
    
    public function blogs($id)
    {
        
        $category   = \App\Blogcategory::find($id);
        
        $blogs      = ($category) ? $category->blogs()->paginate(20) : [];
        
        return view('admin.blogcategories.blogs', compact('category','blogs'));
        
    }
    
    
    
    
}

        