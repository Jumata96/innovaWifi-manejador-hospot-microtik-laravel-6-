<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '811869142225930',
        'client_secret' => '9a28fa0d6c5ffc9948b47a40dc3693f8',
        'redirect' => 'https://hotspot.innovatec.me/auth/facebook/callback'
    ],

    'google' => [
        'client_id' => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT')
    ],

    'twitter' => [
        'client_id' => 'copa62gPTmBIhHu1i2CWRAbzv',
        'client_secret' => 'DOTscigb8T4VDy6z9R9ohncZwPwkJeD2QlPPWQ9quqVpTAvmbd',
        'redirect' => 'https://hotspot.innovatec.me/auth/twitter/callback'
    ],

    'facebook2' => [
        'client_id' => '811869142225930',
        'client_secret' => '9a28fa0d6c5ffc9948b47a40dc3693f8',
        'redirect' => 'https://hotspot.innovatec.me/auth2/facebook/callback'
    ],

    'google2' => [
        'client_id' => env('GOOGLE_ID2'),
        'client_secret' => env('GOOGLE_SECRET2'),
        'redirect' => env('GOOGLE_REDIRECT2')
    ],

    'twitter2' => [
        'client_id' => 'copa62gPTmBIhHu1i2CWRAbzv',
        'client_secret' => 'DOTscigb8T4VDy6z9R9ohncZwPwkJeD2QlPPWQ9quqVpTAvmbd',
        'redirect' => 'https://hotspot.innovatec.me/auth2/twitter/callback'
    ],

];
