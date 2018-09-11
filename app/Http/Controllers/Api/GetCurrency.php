<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Currency;
use App\Models\ExchangeRate;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GetCurrency extends Controller
{
    public function getAllBanks() : array
    {

        $banks = Company::whereHas('exchangeRates', function ($query) {
            /**
             * @var $query \Illuminate\Database\Query\Builder
             */
            $query->where('exchange_type_id', 1);
        })->where('type', 'bank')->get(['id','name']);


        $ids = $banks->pluck('id')->toArray();

        $exchanges = ExchangeRate::whereIn('company_id', $ids)
            ->where('exchange_type_id', 1)
            ->orderBy('id', 'desc')
            ->get();

        $currencies = Currency::all(['id', 'name']);

        $currencies_titles = $currencies->pluck('name','id')->toArray();

        $exchange_rate = [];

        $exchange_companies = [];

        foreach ($exchanges as $exchange){
            if(!isset($exchange_companies[$exchange->company_id])){
                $exchange_companies[$exchange->company_id] = [];
            }

            if(isset($exchange_companies[$exchange->company_id][$exchange->currency_id])){
                continue;
            }

            $exchange_companies[$exchange->company_id][$exchange->currency_id] = $exchange;
        }

        foreach ($banks as $bank){

            $current_company_exchanges = $exchange_companies[$bank->id];

            $exchange_company_rate = [
                'name' => $bank->name,
                'updated_at' => null,
            ];

            $currency = [];
            $currency['updated_at'] = Carbon::now()->subMonth(1);

            foreach ($current_company_exchanges as $currency_id => $currency){
                $currency_title = Str::lower($currencies_titles[$currency_id]);
                $exchange_company_rate[$currency_title. '_buy'] = $currency->buy;
                $exchange_company_rate[$currency_title. '_sell'] = $currency->sell;
            }

            $exchange_company_rate['updated_at'] = $currency['updated_at']->format('d.m.Y');
            $exchange_rate[] = $exchange_company_rate;
        }

        return $exchange_rate;

    }
}
