<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = "categories";
    
    protected $fillable = ['id', 'name', 'search_index', 'is_active', 'is_at_homepage', 'amazon_node', 'category_photo', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    
    public function scopeActive($query)
    {
        
        return $query->where('is_active', 1);
        
    }
    
    
    public function scopeHomepage($query)
    {
        
        return $query->where('is_at_homepage', 1);
        
    }
    
    

}

        