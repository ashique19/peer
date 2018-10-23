<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogtag extends Model
{

    protected $table = "blogtags";
    
    protected $fillable = ['id', 'name', 'link', 'banner_photo', 'created_at', 'updated_at'];
    
    
    public function blogs()
    {
        
        return $this->belongsToMany('\App\Blog', 'blog_blogtag', 'blogtag_id', 'id');
        
    }
    
    public static function boot()
    {
        
        parent::boot();
        
        static::creating(function($model)
        {
            
            /**
             * 
             * Prepare unique link for the blog
             * 
             */
            $category = new self();
            
            $link = str_slug(strtolower($model->name));
            
            $model->link = ($category->where('link', 'like', $link)->count() > 0) ? $link."-".($category->where('link', 'like', $link.'%')->count()+1) : $link;
            
        });
        
    }

}

        