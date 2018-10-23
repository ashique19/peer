<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\blogStoreRequestFromUser;
use App\Http\Requests\blogCommentSaveFromPublic;
use App\Http\Controllers\Controller;
use Cache;

class BlogPublic extends Controller
{
    
    public function blogCategory($link, \App\Blog $blog, \App\Blogcategory $categories)
    {
        
        $category       = $categories->where('link', 'like', $link)->first();
        
        $category       = $category ?: $categories::find($link);
        
        $blogs          = ($category) ? $category->blogs()->published()->paginate(30) : [];
        
        $popular_blogs  = $blog->published()->popular()->latest()->get();
        
        $categories     = $categories->latest()->get();
        
        $tags           = \App\Blogtag::all();
        
        ( $category ) ? $category->increment('views') : false;
        
        return view('public.pages.blog.blog-categories', compact('category', 'blogs', 'popular_blogs', 'categories', 'tags') );
        
    }
    
    
    public function blogTag($link, \App\Blog $blog, \App\Blogcategory $categories, \App\Blogtag $tags)
    {
        
        $singleTag      = $tags->where('link', 'like', $link)->first();
        
        $blogs          = ($singleTag) ? $singleTag->blogs()->published()->paginate(20) : [];
        
        $popular_blogs  = $blog->published()->popular()->latest()->get();
        
        $categories     = $categories->latest()->get();
        
        $tags           = $tags->all();
        
        ( $singleTag ) ? $singleTag->increment('views') : false;
        
        return view('public.pages.blog.blog-tags', compact('singleTag', 'blogs', 'popular_blogs', 'categories', 'tags') );
        
    }
    
    
    public function blogs(\App\Blog $blog)
    {
        
        $blogs          = $blog->published()->latest()->paginate(20);
        
        $popular_blogs  = $blog->published()->popular()->latest()->get();
        
        $categories     = \App\Blogcategory::latest()->get();
        
        $tags           = \App\Blogtag::all();
        
        return view('public.pages.blog.blogs', compact('blogs', 'popular_blogs', 'categories', 'tags') );
        
    }
    
    
    public function singleBlog(\App\Blog $blog, $name)
    {
        
        $categories     = \App\Blogcategory::latest()->get();
        
        $blogPost       = $blog->where('link', 'like', $name)->published()->first();
        
        $similarBlogs   = ($blogPost) ? $blogPost->relatedBlogs : [];
        
        $comments       = ($blogPost) ? $blogPost->comments()->notReply()->published()->latest()->get() : [];
        
        ( $blogPost ) ? $blogPost->increment('views') : false ;
        
        $tags           = \App\Blogtag::all();
        
        return view('public.pages.blog.blog-post', compact('blogPost', 'similarBlogs', 'categories', 'comments', 'tags') );
        
    }
    
    
    public function storeComment(blogCommentSaveFromPublic $request, $id)
    {
        
        $blog = \App\Blog::find($id);
        
        if($request->has('comment_id') && !auth()->user())
        {
            
            return redirect()->route('login')->withErrors('Please login to Comment');
            
        }
        
        if($blog)
        {
            
            $comment = [
                'name'              => $request->input('name'),
                'user_id'           => (auth()->user()) ? auth()->user()->id : null,
                'blog_id'           => $blog->id,
                'is_published'      => 0,
                'is_reply'          => ($request->has('comment_id')) ? 1 : 0,
                'comment_id'        => ($request->has('comment_id')) ? \App\Comment::find($id)->id : null,
                'commenter_name'    => ($request->has('comment_id')) ? auth()->user()->name  : $request->input('commenter_name'),
                'commenter_email'   => ($request->has('comment_id')) ? auth()->user()->email : $request->input('commenter_email'),
                'rate'              => ($request->input('rate') < 1 || $request->input('rate') > 5 ) ? 3 : $request->input('rate')
            ];
            
            $saved = \App\Comment::create($comment);
            
            return back()->withErrors('Your comment has been saved and will be published after review.');
            
        }
        
        return back()->withErrors('Failed to save your comment. Please retry later');
        
        //return $blog;
        return $request->all();
        
    }
    
    
    public function blogCreateByUser()
    {
        
        return view('public.pages.blog.blog-create');
        
    }
    
    
    public function storeBlogCreateByUser(blogStoreRequestFromUser $request)
    {
        //return $request->all();
        
        $request['status']  = 1;
        
        if($request->hasFile('banner_photos'))
        {
            if($request->file('banner_photos')->isValid())
            {
                
                
                /**
                 * SimpleImage can't make dir. It returns error if directory does not exist.
                 * Make directory (if it dows not exists) before putting file in it
                 */
                $location   = public_path().'/img/blogs/';
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
                $image->best_fit(90,90);
                $image->save($location.$image_xs);
                
                $request['banner_photo'] = '/public/img/blogs/'.$image_xs;
                
            }
                        
        }
        
        $blog = \App\Blog::create($request->all());
        
        if($blog)
        {
            
            ($request->has('category_id')) ? \App\Blog::find($blog->id)->categories()->attach($request->category_id) : false;
            
            return back()->withErrors('Thank you for post. One admin will review your post soon.');
            
        } else{
            
            return back()->withErrors('Failed to save your post. Please retry later.')->withInput();
            
        }
        
    }
    
}
