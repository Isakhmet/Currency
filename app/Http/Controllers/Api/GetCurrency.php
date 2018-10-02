<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\ExchangeType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GetCurrency extends Controller
{
    public function getAllBanks(Request $request, string $type): array
    {
        /** @var ExchangeType $exchange */
        $exchange = ExchangeType::where('name', $type)->first();

        if (!$exchange) {
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
                'bank_id' => $bank->id,
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

    public function getNationalBankCurrency()
    {

        $exchanges = ExchangeRate::where('company_id', 5)->orderBy('id', 'desc')->limit(42)->get(['currency_id', 'sell', 'created_at']);

        $currencies = Currency::all(['id', 'name', 'title', 'count']);

        $currencies_titles = $currencies->pluck('title', 'id');
        $currencies_count = $currencies->pluck('count', 'id');
        $currencies_names = $currencies->pluck('name', 'id');
        $exchange_rate = [];

        $today = (new \DateTime())->format('Y-m-d 13:00:00');
        $yesterday = (new \DateTime('-1 days'))->format('Y-m-d 13:00:00');

        $changes = [];
        foreach ($currencies_titles as $index => $currencies_title) {

            try {
                $sell_yesterday = ExchangeRate::where(['company_id' => 5, 'currency_id' => $index])
                    ->where('created_at', '>=', $yesterday)->orderBy('id', 'asc')->first(['sell'])->sell;

                $sell_today = ExchangeRate::where(['company_id' => 5, 'currency_id' => $index])
                    ->where('created_at', '>=', $today)->orderBy('id', 'asc')->first(['sell'])->sell;
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
            }

            if (($sell_yesterday ?? false) && ($sell_today ?? false)) {
                $changes[$index] = number_format(($sell_today - $sell_yesterday), 2, ',', ' ');
            }
        }

        foreach ($exchanges as $exchange) {

            if (!isset($exchange_rate[$exchange->currency_id])) {
                $exchange_rate[$exchange->currency_id]['title'] = $currencies_titles[$exchange->currency_id];
                $exchange_rate[$exchange->currency_id]['name'] = $currencies_names[$exchange->currency_id];
                $exchange_rate[$exchange->currency_id]['sell'] = $exchange->sell;
                $exchange_rate[$exchange->currency_id]['count'] = $currencies_count[$exchange->currency_id];
                $exchange_rate[$exchange->currency_id]['change'] = $changes[$exchange->currency_id];
                $exchange_rate[$exchange->currency_id]['created_at'] = $exchange->created_at->format('Y-m-d h:i:s');
            }
        }
        ksort($exchange_rate);
        return $exchange_rate;
    }

    public function getGraphic(Request $request, string $code)
    {
        $currencies_title = Currency::all(['id', 'name'])->pluck('id', 'name');

        if (!isset($currencies_title[$code])) {
            return [
                'status' => 'fail',
                'message' => 'invalid code'
            ];
        }

        $index = $currencies_title[$code];

        $values = [];
        if (is_numeric($index)) {

            $date = Carbon::now();
            $date->subDay(10);
            $date->format('Y-m-d 00:00:00');

            $exchange_rates = ExchangeRate::where([
                'company_id' => 5,
                'currency_id' => $index
            ])
                ->where('updated_at', '>', $date)
                ->orderBy('updated_at', 'desc')
                ->get(['currency_id', 'sell', 'updated_at']);


            foreach ($exchange_rates as $exchange_rate) {
                if (!isset($values[$exchange_rate->updated_at->format('d.m')])) {
                    $values[$exchange_rate->updated_at->format('d.m')] = $exchange_rate->sell;
                }
            }

            krsort($values);

        } else {
            echo 'Incorrect currency code';
        }

        return $values;
    }

}
