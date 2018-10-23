<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $table = "cities";
    
    protected $fillable = ['id', 'name', 'country_id', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    public function country()
    {
        
        return $this->belongsTo('\App\Country');
        
    }
            
    
    

}

        