<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $table = "countries";
    
    protected $fillable = ['id', 'code', 'name', 'lat', 'lon', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
        
    public function airports()
    {
        
        return $this->hasMany('\App\Airport');
        
    }
        
    
    public function cities()
    {
        
        return $this->hasMany('\App\City');
        
    }
    

}

        