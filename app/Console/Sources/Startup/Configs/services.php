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
        'redirect' => 'http://flowerify-ashique19.c9users.io/auth/social/github',
    ],
    
    'facebook' => [
        'client_id' => '895586763895693',
        'client_secret' => '8f016eccd5519170488862abcb4cccb6',
        'redirect' => 'http://flowerify-ashique19.c9users.io/auth/social/facebook',
    ],

    'google' => [
        'client_id' => '896079316862-g1vsc24mccahm24pijgn36a9udh4fdp1.apps.googleusercontent.com',
        'client_secret' => 'tUUPIHpC4y5O7ebZBH5FjnXf',
        'redirect' => 'http://flowerify-ashique19.c9users.io/auth/social/google',
    ],

];
