<?php


namespace App\Classes\Process\Parser\Transfer;


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

            $currency_info = preg_replace("/[^0-9A-Z\.\n]/", '', $elements->item(0)->nodeValue);

            $currency_info = explode("\n", $currency_info);
            $currency_info = array_values(array_diff($currency_info, ['']));

            for ($i = 0; $i < count($currency_info); $i += 3) {
                $exchange[$currency_info[$i]][] = $currency_info[$i + 1];
                $exchange[$currency_info[$i]][] = $currency_info[$i + 2];
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), [$exception->getLine(), $exception->getFile()]);
        }
        return $exchange;
    }
}
