<?php


namespace App\Classes\Process\Checker\Cash;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Contracts\CheckerInterface;
use App\Models\Currency;
use Illuminate\Support\Facades\Log;

class MigChecker extends AbstractDomDocument implements CheckerInterface
{
    private $selector = [
        'title' => 'div.informer-additional table tbody tr td.currency',
        'buy' => 'div.informer-additional table tbody tr td.buy',
        'sell' => 'div.informer-additional table tbody tr td.sell',
        'date' => 'date'
    ];

    /**
     * @param string $data
     */
    public function check(string $data)
    {

        $elements = null;
        foreach ($this->selector as $element) {
            $elements[] = MigChecker::getDocument($data, $element);
        }

        $title = null;
        foreach ($elements[0] as $node) {
            $var = preg_replace("/[^A-Z]/", "", $node->nodeValue);
            $title[] = $var;
        }

        $buy = null;
        foreach ($elements[1] as $node) {
            $var = preg_replace("/[^0-9\.]/", "", $node->nodeValue);
            $buy[] = $var;
        }

        $sell = null;
        foreach ($elements[2] as $node) {
            $var = preg_replace("/[^0-9\.]/", "", $node->nodeValue);
            $sell[] = $var;
        }

        $currency_date = explode(' ', $elements[3]->item(0)->nodeValue);
        $today = (new \DateTime())->format('d');
        $checker_date = $currency_date[1] == $today ? true : false;

        if (!$checker_date) {
            throw new \RuntimeException('Миг. Проверка не прошла. Даты не совпадают');
        }

        $currencies = Currency::all('name')->toArray();

        $currency = null;
        if (!empty($title)) {
            foreach ($title as $curr) {
                for ($i = 0; $i < count($currencies); $i++) {
                    $index = array_search($curr, array_values($currencies[$i]));
                    if (is_numeric($index)) {
                        $currency[] = $curr;
                    }
                }
            }
            if ($title > $currency) {
                Log::info('Миг. ' . (count($title) - count($currency)) . " валют нету в базе");
            }
        } else {
            throw new \RuntimeException('Миг. Нету данных о валютах');
        }

        if (count($title) != count($buy) || count($title) != count($sell)) {
            throw new \RuntimeException('Миг. Данные не полные');
        }


    }
}
