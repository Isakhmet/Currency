<?php


namespace App\Classes\Process\Parser\Transfer;


use App\Classes\Process\Contracts\AbstractDOMDocument;
use App\Classes\Process\Parser\ParserInterface;
use Illuminate\Support\Facades\Log;

class RbkParser extends AbstractDOMDocument implements ParserInterface
{
    private $selector = 'div.desktop';

    /**
     * @param string $data
     * @return array
     */
    public function parse(string $data): array
    {
        $rates = [];

        try {

            $title_list = ['USD/KZT', 'RUB/KZT', 'EUR/KZT'];
            $currency_info = [];

            $elements = (new RbkParser())->getDocument($data, $this->selector);


            foreach ($elements as $node) {
                $var = preg_replace("/[^A-Z0-9\.\n\/]/", '', $node->nodeValue);
                $currency_info = explode("\n", $var);
            }

            $currency_info = array_diff($currency_info, ['']);
            $currency_info = array_diff($currency_info, ['/']);
            $currency_info = array_values($currency_info);

            foreach ($title_list as $list) {
                $index = array_search($list, $currency_info);
                if (is_numeric($currency_info[$index + 1]) && is_numeric($currency_info[$index + 2])) {
                    $rates[substr($list, 0, 3)][] = $currency_info[$index + 1];
                    $rates[substr($list, 0, 3)][] = $currency_info[$index + 2];
                }
            }

            dd($rates);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return $rates;
    }
}
