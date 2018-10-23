<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{

    protected $table = "buyers";
    
    protected $fillable = ['id', 'name', 'amazon_url', 'other_url', 'price', 'image_url', 'country_id', 'city_id', 'user_id', 'category_id', 'p_weight', 'p_length', 'p_height', 'p_width', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    public function country()
    {
        
        return $this->belongsTo('\App\Country');
        
    }
            
    public function city()
    {
        
        return $this->belongsTo('\App\City');
        
    }
            
    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
    }
            
    public function category()
    {
        
        return $this->belongsTo('\App\Category');
        
    }
    
    public function scopeToday($query)
    {
        
        return $query->whereBetween('created_at', [ date('Y-m-d').' 00:00:00' , date('Y-m-d').' 23:59:59' ]);
        
    }
    
    
    public function scopeThisWeek($query)
    {
        
        return $query->whereBetween('created_at', [ \Carbon::now()->addDays(-7)->format('Y-m-d').' 00:00:00' , date('Y-m-d').' 23:59:59' ]);
        
    }
    
    
    public function scopeLastMonth($query)
    {
        
        return $query->whereBetween('created_at', [ \Carbon::now()->addMonths(-1)->format('Y-m-d').' 00:00:00' , date('Y-m-d').' 23:59:59' ]);
        
    }
            
    
    

}

        