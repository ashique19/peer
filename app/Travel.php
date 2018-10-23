<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{

    protected $table = "travels";
    
    protected $fillable = ['id', 'name', 'arrival_date', 'departure_date', 'travel_date', 'country_from', 'country_to', 'airport_from', 'airport_to', 'user_id', 'is_active', 'created_at', 'updated_at'];
    
	protected $dates = ['arrival_date', 'departure_date', 'travel_date', ];


    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
    }
    
    
    public function countryFrom()
    {
        
        return $this->belongsTo('\App\Country', 'country_from');
        
    }
    
    
    public function countryTo()
    {
        
        return $this->belongsTo('\App\Country', 'country_to');
        
    }
            
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeUpcoming($query)
    {
        return $query->where( 'travel_date', '>' , \Carbon::now()->addDay(1) )
            ->where( 'departure_date', '>' , \Carbon::now()->addDay(1) );
    }
    
    public function scopeValid($query)
    {
        return $query->where( 'departure_date', '>' , \Carbon::now()->addDay(1) );
    }
    
    
    public function scopeExpired($query)
    {
        
        return $query->where( 'departure_date', '<' , \Carbon::now()->addDay(1) );
        
    }
    
    
    public function airportTo()
    {
        
        return $this->belongsTo('\App\Airport', 'airport_to');
        
    }
    
    
    public function airportFrom()
    {
        
        return $this->belongsTo('\App\Airport', 'airport_from');
        
    }
    
    
    public function scopeMy($query)
    {
        
        if( auth()->user() )
        {
            
            return $query->where('user_id', auth()->user()->id );
            
        } else{
            
            return $query;
            
        }
        
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
    
    
    public static function boot()
    {
        
        parent::boot();
        
        static::creating(function($model){
            
            $model->travel_date = $model->departure_date;
            
        });
        
        
        static::updating(function($model){
            
            $model->travel_date = $model->departure_date;
            
        });
        
    }

}

