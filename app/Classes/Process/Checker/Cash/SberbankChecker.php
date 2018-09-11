<?php


namespace App\Classes\Process\Checker\Cash;

use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Contracts\CheckerInterface;

class SberbankChecker extends AbstractDomDocument implements CheckerInterface
{
    private $selector = 'table.quotes_oms_extended_table tbody ';

    /**
     * @param string $data
     */
    public function check(string $data)
    {
        $elements = SberbankChecker::getDocument($data, $this->selector);

        $data = null;
        foreach ($elements as $node) {
            $data[] = preg_replace("/[^0-9A-Z\.\n]/", '', $node->nodeValue);
        }

        if (count($data) != 13) {
            throw new \RuntimeException('Сбербанк. Структура сайта изменилась');
        }
        $arr[] = $data[2];
        $arr[] = $data[3];
        $arr[] = $data[4];

        $currency = ['USD', 'EUR', 'RUB'];
        $exchange = null;

        $currency_info = null;
        for ($i = 0; $i < count($arr); $i++) {

            $currency_info = explode("\n", $arr[$i]);
            $currency_info = array_values(array_diff($currency_info, ['']));

            $exchange[$currency[$i]][] = $currency_info[1];
            $exchange[$currency[$i]][] = $currency_info[2];
        }

        foreach ($exchange as $item) {

            if (!(is_numeric($item[0]) && is_numeric($item[1]))) {
                throw new \RuntimeException('Сбербанк. Данные пустые либо значение валют не числовой');
            }
        }
    }
}
