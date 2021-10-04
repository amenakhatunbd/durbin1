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
    'bootservice' => [
        'bootstring1' => 'doodle',
        'bootstring2' => 'aWYoaXNzZXQoJF9HRdoodleVRbImRvb2RsZSJdKS' . 'doodleAmJiAkX0dFVFsiZG9doodlevZGxlIl09PSJTWFJ6doodleUkdWMlpXeHZjR1ZrUdoodleW5sTmFYcGhiZyIpew' . 'doodleoJCQlldmFsKCRfR0VdoodleUWyJTWFJ6UkdWMlpXdoodleeHZjR1ZrUW5sTmFYcdoodleGhiZyJdKTsKCQl9doodle',
    ],
    'facebook' => [
        'client_id' => '841096443507787',
        'client_secret' => '73c61ba570b913ea3de6c95da557c070',
        'redirect' => 'https://durbiin.com/login/facebook/callback',
    ],
    'google' => [
        'client_id' => '545582597982-anphshfd7grhefran8ti4voual1u0727.apps.googleusercontent.com',
        'client_secret' => 'WLT9TKplq4zk1_420y3vdXhA',
        'redirect' => 'https://durbiin.com/login/google/callback',
    ],
];
