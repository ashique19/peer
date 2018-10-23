<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = "orders";
    
    protected $fillable = ['id', 'name', 'user_id', 'status', 'no_of_products', 'product_cost', 'shipping_cost', 'airposted_margin', 'order_total', 'paid_amount', 'paid_for_product', 'paid_for_shipping', 'label_id', 'payment_id', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    
    
    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
    }
            
    public function label()
    {
        
        return $this->belongsTo('\App\Label');
        
    }
            
    public function payment()
    {
        
        return $this->belongsTo('\App\Payment');
        
    }
            
        
    public function order_products()
    {
        
        return $this->hasMany('\App\Order_product');
        
    }
        
        
    public function order_logs()
    {
        
        return $this->hasMany('\App\Order_log');
        
    }
        
    
    

}

        