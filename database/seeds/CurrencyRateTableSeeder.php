<?php

use App\CurrencyRate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CurrencyRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates = [
            [
                'date' => Carbon::now()->subDay(3),
                'currency_id' => 2,
                'buy_rate' => 361,
                'sell_rate' => 366,
            ],
            [
                'date' => Carbon::now()->subDay(3),
                'currency_id' => 3,
                'buy_rate' => 471,
                'sell_rate' => 477
            ],
            [
                'date' => Carbon::now()->subDay(3),
                'currency_id' => 4,
                'buy_rate' => 420,
                'sell_rate' => 425,
            ],

            [
                'date' => Carbon::now()->subDay(2),
                'currency_id' => 2,
                'buy_rate' => 364,
                'sell_rate' => 367,
            ],
            [
                'date' => Carbon::now()->subDay(2),
                'currency_id' => 3,
                'buy_rate' => 472,
                'sell_rate' => 478
            ],
            [
                'date' => Carbon::now()->subDay(2),
                'currency_id' => 4,
                'buy_rate' => 422,
                'sell_rate' => 427,
            ],
            [
                'date' => Carbon::now()->subDay(1),
                'currency_id' => 2,
                'buy_rate' => 360,
                'sell_rate' => 363
            ],
            [
                'date' => Carbon::now()->subDay(1),
                'currency_id' => 3,
                'buy_rate' => 469,
                'sell_rate' => 475
            ],
            [
                'date' => Carbon::now()->subDay(1),
                'currency_id' => 4,
                'buy_rate' => 420,
                'sell_rate' => 425
            ],
            [
                'date' => Carbon::now(),
                'currency_id' => 2,
                'buy_rate' => 361,
                'sell_rate' => 364
            ],
            [
                'date' => Carbon::now(),
                'currency_id' => 3,
                'buy_rate' => 467,
                'sell_rate' => 472
            ],
            [
                'date' => Carbon::now(),
                'currency_id' => 4,
                'buy_rate' => 418,
                'sell_rate' => 423
            ],
        ];

        foreach ($rates as $rate) {
            factory(CurrencyRate::class)->create($rate);
        }

    }
}
