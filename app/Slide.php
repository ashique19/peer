<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{

    protected $table = "slides";
    
    protected $fillable = ['id', 'name', 'slide_photo', 'slider_id', 'order', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    public function slider()
    {
        
        return $this->belongsTo('\App\Slider');
        
    }
            
    
    

}

        