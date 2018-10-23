<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{

    protected $table = "airports";
    
    protected $fillable = ['id', 'name', 'country_id', 'created_at', 'updated_at'];
    
    public function country()
    {
        
        return $this->belongsTo('\App\Country');
        
    }
            
    
    

}

        