<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogvote extends Model
{

    protected $table = "blogvotes";
    
    protected $fillable = ['id', 'name', 'blog_id', 'user_id', 'created_at', 'updated_at'];
    
    public function blog()
    {
        
        return $this->belongsTo('\App\Blog');
        
    }
            
    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
    }
            
    public static function boot()
    {
        
        parent::boot();
        
        static::creating(function($model)
        {
            if(auth()->user())
            {
                
                $model->user_id = auth()->user()->id;
                
            }
            
        });
        
    }
    

}

        