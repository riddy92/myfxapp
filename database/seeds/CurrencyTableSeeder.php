<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'name' => 'Naira',
                'short_name' => 'NGN',
                'country' => 'Nigeria',
                'is_base' => 1
            ],
            [
                'name' => 'Dollar',
                'short_name' => 'USD',
                'country' => 'United States'
            ],
            [
                'name' => 'Pounds',
                'short_name' => 'GBP',
                'country' => 'United Kingdom'
            ],
            [
                'name' => 'Euro',
                'short_name' => 'EUR',
                'country' => 'Europe'
            ],
        ];

        foreach ($currencies as $currency) {
            factory(Currency::class)->create($currency);
        }
    }
}
