<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    protected $table = "chats";
    
    protected $fillable = ['id', 'name', 'chat_image', 'message_from', 'message_to', 'is_read_by_from', 'is_read_by_to', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    public function from()
    {
        
        return $this->belongsTo('\App\User', 'message_from');
        
    }
    
    
    public function to()
    {
        
        return $this->belongsTo('\App\User', 'message_to');
        
    }
    
    
    public function scopeUnread($query)
    {
        
        return $query->where('is_read_by_to', 0);
        
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

        