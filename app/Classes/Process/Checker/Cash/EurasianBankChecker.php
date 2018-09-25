<?php


namespace App\Classes\Process\Checker\Cash;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Contracts\CheckerInterface;
use App\Models\Currency;
use Illuminate\Support\Facades\Log;

class EurasianBankChecker extends AbstractDomDocument implements CheckerInterface
{
    private $selector = [
        'structure' => 'div.exchange table',
        'date' => 'div.exchange div.date'
    ];

    /**
     * @param string $data
     */
    public function check(string $data)
    {
        $elements = null;
        foreach ($this->selector as $element) {
            $elements[] = EurasianBankChecker::getDocument($data, $element);
        }

        $date = null;
        foreach ($elements[1] as $node) {
            $date[] = preg_replace("/[^0-9\.]/", '', $node->nodeValue);
        }

        $currency_date = $date[4];
        $today = (new \DateTime())->format('d.m.Y');
        if (strtotime($currency_date) != strtotime($today)) {
            throw new \RuntimeException('Евразийский банк. Проверка не прошла. Даты не совпадают');
        }

        $var = preg_replace("/[^0-9A-Z\n\,]/", '', $elements[0]->item(0)->nodeValue);
        $var = preg_replace("/[\,]/", ".", $var);
        $currency_info = explode("\n", $var);
        $currency_info = array_values(array_diff($currency_info, ['']));

        $count = 0;
        for ($i = 0; $i < count($currency_info); $i += 3) {

            $currency = Currency::where('name', $currency_info[$i])->get();

            if (!$currency) {
                Log::info("Евразийский банк. В базе нету этой валюты $currency_info[$i]");
            } else {
                $count++;
            }
            if (!(is_numeric($currency_info[$i + 1]) && is_numeric($currency_info[$i + 2]))) {
                throw new \RuntimeException('Евразийский банк. Значение валют не числовой');
            }
        }

        if (!$count) {
            throw new \RuntimeException('Евразийский банк. Структура сайта изменилась либо нету всех данных');
        }
    }
}
