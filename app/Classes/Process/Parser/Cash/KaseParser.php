<?php


namespace App\Classes\Process\Parser\Cash;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Parser\ParserInterface;
use Illuminate\Support\Facades\Log;

class KaseParser extends AbstractDomDocument implements ParserInterface
{
    private $selector = 'div.currency-tabs__item';

    /**
     * @param string $data
     * @return array
     */
    public function parse(string $data): array
    {
        $exchange = null;

        try {
            $element = KaseParser::getDocument($data, $this->selector);

            $currency_info = null;
            for ($i = 0; $i < 4; $i++) {
                $var = preg_replace("/[^A-Z0-9\,\.\n]/", '', $element->item($i)->nodeValue);
                $var = explode("\n", $var);
                $currency_info[] = array_values(array_diff($var, ['']));
            }

            if (empty($currency_info)) {
                throw new \RuntimeException('Kase. Проверка не прошла. Структура сайта изменилась или нету данных');
            }

            $today = (new \DateTime())->format('d.m.y');
            $date_currency = null;

            foreach ($currency_info as $currency) {
                $date_currency = array_pop($currency);

                if (!(strtotime($date_currency) != strtotime($today))) {
                    $exchange[substr($currency[2], 0, 3)][] = $currency[0];
                } else {
                    Log::info('Kase. ' . substr($currency[1], 0, 3) . ' валюта не обновлялась с ' . $date_currency);
                }
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return $exchange;
    }
}
