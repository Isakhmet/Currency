<?php


namespace App\Classes\Process\Contracts;


use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Log;
use Symfony\Component\CssSelector\CssSelectorConverter;

abstract class AbstractDOMDocument
{
    protected $context;


    public function getDocument($data, $selector)
    {

        $document = new DOMDocument();
        libxml_use_internal_errors(true);

        if (!empty($data)) {
            $document->loadHTML($data);
        } else {
            Log::info('Структура сайта пустая');

        }

        $xpath = new DOMXPath($document);
        $converter = new CssSelectorConverter();
        $conv = $converter->toXPath($selector);
        $elements = $xpath->query($conv);

        return $elements;
    }
}
