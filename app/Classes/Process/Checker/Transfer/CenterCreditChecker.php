<?php


namespace App\Classes\Process\Checker\Transfer;

use App\Classes\Process\Contracts\AbstractDOMDocument;
use App\Classes\Process\Contracts\CheckerInterface;
use Illuminate\Support\Facades\Log;

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
        try {
            $elements = [];
            $title = [];
            $values = [];

            foreach ($this->selector as $element) {
                $elements[] = (new CenterCreditChecker())->getDocument($data, $element);
            }

            foreach ($elements[0] as $node) {
                $var = preg_replace("/[^A-Z]/", '', $node->nodeValue);
                $title[] = $var;
            }

            foreach ($elements[1] as $node) {
                $var = preg_replace("/[^0-9\.]/", '', $node->nodeValue);
                $values[] = $var;
            }


            $currency_date = preg_replace("/[^0-9\.]/", '', $elements[2]->item(1)->nodeValue);
            $today = (new \DateTime())->format('d.m.y');

            if (strtotime($currency_date) != strtotime($today)) {
                throw new \Exception('Проверка не прошла. Даты не совпадают');
            }

            $title = array_diff($title, ['']);
            $title = array_values($title);

            if (!count($title) == 9 && $title[3] == 'USD') {
                throw new \Exception('Структура сайта изменилась, либо нету данных');
            }

            $index = array_search('', $values);
            $currency = array_slice($values, $index + 1, 6);

            foreach ($currency as $curr) {
                if (!is_numeric($curr)) {
                    throw new \Exception('Значение валют не верное');
                }
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
