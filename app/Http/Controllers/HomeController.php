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
        $rates = CurrencyRate::with(['currency' => function($query) {
            $query->where('is_base', 0);
        }])->where('date', '>', Carbon::now()->startOfDay())->get();

        return view('home', compact('rates'));
    }
}
