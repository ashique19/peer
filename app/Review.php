<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $table = "reviews";
    
    protected $fillable = ['id', 'comment', 'rating', 'traveller_id', 'rate_by', 'created_at', 'updated_at'];
    
    
    public function user()
    {
        
        return $this->belongsTo('\App\User', 'traveller_id');
        
    }
    
    public function by()
    {
        
        return $this->belongsTo('\App\User', 'rate_by');
        
    }
            
    

}

        