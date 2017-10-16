<?php

use App\Currency;


$factory->define(Currency::class, function () {
    return [
        'name' => 'Naira',
        'short_name' => 'NGN',
        'country' => 'Nigeria',
        'is_base' => 0
    ];
});
