<?php


namespace App\Classes\Process\Support;


use App\Classes\Process\Contracts\AbstractContextProcess;

class CheckProcess extends AbstractContextProcess
{
    public function run()
    {
        $context = $this->context;

        ($context->getChecker())->check($context->getStructure());

        return $context;
    }
}
