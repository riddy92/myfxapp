<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\CurrencyRate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Show the homepage
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratesToday = CurrencyRate::with(['currency' => function($query) {
            $query->where('is_base', 0);
        }])->where('date', '=', Carbon::now()->startOfDay())
            ->orWhere('date', '>', Carbon::now()->startOfDay())->get();

        $ratesPrevious = CurrencyRate::with(['currency' => function($query) {
            $query->where('is_base', 0);
        }])->where('date', '>', Carbon::now()->startOfDay()->subDays(3))
            ->where('date', '<', Carbon::now()->startOfDay())->get()
            ->sortByDesc('date')
        ->groupBy(function($item) {
            return $item->date->format('d-m-Y');
        });

        return view('home')->with([
            'ratesToday' => $ratesToday,
            'ratesPrevious' => $ratesPrevious
        ]);
    }
}
