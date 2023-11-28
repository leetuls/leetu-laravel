<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '596242809655-pmm9ak1ip7b3qvd90osogmhfkd1gvd9g.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost/admin/callback_gg',
    ],

    'facebook' => [
        'client_id' => '2101411190191809',
        'client_secret' => 'dd64e77abbc5c787269ee8176a188f7c',
        'redirect' => 'http://localhost/admin/callback_fb',
    ],
];
