<?php


namespace App\Classes\Process\Checker\Cash;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Contracts\CheckerInterface;
use Illuminate\Support\Facades\Log;

class KaseChecker extends AbstractDomDocument implements CheckerInterface
{
    private $selector = 'div.currency-tabs__item';

    /**
     * @param string $data
     */
    public function check(string $data)
    {

        $element = KaseChecker::getDocument($data, $this->selector);

        $currency_info = null;
        for ($i = 0; $i < 4; $i++) {
            $var = preg_replace("/[^A-Z0-9\,\.\n]/", '', $element->item($i)->nodeValue);
            $var = explode("\n", $var);
            $currency_info[] = array_values(array_diff($var, ['']));
        }

        if (empty($currency_info)) {
            throw new \RuntimeException('Kase. Проверка не прошла. Структура сайта изменилась или нету данных');
        }

        $today = (new \DateTime())->format('d.m.y');
        $date_currency = null;
        $exchange = null;
        foreach ($currency_info as $currency) {
            $date_currency = array_pop($currency);

            if (!(strtotime($date_currency) != strtotime($today))) {
                $exchange[substr($currency[2], 0, 3)][] = $currency[0];
            } else {
                Log::info('Kase. ' . substr($currency[1], 0, 3) . ' валюта не обновлялась с ' . $date_currency);
            }
        }

        if (empty($exchange)) {
            throw new \RuntimeException('Kase. Проверка не прошла. Даты не совпадают');
        }

    }
}
