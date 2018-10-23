<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = "messages";
    
    protected $fillable = ['id', 'name', 'message_from', 'message_to', 'is_reply', 'is_read', 'message_id', 'details', 'created_at', 'updated_at'];
    
    public function scopeRead($query)
    {
        
        return $query->where('is_read', 1);
        
    }
    
    public function scopeUnRead($query)
    {
        
        return $query->where('is_read', 0);
        
    }
    
    public function scopeMyMessages($query)
    {
        
        return $query->where('message_from', auth()->user()->id)->orWhere('message_to', auth()->user()->id );
        
    }
    
    
    public function scopeMyReadMessages($query)
    {
        
        return $query->where('message_from', auth()->user()->id)->orWhere('message_to', auth()->user()->id )->where('is_read', 1);
        
    }
    
    
    public function scopeMyUnreadMessages($query)
    {
        
        return $query->where('message_to', auth()->user()->id )->where('is_read', 0);
        
    }
    
    
    public function message()
    {
        
        return $this->belongsTo('\App\Message');
        
    }
    
    
    public function replies()
    {
        
        return $this->hasMany('\App\Message');
        
    }
            
    
    public function from()
    {
        
        return $this->belongsTo('\App\User', 'message_from');
        
    }
            
    
    public function to()
    {
        
        return $this->belongsTo('\App\User', 'message_to');
        
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

        