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
        'client_id'     => '1190762914319752',
        'client_secret' => '792a03ab88b2c584380d4e6002d3a0e5',
        'redirect'      => 'http://movieman.core-devs.com/social/callback/facebook',
    ],

    'twitter' => [
        'client_id'     => '1vntT6DKYgcN2xYVGboWQtlbC',
        'client_secret' => 'azU2yfe2owGGTmXiqVaLENj1FnlCOe09Xev8FdrEPkap9HVw9i',
        'redirect'      => 'http://movieman.core-devs.com/social/callback/twitter',
    ],

    'google' => [
        'client_id'     => '444558013680-5n3328665vj3j4d4sd84ltmmke3tf5kt.apps.googleusercontent.com',
        'client_secret' => 'FRO3VRhqKJgYcWK5gPqUouNZ',
        'redirect'      => 'http://movieman.core-devs.com/social/callback/google',
    ]

];
