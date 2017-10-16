<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    /**
     * Return all currencies
     *
     * @@return array
     */
    public function getCurrencies()
    {
        $currencies = Currency::all();

        return ['status' => 'success', 'currencies' => $currencies];
    }

    /**
     * Return only fx currencies
     *
     * @return array
     */
    public function getExchangeCurrencies()
    {
       $currencies = Currency::getExchangeCurrencies();

       return ['status' => 'success', 'currencies' => $currencies];
    }

    /**
     * Create a currency
     *
     * @param Currency $currency
     * @param Request $request
     * 
     * @return array
     */
    public function create(Currency $currency, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',
            'country' => 'required',
        ]);

        $currency->create([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'country' => $request->country,
        ]);

        return ['status' => 'success', 'message' => 'Currency created successfully!'];
    }

    /**
     * Update a Currency
     *
     * @param Currency $currency
     * @param Request $request
     * 
     * @return array
     */
    public function update(Currency $currency, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',
            'country' => 'required',
        ]);

        $currency->update([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'country' => $request->country,
        ]);

        return ['status' => 'success', 'message' => 'Currency updated successfully!'];
    }
}
