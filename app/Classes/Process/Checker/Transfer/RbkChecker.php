<?php


namespace App\Classes\Process\Checker\Transfer;


use App\Classes\Process\Contracts\AbstractDOMDocument;
use App\Classes\Process\Contracts\CheckerInterface;
use Illuminate\Support\Facades\Log;

class RbkChecker extends AbstractDOMDocument implements CheckerInterface
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
        try {

            $elements = [];
            $title_list = ['USD/KZT', 'RUB/KZT', 'EUR/KZT'];

            foreach ($this->selector as $element) {
                $elements[] = (new RbkChecker())->getDocument($data, $element);
            }

            foreach ($elements[0] as $node) {
                $var = preg_replace("/[^A-Z0-9\.\n\/]/", '', $node->nodeValue);
                $arr = explode("\n", $var);
            }

            foreach ($elements[1] as $node) {
                $var = preg_replace("/[^0-9:\.]/", "", $node->nodeValue);
                $date = $var;
            }

            $currency_date = substr($date, 5);
            $today = (new \DateTime())->format('d.m.Y');

            if (strtotime($currency_date) != strtotime($today)) {
                throw new \Exception('РБК. Проверка не прошла. Даты не совпадают');
            }

            $arr = array_diff($arr, ['']);
            $arr = array_diff($arr, ['/']);
            $arr = array_values($arr);

            foreach ($title_list as $list) {
                $index = array_search($list, $arr);
                if (is_numeric($arr[$index + 1]) && is_numeric($arr[$index + 2])) {
                    $checker[substr($list, 0, 3)][] = $arr[$index + 1];
                    $checker[substr($list, 0, 3)][] = $arr[$index + 2];
                }
            }

            if (empty($checker)) {
                throw new \Exception('РБК. Структура сайта изменилась, либо нету данных');
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
