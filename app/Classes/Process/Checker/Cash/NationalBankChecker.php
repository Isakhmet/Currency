<?php


namespace App\Classes\Process\Checker\Cash;


use App\Classes\Process\Contracts\AbstractDOMDocument;
use App\Classes\Process\Contracts\CheckerInterface;
use Illuminate\Support\Facades\Log;

class NationalBankChecker extends AbstractDOMDocument implements CheckerInterface
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
        try {

            foreach ($this->selector as $element) {
                $elements[] = (new NationalBankChecker())->getDocument($data, $element);
            }

            foreach ($elements[0] as $node) {
                $var = preg_replace("/[^A-Z0-9\/\.]/", '', $node->nodeValue);
                $currency[] = $var;
            }

            $date = preg_replace("/[^A-Z0-9\/]/", '', $elements[1]->item(0)->nodeValue);
            $date = strtotime(preg_replace("/[\/]/", '.', $date));
            $today = strtotime((new \DateTime())->format('d.m.y'));

            if ($date != $today) {
                throw new \Exception('Нацбанк. Проверка не прошла. Даты не совпадают');
            }

            $currency = array_diff($currency, ['', 1, 10, 100, 1000]);
            $currency = array_values($currency);
            array_pop($currency);
            dd($currency);
            if (count($currency) % 2 != 0) {
                throw new \Exception('Нацбанк. Структура сайта изменилась либо нету всех данных');
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
