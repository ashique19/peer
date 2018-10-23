<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite_traveller extends Model
{

    protected $table = "favorite_travellers";
    
    protected $fillable = ['id', 'user_id', 'travel_id', 'traveller_id', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    
    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
    }
            
    public function travel()
    {
        
        return $this->belongsTo('\App\Travel', 'travel_id');
        
    }
            
    public function traveller()
    {
        
        return $this->belongsTo('\App\User', 'traveller_id');
        
    }
            
    
    

}

        