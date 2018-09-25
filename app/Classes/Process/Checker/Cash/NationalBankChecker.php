<?php


namespace App\Classes\Process\Checker\Cash;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Contracts\CheckerInterface;

class NationalBankChecker extends AbstractDomDocument implements CheckerInterface
{
    private $selector = [
        'title' => 'div.roundborders table.gen4 tr td',
        'date' => 'div.roundborders h1'
    ];

    /**
     * @param string $data
     */
    public function check(string $data)
    {
        $elements = null;
        foreach ($this->selector as $element) {
            $elements[] = NationalBankChecker::getDocument($data, $element);
        }

        $currency = null;
        foreach ($elements[0] as $node) {
            $var = preg_replace("/[^A-Z0-9\/\.]/", '', $node->nodeValue);
            $currency[] = $var;
        }

        $date = preg_replace("/[^A-Z0-9\/]/", '', $elements[1]->item(0)->nodeValue);
        $date = strtotime(preg_replace("/[\/]/", '.', $date));
        $today = strtotime((new \DateTime())->format('d.m.y'));

        if ($date != $today) {
            throw new \RuntimeException('Нацбанк. Проверка не прошла. Даты не совпадают');
        }

        $currency = array_diff($currency, ['', 1, 10, 100, 1000]);
        $currency = array_values($currency);
        array_pop($currency);

        if (count($currency) % 2 != 0) {
            throw new \RuntimeException('Нацбанк. Структура сайта изменилась либо нету всех данных');
        }
    }
}
