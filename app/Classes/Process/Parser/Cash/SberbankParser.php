<?php


namespace App\Classes\Process\Parser\Cash;

use App\Classes\Process\Contracts\AbstractDOMDocument;
use App\Classes\Process\Parser\ParserInterface;
use Illuminate\Support\Facades\Log;

class SberbankParser extends AbstractDOMDocument implements ParserInterface
{
    private $selector = 'table.quotes_oms_extended_table tbody ';

    /**
     * @param string $data
     * @return array
     */
    public function parse(string $data): array
    {
        $exchange = null;

        try {
            $elements = SberbankParser::getDocument($data, $this->selector);

            $data = null;
            foreach ($elements as $node) {
                $data[] = preg_replace("/[^0-9A-Z\.\n]/", '', $node->nodeValue);
            }

            if (count($data) != 13) {
                throw new \Exception('Сбербанк. Структура сайта изменилась');
            }
            $arr[] = $data[2];
            $arr[] = $data[3];
            $arr[] = $data[4];

            $currency = ['USD', 'EUR', 'RUB'];

            $currency_info = null;
            for ($i = 0; $i < count($arr); $i++) {

                $currency_info = explode("\n", $arr[$i]);
                $currency_info = array_values(array_diff($currency_info, ['']));

                $exchange[$currency[$i]][] = $currency_info[1];
                $exchange[$currency[$i]][] = $currency_info[2];
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), [$exception->getLine(), $exception->getFile()]);
        }

        return $exchange;
    }
}
