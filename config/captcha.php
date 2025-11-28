<?php
/*
 * Secret key and Site key get on https://www.google.com/recaptcha
 * */
return [
    'default'   => [
        'length'    => 6,               // Length of the CAPTCHA text
        'width'     => 120,             // Width of the CAPTCHA image
        'height'    => 40,              // Height of the CAPTCHA image
        'quality'   => 100,             // Image quality
        'math'      => false,           // Disable Math CAPTCHA
        'expire'    => 600,             // CAPTCHA expiration time in seconds
        'fontColors' => ['#000'],       // Font color(s) (black)
        'bgColor'   => '#fff',          // Background color (white)
    ],
];