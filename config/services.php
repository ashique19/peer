<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'github' => [
        'client_id' => '15eeb889d0fcb01a6307',
        'client_secret' => '36f405949694a83593af57c4a81a98af4d866706',
        'redirect' => 'http://airposted.com/auth/social/github',
    ],
    'facebook' => [
        'client_id' => '333092917053673',
        'client_secret' => 'f0dcd43113f60e088792761d8eeca468',
        'redirect' => 'http://pp3.doctors24.net/auth/social/facebook',
    ],
//    'facebook' => [
//        'client_id' => '514439678753630',
//        'client_secret' => 'b98db418a4510d21d85b172b2558610e',
//        'redirect' => 'http://airposted.com/auth/social/facebook',
//    ],

    'google' => [
        'client_id' => '896079316862-g1vsc24mccahm24pijgn36a9udh4fdp1.apps.googleusercontent.com',
        'client_secret' => 'tUUPIHpC4y5O7ebZBH5FjnXf',
        'redirect' => 'http://airposted.com/auth/social/google',
    ],

    'paypal' => [
        'client_id' => (env('PAYPAL_SANDBOX') == true) ? env('PAYPAL_SANDBOX_CLIENT_ID') : env('PAYPAL_LIVE_CLIENT_ID'),
        'client_secret' => (env('PAYPAL_SANDBOX') == true) ? env('PAYPAL_SANDBOX_CLIENT_SECRET') : env('PAYPAL_LIVE_CLIENT_SECRET'),
        'mode' => (env('PAYPAL_SANDBOX') == true) ? 'sandbox' : 'live',
        'service_endpoint' => (env('PAYPAL_SANDBOX') == true) ? 'https://api.sandbox.paypal.com/' : 'https://api.paypal.com/'
    ],
    
    
    'stripe' => [
        'secret' => env('STRIPE_API_KEY'),
    ],
    
    
];
