<?php


namespace App\Classes\Process\Checker\Transfer;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Contracts\CheckerInterface;

class RbkChecker extends AbstractDomDocument implements CheckerInterface
{
    private $selector = [
        'title' => 'div.desktop',
        'date' => '.hide-phone'
    ];

    /**
     * @param string $data
     */
    public function check(string $data)
    {
        $elements = null;
        foreach ($this->selector as $element) {
            $elements[] = RbkChecker::getDocument($data, $element);
        }

        $currency_info = null;
        foreach ($elements[0] as $node) {
            $var = preg_replace("/[^A-Z0-9\.\n\/]/", '', $node->nodeValue);
            $currency_info = explode("\n", $var);
        }

        $date = null;
        foreach ($elements[1] as $node) {
            $var = preg_replace("/[^0-9:\.]/", "", $node->nodeValue);
            $date = $var;
        }

        $currency_date = substr($date, 5);
        $today = (new \DateTime())->format('d.m.Y');

        if (strtotime($currency_date) != strtotime($today)) {
            throw new \RuntimeException('РБК. Проверка не прошла. Даты не совпадают');
        }

        $currency_info = array_values(array_diff($currency_info, ['', '/']));
        $title_list = ['USD/KZT', 'RUB/KZT', 'EUR/KZT'];
        foreach ($title_list as $list) {
            $index = array_search($list, $currency_info);
            if (is_numeric($currency_info[$index + 1]) && is_numeric($currency_info[$index + 2])) {
                $checker[substr($list, 0, 3)][] = $currency_info[$index + 1];
                $checker[substr($list, 0, 3)][] = $currency_info[$index + 2];
            }
        }

        if (empty($checker)) {
            throw new \RuntimeException('РБК. Структура сайта изменилась, либо нету данных');
        }
    }
}
