<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    protected $table = "sliders";
    
    protected $fillable = ['id', 'name', 'note', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    public function slides()
    {
        
        return $this->hasMany('\App\Slide');
        
    }
    
    

}

        