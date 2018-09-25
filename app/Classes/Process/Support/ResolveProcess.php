<?php


namespace App\Classes\Process\Support;

use App\Classes\Process\Contracts\AbstractContextProcess;

class ResolveProcess extends AbstractContextProcess
{
    public function run()
    {
        $context = $this->context;

        $company_code = $this->getContext()->getCompany()->code;
        $exchange_type_code = $this->getContext()->getExchangeType()->name;

        if (!$company_code) {
            throw new \RuntimeException('invalid bank code');
        }

        if (!$exchange_type_code) {
            throw new \RuntimeException('invalid exchange type name');
        }

        if ($company_code == 'nbr' || $company_code == 'kase') {
            $context->setIsExchange(false);
        } else {
            $context->setIsExchange(true);
        }

        $config = config("parser.{$company_code}.{$exchange_type_code}");

        if (!$config || !is_array($config) || !isset($config['parser'], $config['checker'])) {
            throw new \RuntimeException("$company_code invalid config 'parser.{$company_code}.{$exchange_type_code}' ");
        }

        if (!class_exists($config['parser'])) {
            throw new \RuntimeException("$company_code class {$config['parser']} not exists");
        }

        if (!class_exists($config['checker'])) {
            throw new \RuntimeException("$company_code class {$config['checker']} not exists");
        }

        $context->setParser(app($config['parser']));
        $context->setChecker(app($config['checker']));
        $context->setMethod($config['method']);

        return $context;
    }

}
