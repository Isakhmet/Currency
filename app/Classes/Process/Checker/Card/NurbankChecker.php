<?php


namespace App\Classes\Process\Checker\Card;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Contracts\CheckerInterface;
use Illuminate\Support\Facades\Log;

class NurbankChecker extends AbstractDomDocument implements CheckerInterface
{
    private $selector = [
        'structure' => 'div#data3 table.table tr td',
        'date' => 'div#data3 p span'
    ];

    /**
     * @param string $data
     */
    public function check(string $data)
    {
        $elements = null;
        foreach ($this->selector as $element) {
            $elements[] = NurbankChecker::getDocument($data, $element);
        }

        $currency_date = explode(' ', $elements[1]->item(0)->nodeValue);
        $today = (new \DateTime)->format('d');

        $check_date = $currency_date[0] == $today ? true : false;

        if (!$check_date) {
            throw new \RuntimeException('Нурбанк. Проверка не прошла. Даты не совпадают');
        }

        $currency_info = null;
        foreach ($elements[0] as $node) {
            $var = preg_replace("/[^a-zA-Z0-9\,]/", "", $node->nodeValue);
            $var = str_replace(',', '.', $var);
            $currency_info[] = $var;
        }
        $currency = ['USD', 'EUR', 'RUR', 'CHF', 'CNY', 'GBP'];
        $rates = null;
        foreach ($currency as $curr) {
            $index = array_search($curr, $currency_info);

            if (is_numeric($index)) {
                if (is_numeric($currency_info[$index + 1]) && is_numeric($currency_info[$index + 2])) {
                    $rates[$curr][] = $currency_info[$index + 1];
                    $rates[$curr][] = $currency_info[$index + 2];
                } else {
                    Log::info("Нурбанк. $curr значение валют не числовой или нету данных");
                }
            } else {
                Log::info("Нурбанк. $curr нету данных по этой валюте");
            }
        }

        if (empty($rates)) {
            throw new \RuntimeException('Нурбанк. Проверка не прошла. Нет данных о валютах или структура сайта устарела');
        }

    }
}
