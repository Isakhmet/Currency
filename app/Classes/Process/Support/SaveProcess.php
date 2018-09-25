<?php


namespace App\Classes\Process\Support;


use App\Classes\Process\Contracts\AbstractContextProcess;

class SaveProcess extends AbstractContextProcess
{

    public function run()
    {
        $context = $this->context;

        $result = $context->getResults();
        $company_id = $context->getCompany()->id;
        $company_code = $context->getCompany()->code;
        $exchange_rate = $context->getExchangeRateModel();
        $exchange_type_id = $context->getExchangeType()->id;
        $currency = $context->getCurrency();

        $keys = array_keys($result);

        foreach ($keys as $key) {
            if (!$context->getIsExchange()) {
                $exchange_rate->create([
                    'company_id' => $company_id,
                    'exchange_type_id' => $exchange_type_id,
                    'currency_id' => $currency->where('name', $key)->get(['id'])[0]->id,
                    'is_exchange' => $context->getIsExchange(),
                    'sell' => $result[$key][0],
                ]);
            } else {
                $exchange_rate->create([
                    'company_id' => $company_id,
                    'exchange_type_id' => $exchange_type_id,
                    'currency_id' => $currency->where('name', $key)->get(['id'])[0]->id,
                    'buy' => $result[$key][0],
                    'sell' => $result[$key][1],
                    'is_exchange' => $context->getIsExchange()
                ]);
            }


        }

        return $context;
    }

}
