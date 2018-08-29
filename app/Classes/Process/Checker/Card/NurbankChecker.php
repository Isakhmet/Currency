<?php


namespace App\Classes\Process\Checker\Card;


use App\Classes\Process\Contracts\AbstractDOMDocument;
use App\Classes\Process\Contracts\CheckerInterface;
use Illuminate\Support\Facades\Log;

class NurbankChecker extends AbstractDOMDocument implements CheckerInterface
{
    private $selector = 'div#data3 table.table tr td';
    private $date_selector = 'div#data3 p span';

    /**
     * @param string $data
     */
    public function check(string $data)
    {

        try {

            $date_element = (new NurbankChecker())->getDocument($data, $this->date_selector);
            $date = explode(' ', $date_element->item(0)->nodeValue);

            $now = new \DateTime();
            $now = $now->format('d');

            $check_date = $date[0] == $now ? true : false;

            if (!$check_date) {
                throw new \Exception('Проверка не прошла. Даты не совпадают');
            }

            $element = (new NurbankChecker())->getDocument($data, $this->selector);
            $currency_info = [];
            $currency = ['USD', 'EUR', 'RUR', 'CHF', 'CNY', 'GBP'];
            $rates = [];

            foreach ($element as $node) {
                $var = preg_replace("/[^a-zA-Z0-9\,]/", "", $node->nodeValue);
                $var = str_replace(',', '.', $var);
                $currency_info[] = $var;
            }

            foreach ($currency as $curr) {
                $index = array_search($curr, $currency_info);

                if (is_numeric($currency_info[$index + 1]) && is_numeric($currency_info[$index + 2])) {
                    $rates[$curr][] = $currency_info[$index + 1];
                    $rates[$curr][] = $currency_info[$index + 2];
                }
            }


            if (!empty($rates)) {
                Log::info('Проверка прошла успешно');
                echo 'Проверка прошла успешно';
            } else {
                throw new \Exception('Проверка не прошла. Нет данных о валютах или структура сайта устарела');
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
