<?php


namespace App\Classes\Process;

class ProcessContext
{


    protected $is_exchange;

    protected $dom;

    protected $results;

    protected $parser;

    protected $checker;

    protected $currency = 'App\Models\Currency';

    protected $exchangeRate = 'App\Models\ExchangeRate';

    protected $exchangeType = 'App\Models\ExchangeRate';

    protected $companyLink = 'App\Models\ExchangeRate';

    /**
     * @return \App\Classes\Process\Parser\ParserInterface
     */
    public function getParser()
    {
        return $this->parser;
    }

    /**
     * @param \App\Classes\Process\Parser\ParserInterface $parser
     */
    public function setParser($parser): void
    {
        $this->parser = $parser;
    }

    /**
     * @return \App\Classes\Process\Contracts\CheckerInterface
     */
    public function getChecker()
    {
        return $this->checker;
    }

    /**
     * @param boolean $checker
     */
    public function setChecker($checker): void
    {
        $this->checker = $checker;
    }

    /**
     * @return \App\Models\Currency
     */
    public function getCurrency()
    {
        return app($this->currency);
    }

    /**
     * @return \App\Models\ExchangeRate
     */
    public function getExchangeRate()
    {
        return app($this->exchangeRate);
    }

    /**
     * @return \App\Models\ExchangeType
     */
    public function getExchangeType()
    {
        return app($this->exchangeType);
    }

    /**
     * @return \App\Models\CompanyLink
     */
    public function getCompanyLink()
    {
        return app($this->companyLink);
    }


}
