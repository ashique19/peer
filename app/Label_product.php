<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label_product extends Model
{

    protected $table = "label_products";
    
    protected $fillable = ['id', 'label_id', 'name', 'quantity', 'weight', 'value', 'country_id', 'hs_tarrif', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    
    
    public function label()
    {
        
        return $this->belongsTo('\App\Label');
        
    }
            
    public function country()
    {
        
        return $this->belongsTo('\App\Country');
        
    }
            
    
    

}

        