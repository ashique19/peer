<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $table = "payments";
    
    protected $fillable = ['id', 'name', 'payment_type', 'offer_id', 'buyer_id', 'traveller_id', 'from_country_id', 'to_country_id', 'product_price', 'traveller_commission', 'airposted_commission', 'transaction_charge', 'payment', 'gateway_id', 'status', 'is_delivered', 'gateway_payment_id', 'gateway_payer_id', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    
    public function label()
    {
        
        return $this->hasOne('\App\Label');
        
    }
    
    
    public function order()
    {
        
        return $this->hasOne('\App\Order');
        
    }
    
    
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
    
    
    public function gateway()
    {
        
        return $this->belongsTo('\App\Gateway');
        
    }
            
    
    public function scopeMyBuys($query)
    {
        
        return $query->where('buyer_id', auth()->user()->id );
        
    }
            
    
    public function scopeMyCarries($query)
    {
        
        return $query->where('traveller_id', auth()->user()->id );
        
    }
            
    
    public function scopeUnpaid($query)
    {
        
        return $query->where('status', 1);
        
    }
    
    
    public function scopeUnverified($query)
    {
        
        return $query->where('status', 2);
        
    }
    
    
    public function scopeVerified($query)
    {
        
        return $query->where('status', 3);
        
    }
    
    
    public function scopeReceived($query)
    {
        
        return $query->where('status', 4);
        
    }
    
    
    public function scopeReceive($query)
    {
        
        return $query->where('status', 4);
        
    }
    
    
    public function scopeUndelivered($query)
    {
        
        return $query->where('is_delivered', 0);
        
    }
    
    
    public function scopeGiven($query)
    {
        
        return $query->where('is_delivered', 1);
        
    }
    
    
    public function scopeDelivered($query)
    {
        
        return $query->where('is_delivered', 2);
        
    }
    
    
    public function scopeToday($query)
    {
        
        return $query->whereBetween('created_at', [ date('Y-m-d').' 00:00:00' , date('Y-m-d').' 23:59:59' ]);
        
    }
    
    
    public function scopeThisWeek($query)
    {
        
        return $query->whereBetween('created_at', [ \Carbon::now()->addDays(-7)->format('Y-m-d').' 00:00:00' , date('Y-m-d').' 23:59:59' ]);
        
    }
            
    
    

}

        