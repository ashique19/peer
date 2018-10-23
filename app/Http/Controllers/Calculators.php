<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Calculators extends Controller
{
    
    private $calculation = [
    
        'price'                     => 0,
        'traveler_commission'       => 0,
        'full_price'                => 0,
        
        'transaction_charge_rate'   => 0,
        'transaction_charge_amount' => 0,
        
        'fixed_charge'              => 0.30,
        
        'commission_rate'           => 0,
        'commission'                => 0,
        
        'total'                     => 0
    
    ];
    
    
    public function __construct($price = 0, $traveler_commission = 0)
    {
        
        $rate = \App\Setting::first();
        
        $this->calculation['transaction_charge_rate']   = (int) $rate->transaction_charge;
        
        $this->calculation['commission_rate']           = (int) $rate->commission;
        
        $this->calculation['price']                     = $price;
        $this->calculation['traveler_commission']       = $traveler_commission;
        $this->calculation['full_price']                = $this->calculation['price'] + $this->calculation['traveler_commission'];
        $this->calculation['transaction_charge_amount'] = $this->calculation['full_price'] * $this->calculation['transaction_charge_rate'] / 100;
        $this->calculation['commission']                = $this->calculation['full_price'] * $this->calculation['commission_rate'] / 100;
        $this->calculation['total']                     = $this->calculation['full_price'] + $this->calculation['transaction_charge_amount'] + $this->calculation['fixed_charge'] + $this->calculation['commission'];
        
        
    }
    
    
    public function get()
    {
        
        return $this->calculation;
        
    }
    
    
    
}
