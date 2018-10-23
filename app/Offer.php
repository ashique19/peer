<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    
    protected $table = "offers";
    
    
    protected $fillable = ['id', 'name', 'link', 'image_url', 'product_price', 'offer_price', 'transaction_charge', 'airposted_commission', 'total_price', 'tax', 'offer_type', 'is_reply', 'reply_of', 'is_agreed', 'is_deleted', 'is_offer_from_buyer', 'is_offer_from_traveller', 'traveller_id', 'buyer_id', 'note', 'created_at', 'updated_at'];
    
    
    protected $casts = [
    ];
    
    
    public function traveller()
    {
        
        return $this->belongsTo('\App\User', 'traveller_id');
        
    }
    
            
    public function buyer()
    {
        
        return $this->belongsTo('\App\User','buyer_id', 'id');
        
    }
    
    
    public function payment()
    {
        
        return $this->hasOne('\App\Payment');
        
    }
    
    
    public function scopeFromBuyer($query)
    {
        
        return $query->where('is_offer_from_buyer', 1);
        
    }
    
    
    public function scopeFromTraveler($query)
    {
        
        return $query->where('is_offer_from_traveller', 1);
        
    }
    
            
    public function scopeToMeFromBuyer($query)
    {
        
        return $query->where('is_offer_from_buyer', 1)->where('traveller_id', auth()->user()->id );
        
    }
    
            
    public function scopeToMeFromTraveller($query)
    {
        
        return $query->where('is_offer_from_traveller', 1)->where('buyer_id', auth()->user()->id );
        
    }
    
    
    public function scopeReplies($query)
    {
        
        return $query->where('is_reply', 1);
        
    }
    
    
    public function scopeReplyOf($query, $id)
    {
        
        return $query->where('is_reply', 1)->where('reply_of', $id);
        
    }
    
    
    public function scopeNotReply($query)
    {
        
        return $query->where('is_reply', 0);
        
    }
    
    
    public function replyParent()
    {
        
        return $this->belongsTo('\App\Offer', 'reply_of');
        
    }
    
    
    public function replies()
    {
        
        return $this->hasMany('\App\Offer', 'reply_of');
        
    }
    
    
    public function scopeAgreed($query)
    {
        
        return $query->where('is_agreed', 1);
        
    }
    
    
    public function scopeNotAgreed($query)
    {
        
        return $query->where('is_agreed', 0);
        
    }
    
    
    public function scopeDeleted($query)
    {
        
        return $query->where('is_deleted', 1);
        
    }
    
    
    public function scopeNotDeleted($query)
    {
        
        return $query->where('is_deleted', 0);
        
    }
    
    
    public function scopeToday($query)
    {
        
        return $query->whereBetween('created_at', [ date('Y-m-d').' 00:00:00' , date('Y-m-d').' 23:59:59' ]);
        
    }
    
    
    public function scopeThisWeek($query)
    {
        
        return $query->whereBetween('created_at', [ \Carbon::now()->addDays(-7)->format('Y-m-d').' 00:00:00' , date('Y-m-d').' 23:59:59' ]);
        
    }
    
    
    public static function boot()
    {
        
        parent::boot();
        
        static::creating(function($model)
        {
            
            $app   = \App\Setting::first();
            
            $price = $model->offer_price;
            
            $transaction_charge = round( ($price * $app->transaction_charge / 100 + env('FIXED_TRANSACTION_CHARGE') ) , 3);
            
            $airposted_commission = round($price * $app->commission / 100, 3);
            
            $model->transaction_charge      = $transaction_charge;
            
            $model->airposted_commission    = $airposted_commission;
            
            $model->total_price = round($price + $transaction_charge + $airposted_commission, 3);
            
        });
        
        static::updating(function($model)
        {
            
            $app   = \App\Setting::first();
            
            $price = $model->offer_price;
            
            $transaction_charge = round( ($price * $app->transaction_charge / 100 + env('FIXED_TRANSACTION_CHARGE') ) , 3);
            
            $airposted_commission = round($price * $app->commission / 100, 3);
            
            $model->transaction_charge      = $transaction_charge;
            
            $model->airposted_commission    = $airposted_commission;
            
            $model->total_price = round($price + $transaction_charge + $airposted_commission, 3);
            
        });
        
    }
    

}

        