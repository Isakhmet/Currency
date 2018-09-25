<?php


namespace App\Classes\Process\Parser\Cash;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Parser\ParserInterface;
use Illuminate\Support\Facades\Log;

class NationalBankParser extends AbstractDomDocument implements ParserInterface
{
    private $selector = 'div.roundborders table.gen4 tr td';

    /**
     * @param string $data
     * @return array
     */
    public function parse(string $data): array
    {
        $exchange = [];

        try {
            $elements = (new NationalBankParser())->getDocument($data, $this->selector);

            $currency = null;
            foreach ($elements as $node) {
                $var = preg_replace("/[^A-Z0-9\/\.]/", '', $node->nodeValue);
                $currency[] = $var;
            }

            $currency = array_diff($currency, ['', 1, 10, 100, 1000]);
            $currency = array_values($currency);
            array_pop($currency);

            for ($i = 0; $i < count($currency); $i += 2) {
                $exchange[substr($currency[$i], 0, 3)][] = $currency[$i + 1];
            }

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return $exchange;
    }
}
