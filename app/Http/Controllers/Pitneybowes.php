<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Pitneybowes extends Controller
{
    
    private $url = "";
    
    private $authURL = "";
    
    private $addressURL = "";
    
    private $rateURL = "";
    
    private $createLabelUrl = "";
    
    private $marchentRegisterUrl = "";
    
    private $base64_encoded_key_secret = "";
    
    private $shipper_rate_plan = "PP_SRP_NEWBLUE";
    
    private $token = false;
    
    private $token_lifetime = 0;
    
    private $clientID = null;
    
    private $shipperID = "9014927170";
    
    private $developerID = "47642414";
    

    public function __construct()
    {
        
        $this->url      = env('PITNEYBOWES_SANDBOX') == true ? 'https://api-sandbox.pitneybowes.com' : 'https://api.pitneybowes.com';
        
        $this->authURL  = $this->url.'/oauth/token';
        
        $this->addressURL  = $this->url.'/shippingservices/v1/addresses/verify?minimumAddressValidation=false';
        
        $this->rateURL  = $this->url.'/shippingservices/v1/rates?includeDeliveryCommitment=true';
        
        $this->marchentRegisterUrl = $this->url.'/developers/'.$this->developerID.'/merchants/registration';
        
        $this->createLabelUrl  = $this->url.'/shippingservices/v1/shipments?includeDeliveryCommitment=true';
        
        $this->base64_encoded_key_secret = base64_encode(env('PITNEYBOWES_USPS_KEY').':'.env('PITNEYBOWES_USPS_SECRET'));
    
        $this->token    = session('pitneybowes_token') ?: false;
        
        $this->token_lifetime = session('pitneybowes_token_lifetime') ?: 0;
        
        $this->clientID = session('pitneybowes_client_id') ?: null;
        
    }
    

    
    private function getAuthorized()
    {
        
        $authorization = \Curl::to( $this->authURL )
                            ->withHeaders( [
                                    "Authorization: Basic <".$this->base64_encoded_key_secret.">",
                                    'Content-Type: application/x-www-form-urlencoded'
                                ])
                            ->withData(['grant_type'=> 'client_credentials'])
                            ->post();
        
        $authorization = json_decode( $authorization, true );
        
        if( $authorization['access_token'] )
        {
            
            $this->token = $authorization['access_token'];
            session(['pitneybowes_token'=> $this->token]);
            
            $this->token_lifetime = \Carbon::now()->addMinutes( round($authorization['expiresIn'] / 60 ));
            session(['pitneybowes_token_lifetime'=> $this->token_lifetime]);
            
            $this->clientID = $authorization['clientID'];
            session(['pitneybowes_client_id'=> $this->clientID]);
            
        }
        
    }
    
    
    
    public function getToken()
    {
        
        if( ! $this->token || \Carbon::now() >  $this->token_lifetime )
        {
            
            $this->getAuthorized();
            
            return $this->token;
            
        }
        
        return $this->token;
        
    }
    
    
    
    public function verifyAddress($addressData)
    {
        
        /**
         * 
            Sample address data
            [
                 "addressLines"=>[
                     "1 Atwell rd",
                     "bldg 2",
                     "apt 302"
                 ],
                 "cityTown"=> "Cooperstown",
                 "stateProvince"=> "NY",
                 "postalCode"=> "13326",
                 "countryCode"=> "US",
                 "name"=> "James Brother",
                 "company"=> "Mary Imogene Basset Hospital",
                 "phone"=> "203-924-2428",
                 "email"=> "johndoe@email.com"
            ]
        
        */
        
        $address = \Curl::to( $this->addressURL )
                        ->withHeaders( [
                                "Authorization: Bearer ".$this->getToken()."",
                                'Content-Type: application/json'
                            ])
                        ->withData( json_encode($addressData))
                        ->post();
                        
        return json_decode($address, true);
    
    }
    
    
    
    public function getRates($parcel_parameters)
    {
        
        $rates = \Curl::to( $this->rateURL )
                        ->withHeaders( [
                                "Authorization: Bearer ".$this->getToken()."",
                                'Content-Type: application/json',
                                'X-PB-Shipper-Rate-Plan: '.$this->shipper_rate_plan
                            ])
                        ->withData( json_encode($parcel_parameters))
                        ->post();
                        
        return (array) json_decode($rates, true);
    
    }
    
    
    
    public function createLabel($data)
    {
        
        $label = \Curl::to( $this->createLabelUrl )
                    ->withHeaders( [
                                "Authorization: Bearer ".$this->getToken()."",
                                'Content-Type: application/json',
                                'X-PB-TransactionId: airposted'.rand(10000,20000),
                                'X-PB-Shipper-Rate-Plan: '.$this->shipper_rate_plan
                            ])
                    ->withData( json_encode($data) )
                    ->post();
        
        return $label;
        
    }
    
    
    
    public function registerMarchent()
    {
        
        $marchantData = [
            "addressLines"=> [
                "1 Atwell rd",
                "bldg 2",
                "apt 302"
            ],
            "cityTown"=> "Cooperstown",
            "stateProvince"=> "NY",
            "postalCode"=> "13326",
            "countryCode"=> "US",
            "name"=> "James Brother",
            "company"=> "Mary Imogene Basset Hospital",
            "phone"=> "203-924-2428",
            "email"=> "johndoe@email.com"
        ];
        // return $this->marchentRegisterUrl;
        $marchant = \Curl::to( $this->marchentRegisterUrl )
                    ->withHeaders( [
                                "Authorization: Bearer ".$this->getToken()."",
                                'Content-Type: application/json',
                            ])
                    ->withData( json_encode($marchantData) )
                    ->post();
                    
        return $marchant;
        
    }
    
    
    
    public function getShipperID()
    {
        
        return $this->shipperID;
        
    }
    
}
