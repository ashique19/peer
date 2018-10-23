<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payout extends Model
{
    protected $table = 'payout';
    protected $fillable = [
        'id', 'user_id', 'amount', 'type', 'bank_name', 'branch_name', 'swift_code', 'account_name', 'account_number'
    ];
    public $timestamps = true;

    // use SoftDeletes;
    
    public function user()
    {
        
        return $this->belongsTo('\App\User');
        
    }
}
