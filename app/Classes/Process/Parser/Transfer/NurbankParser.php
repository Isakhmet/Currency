<?php


namespace App\Classes\Process\Parser\Transfer;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Parser\ParserInterface;
use Illuminate\Support\Facades\Log;

class NurbankParser extends AbstractDomDocument implements ParserInterface
{
    private $selector = 'div#data2 table.table tr td';

    /**
     * @param string $data
     * @return array
     */
    public function parse(string $data): array
    {
        $exchange = [];

        try {

            $element = (new NurbankParser())->getDocument($data, $this->selector);
            $currency_info = [];
            $currency = ['USD', 'EUR', 'RUB', 'CHF', 'CNY', 'GBP'];

            foreach ($element as $node) {
                $var = preg_replace("/[^a-zA-Z0-9\,]/", "", $node->nodeValue);
                $var = str_replace(',', '.', $var);
                $currency_info[] = $var;
            }
            array_search('RUR', $currency_info) ? $currency_info[array_search('RUR', $currency_info)] = 'RUB' : null;

            foreach ($currency as $curr) {
                $index = array_search($curr, $currency_info);

                if (is_numeric($currency_info[$index + 1]) && is_numeric($currency_info[$index + 2])) {
                    $exchange[$curr][] = $currency_info[$index + 1];
                    $exchange[$curr][] = $currency_info[$index + 2];
                }
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return $exchange;
    }
}
