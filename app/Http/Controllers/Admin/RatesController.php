<?php

namespace App\Http\Controllers\Admin;

use App\CurrencyRate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatesController extends Controller
{
    /**
     * Fetch all rates
     *
     * @return array
     */
    public function getRates()
    {
        $rates = CurrencyRate::with(['currency' => function($query) {
            $query->where('is_base', 0);
        }])->where('date', '=', Carbon::now()->startOfDay())
            ->orWhere('date', '>', Carbon::now()->startOfDay())
            ->get();


        return ['status' => 'success', 'rates' => $rates];
    }

    /**
     * Update exchange rate
     *
     * @param CurrencyRate $rate
     * @param Request $request
     * @return void
     */
    public function update(CurrencyRate $rate, Request $request)
    {
        $request->validate([
            'date' => 'required',
            'currency_id' => 'required',
            'buy_rate' => 'required',
            'sell_rate' => 'required',
        ]);

        $rate->update([
            'date' =>  Carbon::parse($request->date),
            'currency_id' => $request->currency_id,
            'buy_rate' => $request->buy_rate,
            'sell_rate' => $request->sell_rate,
        ]);

        return ['status' => 'success', 'message' => 'Currency rates updated successfully!'];
    }

    /**
     * Create a new exchange rate
     *
     * @param CurrencyRate $rate
     * @param Request $request
     * @return void
     */
    public function create(CurrencyRate $rate, Request $request)
    {
        $request->validate([
            'date' => 'required',
            'currency_id' => 'required',
            'buy_rate' => 'required',
            'sell_rate' => 'required',
        ]);

        $rate->create([
            'date' =>  Carbon::parse($request->date),
            'currency_id' => $request->currency_id,
            'buy_rate' => $request->buy_rate,
            'sell_rate' => $request->sell_rate,
        ]);

        return ['status' => 'success', 'message' => 'Currency rates created successfully!'];
    }

    /**
     * Get history of daily rates
     *
     * @return void
     */
    public function getRateHistory()
    {
        $rates = CurrencyRate::with(['currency' => function($query) {
            $query->where('is_base', 0);
        }])->get();

        return view('admin.rates_history', compact('rates'));
    }
}
