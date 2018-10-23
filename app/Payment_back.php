<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = "payments";
    
    
    protected $fillable = ['id', 'name', 'offer_id', 'buyer_id', 'traveller_id', 'from_country_id', 'to_country_id', 'product_price', 'agreed_price', 'airposted_commission', 'payment', 'gateway_id', 'status', 'is_delivered', 'created_at', 'updated_at'];
    
    
    protected $casts = [
    ];
    
    
    public function offer()
    {
        
        return $this->belongsTo('\App\Offer');
        
    }
        
            
    public function buyer()
    {
        
        return $this->belongsTo('\App\User', 'buyer_id');
        
    }
    
            
    public function traveller()
    {
        
        return $this->belongsTo('\App\User', 'traveller_id');
        
    }
    
            
    public function from_country()
    {
        
        return $this->belongsTo('\App\Country', 'from_country_id');
        
    }
    
            
    public function to_country()
    {
        
        return $this->belongsTo('\App\Country', 'to_country_id');
        
    }
            
    
    public function scopeMyBuys($query)
    {
        
        return $query->where('buyer_id', auth()->user()->id );
        
    }
            
    
    public function scopeMyCarries($query)
    {
        
        return $query->where('traveller_id', auth()->user()->id );
        
    }
    
    
    public function gateway()
    {
        
        return $this->belongsTo('\App\Gateway');
        
    }
            
    
    public function scopeUnpaid($query)
    {
        
        return $query->where('status', 1);
        
    }
    

}

        