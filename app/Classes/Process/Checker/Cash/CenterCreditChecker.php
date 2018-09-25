<?php


namespace App\Classes\Process\Checker\Cash;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Contracts\CheckerInterface;

class CenterCreditChecker extends AbstractDomDocument implements CheckerInterface
{
    private $selector = [
        'title' => 'div.s_table_over table.s_table tbody tr th',
        'buy' => 'div.s_table_over table.s_table tbody tr td',
        'date' => 'b.ifont150'
    ];

    /**
     * @param string $data
     */
    public function check(string $data)
    {
        $elements = null;
        foreach ($this->selector as $element) {
            $elements[] = CenterCreditChecker::getDocument($data, $element);
        }
        $title = null;
        foreach ($elements[0] as $node) {
            $var = preg_replace("/[^A-Z]/", '', $node->nodeValue);
            $title[] = $var;
        }

        $values = null;
        foreach ($elements[1] as $node) {
            $var = preg_replace("/[^0-9\.]/", '', $node->nodeValue);
            $values[] = $var;
        }


        $currency_date = preg_replace("/[^0-9\.]/", '', $elements[2]->item(1)->nodeValue);
        $today = (new \DateTime())->format('d.m.y');

        if (strtotime($currency_date) != strtotime($today)) {
            throw new \RuntimeException('ЦентрКредит. Проверка не прошла. Даты не совпадают');
        }

        $title = array_diff($title, ['']);
        $title = array_values($title);

        if (!count($title) == 9 && $title[0] == 'USD') {
            throw new \RuntimeException('ЦентрКредит. Структура сайта изменилась, либо нету данных');
        }

        $array[0][] = array_slice($values, 0, 10);
        $array[1][] = array_slice($values, 10, 10);
        $array[2][] = array_slice($values, 20, 6);

        $currency = null;
        foreach ($array as $arr) {
            $currency[] = $arr[0][0];
            $currency[] = $arr[0][1];
        }

        foreach ($currency as $curr) {
            if (!is_numeric($curr)) {
                throw new \RuntimeException('ЦентрКредит. Значение валют не верное');
            }
        }
    }
}
