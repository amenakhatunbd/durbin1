<?php
/*
 * Secret key and Site key get on https://www.google.com/recaptcha
 * */
return [
    'secret' => env('CAPTCHA_SECRET', '6LecNlAbAAAAANwr8Yy5z65ZIxEnFPQcB-3J-Ltt'),
    'sitekey' => env('CAPTCHA_SITEKEY', '6LecNlAbAAAAAJ3zQxMZwthWkWvy8Y2KHNZ-Bhgh'),
    
    
    
    /**
     * @var string|null Default ``null``.
     * Custom with function name (example customRequestCaptcha) or class@method (example \App\CustomRequestCaptcha@custom).
     * Function must be return instance, read more in repo ``https://github.com/thinhbuzz/laravel-google-captcha-examples``
     */
    'request_method' => null,
    'options' => [
        'multiple' => false,
        'lang' => app()->getLocale(),
    ],
    'attributes' => [
        'theme' => 'light'
    ],
];