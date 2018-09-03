<?php


namespace App\Classes\Process\Parser\Cash;


use App\Classes\Process\Contracts\AbstractDOMDocument;
use App\Classes\Process\Parser\ParserInterface;
use Illuminate\Support\Facades\Log;


class EurasianBankParser extends AbstractDOMDocument implements ParserInterface
{
    private $selector = 'div.exchange table';

    /**
     * @param string $data
     * @return array
     */
    public function parse(string $data): array
    {
        $exchange = null;

        try {

            $elements = (new EurasianBankParser())->getDocument($data, $this->selector);

            $var = preg_replace("/[^0-9A-Z\n\,]/", '', $elements->item(0)->nodeValue);
            $var = preg_replace("/[\,]/", ".", $var);
            $currency_info = explode("\n", $var);
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
