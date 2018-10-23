<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'id', 'user_id', 'product_id', 'title', 'description', 'category', 'price', 'url', 'image', 'quantity'
    ];
    public $timestamps = true;

    use SoftDeletes;
}
