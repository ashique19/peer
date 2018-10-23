<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravellerCart extends Model
{
    protected $table = 'traveller_carts';
    protected $fillable = [
        'id', 'user_id', 'product_id', 'created_at', 'updated_at'
    ];
    public $timestamps = true;

    use SoftDeletes;

    public function user()
    {

        return $this->belongsTo('\App\User');

    }

    public function products()
    {

        return $this->belongsTo('\App\BuyerNew', 'product_id', 'id');

    }
}
