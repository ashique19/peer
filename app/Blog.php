<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Blog extends Model
{
    
    use SearchableTrait;

    protected $table = "blogs";
    
    protected $fillable = ['id', 'name', 'link', 'banner_photo','short_description', 'details', 'created_by', 'updated_by', 'status', 'is_popular', 'views', 'created_at', 'updated_at'];
    
    
    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'blogs.name' => 10,
            'blogs.details' => 10,
        ]
    ];
    
    
    public function comments()
    {
        
        return $this->hasMany('\App\Comment');
        
    }
    
    
    public function tags()
    {
        
        return $this->belongsToMany('\App\Blogtag', 'blog_blogtag', 'blog_id');
        
    }
    
    
    public function categories()
    {
        
        return $this->belongsToMany('\App\Blogcategory');
        
    }
    
    
    public function relatedBlogs()
    {
        
        return $this->belongsToMany('\App\Blog', 'relatedblogs', 'blog_id', 'related_blog_id');
        
    }
    
    
    public function createdBy()
    {
        
        return $this->belongsTo('\App\User', 'created_by', 'id');
        
    }
    
    
    public function updatedBy()
    {
        
        return $this->belongsTo('\App\User', 'updated_by', 'id');
        
    }
    
    
    public function votes()
    {
        
        return $this->hasMany('\App\Blogvote');
        
    }
    
    
    public function scopeDraft($query)
    {
        
        return $query->where('status', 0);
        
    }
    
    
    public function scopeWaitingForReview($query)
    {
        
        return $query->where('status', 1);
        
    }
    
    
    public function scopePublished($query)
    {
        
        return $query->where('status', 2);
        
    }
    
    
    public function scopeTrashed($query)
    {
        
        return $query->where('status', 3);
        
    }
    
    
    public function scopePopular($query)
    {
        
        return $query->where('is_popular', 1);
        
    }
    
    
    public function scopeMyBlogs($query)
    {
        
        return $query->where('created_by', auth()->user()->id);
        
    }
    
    
    public static function boot()
    {
        
        parent::boot();
        
        static::creating(function($model)
        {
            
            /**
             * 
             * Adding loggedin user as the creator and updater of the blog
             * 
             */
            if(auth()->user())
            {
                
                $model->created_by = auth()->user()->id;
                
                $model->updated_by = auth()->user()->id;
                
            }
            
            /**
             * 
             * Prepare unique link for the blog
             * 
             */
            $blog = new self();
            
            $link = str_slug($model->name);
            
            $model->link = $blog->where('link', 'like', $link)->first() ? $link.'-'.($blog->where('link', 'like', $link.'%')->count()+1) : $link;
            
        });
        
        static::updating(function($model)
        {
            
            /**
             * 
             * Adding loggedin user as the updater of the blog
             * 
             */
            if(auth()->user())
            {
                
                $model->updated_by = auth()->user()->id;
                
            }
            
        });
        
    }
    
    

}

        