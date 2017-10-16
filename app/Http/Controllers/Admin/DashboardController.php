<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\CurrencyRate;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function show()
    {
        return view('admin.dashboard');
    }
}
