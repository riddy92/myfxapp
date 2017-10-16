<?php

use App\CurrencyRate;
use Carbon\Carbon;


$factory->define(CurrencyRate::class, function () {
    return [
        'date' => Carbon::now(),
        'currency_id' => 1,
        'buy_rate' => 1,
        'sell_rate' => 1
    ];
});
