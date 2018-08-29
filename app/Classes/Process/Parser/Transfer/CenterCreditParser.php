<?php


namespace App\Classes\Process\Parser\Transfer;


use App\Classes\Process\Contracts\AbstractDOMDocument;
use App\Classes\Process\Parser\ParserInterface;
use Illuminate\Support\Facades\Log;

class CenterCreditParser extends AbstractDOMDocument implements ParserInterface
{
    private $selector = [
        'title' => 'div.s_table_over table.s_table tbody tr th',
        'buy' => 'div.s_table_over table.s_table tbody tr td',
    ];

    /**
     * @param string $data
     * @return array
     */
    public function parse(string $data): array
    {
        $rates = [];

        try {
            $elements = [];
            $title = [];
            $values = [];

            foreach ($this->selector as $element) {
                $elements[] = (new CenterCreditParser())->getDocument($data, $element);
            }

            foreach ($elements[0] as $node) {
                $var = preg_replace("/[^A-Z]/", '', $node->nodeValue);
                $title[] = $var;
            }

            foreach ($elements[1] as $node) {
                $var = preg_replace("/[^0-9\.]/", '', $node->nodeValue);
                $values[] = $var;
            }

            $title = array_diff($title, ['']);
            $title = array_values($title);
            $title = array_slice($title, 3, 3);

            $currency = array_slice($values, array_search('', $values) + 1, 6);

            for ($i = 0; $i < count($title); $i++) {
                $rates[$title[$i]][] = $currency[$i * 2];
                $rates[$title[$i]][] = $currency[$i * 2 + 1];
            }


        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return $rates;
    }
}
