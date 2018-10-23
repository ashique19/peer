<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerNew extends Model
{

    protected $table = "buyers_new";
    
    protected $fillable = ['id', 'title', 'url', 'image', 'price', 'description', 'quantity', 'from_country_id', 'to_country_id', 'city_id', 'user_id', 'from_address', 'from_state', 'from_zip', 'to_address', 'to_state', 'to_zip', 'status','created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    public function country()
    {
        
        return $this->belongsTo('\App\Country');
        
    }
            

    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
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
     
    public function scopeExpired($query)
    {
        
        return $query->where( 'departure_date', '<' , \Carbon::now()->addDay(1) );
        
    }       
    
    

}

        