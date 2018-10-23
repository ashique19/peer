<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite_buyer extends Model
{

    protected $table = "favorite_buyers";
    
    protected $fillable = ['id', 'user_id', 'buyer_id', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
    }
            
    public function buyer()
    {
        
        return $this->belongsTo('\App\Buyer');
        
    }
            
    
    

}

        