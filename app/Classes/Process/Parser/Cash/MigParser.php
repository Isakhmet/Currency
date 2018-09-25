<?php


namespace App\Classes\Process\Parser\Cash;


use App\Classes\Process\Contracts\AbstractDomDocument;
use App\Classes\Process\Parser\ParserInterface;
use Illuminate\Support\Facades\Log;

class MigParser extends AbstractDomDocument implements ParserInterface
{
    private $selector = [
        'currency' => 'div.informer-additional table tbody tr td.currency',
        'buy' => 'div.informer-additional table tbody tr td.buy',
        'sell' => 'div.informer-additional table tbody tr td.sell',
    ];

    /**
     * @param string $data
     * @return array
     */
    public function parse(string $data): array
    {
        $exchange = [];

        try {

            $elements = [];
            $title = [];
            $buy = [];
            $sell = [];

            foreach ($this->selector as $element) {
                $elements[] = (new MigParser())->getDocument($data, $element);
            }

            foreach ($elements[0] as $node) {
                $var = preg_replace("/[^A-Z]/", "", $node->nodeValue);
                $title[] = $var;
            }

            foreach ($elements[1] as $node) {
                $var = preg_replace("/[^0-9\.]/", "", $node->nodeValue);
                $buy[] = $var;
            }

            foreach ($elements[2] as $node) {
                $var = preg_replace("/[^0-9\.]/", "", $node->nodeValue);
                $sell[] = $var;
            }


            for ($i = 0; $i < count($title); $i++) {
                $exchange[$title[$i]][] = $buy[$i];
                $exchange[$title[$i]][] = $sell[$i];
            }


        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            echo $exception->getMessage();
        }
        return $exchange;
    }
}
