<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_log extends Model
{

    protected $table = "order_logs";
    
    protected $fillable = ['id', 'name', 'order_id', 'user_id', 'created_by', 'updated_by', 'log_detail', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    
    
    public function order()
    {
        
        return $this->belongsTo('\App\Order');
        
    }
            
    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
    }
            
    public function createdBy()
    {
        
        return $this->belongsTo('\App\User', 'created_by');
        
    }
    
    
    public function updatedBy()
    {
        
        return $this->belongsTo('\App\User', 'updated_by');
        
    }
    
    
    public static function boot()
    {
        
        parent::boot();
        
        static::creating(function($model)
        {
            if(auth()->user())
            {
                
                $model->created_by = auth()->user()->id;
                
                $model->updated_by = auth()->user()->id;
                
            }
            
            
            
        });
        
        
        static::created(function( $model )
        {
            
            \App\Notification::create([
                'notification_from' => 2,
                'notification_to' => $model->user_id,
                'name' => 'New log on your order: '. $model->log_detail,
                'link' => 'order-summary/'.$model->order_id
            ]);
            
        });
        
        static::updating(function($model)
        {
            if(auth()->user())
            {
                
                $model->updated_by = auth()->user()->id;
                
            }
            
        });
        
        
        static::updated(function($model)
        {
            
            \App\Notification::create([
                'notification_from' => 2,
                'notification_to' => $model->user_id,
                'name' => 'New log on your order: '. $model->log_detail,
                'link' => 'order-summary/'.$model->order_id
            ]);
            
        });
        
    }
            
    
    

}

        