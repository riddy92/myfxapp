<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    protected $fillable = ['date', 'currency_id', 'buy_rate', 'sell_rate'];

    protected $dates = ['date'];

    public function currency()
    {
        return$this->belongsTo(Currency::class);
    }
}
