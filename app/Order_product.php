<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{

    protected $table = "order_products";
    
    protected $fillable = ['id', 'name', 'order_id', 'source', 'product_url', 'category_id', 'price', 'height', 'width', 'length', 'weight', 'dimension_unit', 'weight_unit', 'product_image', 'quantity', 'note', 'created_at', 'updated_at'];
    
    protected $casts = [
    ];
    
    
    
    public function order()
    {
        
        return $this->belongsTo('\App\Order');
        
    }
            
    public function category()
    {
        
        return $this->belongsTo('\App\Category');
        
    }
            
    
    

}

        