<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\ExchangeType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GetCurrency extends Controller
{
    public function getAllBanks(Request $request, string $type): array
    {
        /** @var ExchangeType $exchange */
        $exchange = ExchangeType::where('name', $type)->first();

        if(!$exchange){
            return [
                'status' => 'fail',
                'message' => 'invalid type'
            ];
        }

        $banks = Company::whereHas('exchangeRates', function ($query) use ($exchange) {
            /**
             * @var $query \Illuminate\Database\Query\Builder
             */
            $query->where('exchange_type_id', $exchange->id);
        })->where('type', 'bank')->get(['id', 'name']);


        $ids = $banks->pluck('id')->toArray();

        $exchanges = ExchangeRate::whereIn('company_id', $ids)
            ->where('exchange_type_id', $exchange->id)
            ->orderBy('id', 'desc')
            ->get();

        $currencies = Currency::all(['id', 'name']);

        $currencies_titles = $currencies->pluck('name', 'id')->toArray();

        $exchange_rate = [];

        $exchange_companies = [];

        foreach ($exchanges as $exchange) {
            if (!isset($exchange_companies[$exchange->company_id])) {
                $exchange_companies[$exchange->company_id] = [];
            }

            if (isset($exchange_companies[$exchange->company_id][$exchange->currency_id])) {
                continue;
            }

            $exchange_companies[$exchange->company_id][$exchange->currency_id] = $exchange;
        }

        foreach ($banks as $bank) {

            $current_company_exchanges = $exchange_companies[$bank->id];

            $exchange_company_rate = [
                'name' => $bank->name,
                'updated_at' => null,
            ];

            $currency = [];
            $currency['updated_at'] = Carbon::now();

            foreach ($current_company_exchanges as $currency_id => $currency) {
                $currency_title = Str::lower($currencies_titles[$currency_id]);
                $exchange_company_rate[$currency_title . '_buy'] = $currency->buy;
                $exchange_company_rate[$currency_title . '_sell'] = $currency->sell;
            }

            $exchange_company_rate['updated_at'] = $currency['updated_at']->format('d.m.Y');
            $exchange_rate[] = $exchange_company_rate;
        }

        return $exchange_rate;

    }

    public function getExchangeMig()
    {

        $company = Company::where('code', 'mig')->get(['id', 'name']);

        $exchanges = ExchangeRate::where('company_id', $company[0]->id)->orderBy('id', 'desc')->get(['currency_id', 'buy', 'sell', 'updated_at']);

        $currencies = Currency::all(['id', 'name']);
        $currencies_titles = $currencies->pluck('name', 'id');

        $exchange_rate['name'] = $company[0]->name;
        foreach ($exchanges as $exchange) {
            if (!isset($exchange_rate['currencies'][$currencies_titles[$exchange->currency_id]])) {
                $exchange_rate['updated_at'] = $exchange->updated_at->format('d.m.Y H:i');
                $exchange_rate['currencies'][$currencies_titles[$exchange->currency_id]][] = $exchange->buy;
                $exchange_rate['currencies'][$currencies_titles[$exchange->currency_id]][] = $exchange->sell;
            }
        }
        $exchange_rate['currencies'] = array_reverse($exchange_rate['currencies']);

        return $exchange_rate;
    }

    public function getGraphic(Request $request)
    {
        $currencies_title = Currency::all(['id', 'name'])->pluck('name', 'id');

        $index = array_search(Str::upper($request->get('code')), $currencies_title->toArray());

        $values = [];
        if (is_numeric($index)) {

            $exchange_rates = ExchangeRate::where([
                'company_id' => 5,
                'currency_id' => $index
            ])
                ->orderBy('updated_at', 'desc')
                ->limit(10)
                ->get(['currency_id', 'sell', 'updated_at']);


            foreach ($exchange_rates as $exchange_rate) {
                $values[$exchange_rate->updated_at->format('d.m')] = $exchange_rate->sell;
            }

            krsort($values);

        } else {
            echo 'Incorrect currency code';
        }

        return $values;
    }

}
