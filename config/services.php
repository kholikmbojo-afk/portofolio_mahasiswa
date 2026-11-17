<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Bridge SSO Portal Kampus (Ecampuz / UIN SSC)
    |--------------------------------------------------------------------------
    |
    | Digunakan untuk autentikasi Single Sign-On (SSO) mahasiswa & dosen
    | melalui Bridge API v2 Portal Akademik.
    |
    */
    'bridge_sso' => [
        'enabled'  => filter_var(env('BRIDGE_SSO_ENABLED', true), FILTER_VALIDATE_BOOLEAN),
        'base_url' => rtrim(env('BRIDGE_SSO_BASE_URL', 'https://bridge.uinssc.ac.id'), '/'),
        'timeout'  => (int) env('BRIDGE_SSO_TIMEOUT', 8),
        'simulate' => filter_var(env('BRIDGE_SSO_SIMULATE', false), FILTER_VALIDATE_BOOLEAN),
    ],

];
