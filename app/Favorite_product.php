<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite_product extends Model
{

    protected $table = "favorite_products";
    
    protected $fillable = ['id', 'name', 'amazon_url', 'image_url', 'price', 'user_id', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
    }
            
    
    

}

        