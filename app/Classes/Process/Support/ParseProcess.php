<?php


namespace App\Classes\Process\Support;


use App\Classes\Process\Contracts\AbstractContextProcess;

class ParseProcess extends AbstractContextProcess
{
    public function run()
    {
        $context = $this->context;
        $results = ($context->getParser())->parse($context->getStructure());

        if ($results) {
            $context->setResults($results);
        }

        return $context;
    }

}
