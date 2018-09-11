<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Currency;
use App\Models\ExchangeRate;

class GetCurrency extends Controller
{
    public function getAllBanks()
    {

        $banks = (new Company())->whereHas('exchangeRates', function ($query) {
            $query->where('exchange_type_id', 1);
        })->where('type', 'bank')->get(['id']);

        $id = $banks->pluck('id')->toArray();
        $exchange = ExchangeRate::whereIn('company_id', $id)
            ->where('exchange_type_id', 1)
            ->get();

        $currency = Currency::all(['id', 'name']);

        $title = null;
        foreach ($currency as $curr) {
            $title[$curr->id] = $curr->name;
        }

        $exchange_rate = null;
        for ($i = 0; $i < count($banks); $i++) {

            $exchange_rate[$i]['name'] = $banks[$i]->name;
            foreach ($exchange->where('company_id', $banks[$i]->id) as $ex) {
                $exchange_rate[$i]['updated_at'] = $ex->updated_at->format('d.m.Y');
                $exchange_rate[$i][mb_strtolower($title[$ex->currency_id]) . '_buy'] = $ex->buy;
                $exchange_rate[$i][mb_strtolower($title[$ex->currency_id]) . '_sell'] = $ex->sell;
            }
        }

        return json_encode($exchange_rate);

    }
}
