<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],


    'facebook' => [
        'client_id' => '436045257091911',
        'client_secret' => 'f476797a2fe7f0537bc15f5e62b1dc0d',
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],

    'google' => [
        'client_id' => '800588917604-63s3jqpjqfbsl6chqu1qktsgj79smhne.apps.googleusercontent.com',
        'client_secret' => 'EYHCT0JOvw0e-KT9DK-7o1XR',
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],

    'github' => [
        'client_id' => '1aa45ca8fd44ddce4b23',
        'client_secret' => '7ac782e2909625bfd3eb3838623a0b4e5025fc59',
        'redirect' => 'http://localhost:8000/login/github/callback',
    ],


];
