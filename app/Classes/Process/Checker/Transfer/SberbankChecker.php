<?php


namespace App\Classes\Process\Checker\Transfer;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Contracts\CheckerInterface;
use App\Models\Currency;
use Illuminate\Support\Facades\Log;

class SberbankChecker extends AbstractDomDocument implements CheckerInterface
{
    private $selector = 'table.quotes_oms_extended_table tbody ';

    /**
     * @param string $data
     */
    public function check(string $data)
    {
        $elements = SberbankChecker::getDocument($data, $this->selector);

        $currency_info = preg_replace("/[^0-9A-Z\.\n]/", '', $elements->item(0)->nodeValue);
        $currency_info = explode("\n", $currency_info);
        $currency_info = array_values(array_diff($currency_info, ['']));

        $count = 0;
        for ($i = 0; $i < count($currency_info); $i += 3) {
            $currency = Currency::where('name', $currency_info)->get();

            if (!$currency) {
                Log::info("Сбербанк. В базе нету этой валюты $currency_info[$i]");
            } else {
                $count++;
            }

            if (!(is_numeric($currency_info[$i + 1]) && is_numeric($currency_info[$i + 2]))) {
                throw new \RuntimeException('Сбербанк. Данные пустые либо значение валют не числовой');
            }
        }

        if (!$count) {
            throw new \RuntimeException('Сбербанк. Структура сайта изменилась либо нету всех данных');
        }
    }
}
