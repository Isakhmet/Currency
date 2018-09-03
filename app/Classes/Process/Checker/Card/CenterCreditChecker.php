<?php


namespace App\Classes\Process\Checker\Card;


use App\Classes\Process\Contracts\AbstractDOMDocument;
use App\Classes\Process\Contracts\CheckerInterface;

class CenterCreditChecker extends AbstractDOMDocument implements CheckerInterface
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
            $elements[] = (new CenterCreditChecker())->getDocument($data, $element);
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
            throw new \RuntimeException('Проверка не прошла. Даты не совпадают');
        }

        $title = array_diff($title, ['']);
        $title = array_values($title);

        if (!count($title) == 9 && $title[6] == 'USD') {
            throw new \RuntimeException('Структура сайта изменилась, либо нету данных');
        }

        $currency = null;
        for ($i = 0; $i < count($values); $i++) {
            if ($values[$i] == '') {
                $currency = array_slice($values, $i + 1);
            }
        }

        foreach ($currency as $item) {
            if (!is_numeric($item)) {
                throw new \RuntimeException('Значение валют не верное');
            }
        }


    }
}
