<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = "notifications";
    
    protected $fillable = ['id', 'notification_from', 'notification_to', 'name', 'link', 'is_delivered', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    
    public function from()
    {
        
        return $this->belongsTo('\App\User', 'notification_from');
        
    }
    
    
    public function to()
    {
        
        return $this->belongsTo('\App\User', 'notification_to');
        
    }
    
            
    public function scopeDelivered($query)
    {
        
        return $query->where('is_delivered', 1);
        
    }
    
    
    
    public function scopeUnDelivered($query)
    {
        
        return $query->where('is_delivered', 0)->where('notification_from', auth()->user()->id);
        
    }
    
    
    
    public function scopeSent($query)
    {
        
        return $query->where('notification_from', auth()->user()->id);
        
    }
    
    
    
    public function scopeReceived($query)
    {
        
        return $query->where('notification_to', auth()->user()->id);
        
    }
    
    
            
    public static function boot()
    {
        
        parent::boot();
        
        static::created(function($model)
        {
            
            ( new \App\Http\Controllers\Mails )->notification( $model->id );
            
        });
        
    }
            
    
    

}

        