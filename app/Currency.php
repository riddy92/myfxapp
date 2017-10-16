<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name', 'short_name', 'country'];

    public $timestamps = false;

    public static function getExchangeCurrencies()
    {
        return self::where('is_base', 0)->get();
    }

}
