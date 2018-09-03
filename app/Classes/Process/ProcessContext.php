<?php


namespace App\Classes\Process;

class ProcessContext
{

    protected $is_exchange;

    protected $structure;

    protected $results;

    protected $parser;

    protected $checker;

    protected $currency = 'App\Models\Currency';

    protected $exchangeRateModel = 'App\Models\ExchangeRate';

    protected $exchangeTypeModel = 'App\Models\ExchangeType';

    protected $companyLinkModel = 'App\Models\CompanyLink';

    protected $companyModel = 'App\Models\Company';

    protected $company = null;

    protected $exchangeType = null;

    protected $companyLink = null;

    protected $method = null;

    /**
     * @return null
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param null $method
     */
    public function setMethod($method): void
    {
        $this->method = $method;
    }

    /**
     * @return mixed
     */
    public function getIsExchange()
    {
        return $this->is_exchange;
    }

    /**
     * @param mixed $is_exchange
     */
    public function setIsExchange($is_exchange): void
    {
        $this->is_exchange = $is_exchange;
    }

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
     * @param \App\Classes\Process\Contracts\CheckerInterface $checker
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
    public function getExchangeRateModel()
    {
        return app($this->exchangeRateModel);
    }

    /**
     * @return \App\Models\ExchangeType
     */
    public function getExchangeTypeModel()
    {
        return app($this->exchangeTypeModel);
    }

    /**
     * @return \App\Models\CompanyLink
     */
    public function getCompanyLink()
    {
        return $this->companyLink;
    }

    /**
     * @param null $companyLink
     */
    public function setCompanyLink($companyLink): void
    {
        $this->companyLink = $companyLink;
    }

    /**
     * @return \App\Models\Company
     */
    public function getCompanyModel()
    {
        return app($this->companyModel);
    }

    /**
     * @return null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param null $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }

    /**
     * @return null
     */
    public function getExchangeType()
    {
        return $this->exchangeType;
    }

    /**
     * @return string
     */
    public function getCompanyLinkModel()
    {
        return app($this->companyLinkModel);
    }

    /**
     * @param null $exchangeType
     */
    public function setExchangeType($exchangeType): void
    {
        $this->exchangeType = $exchangeType;
    }

    /**
     * @return mixed
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * @param mixed $structure
     */
    public function setStructure($structure): void
    {
        $this->structure = $structure;
    }

    /**
     * @return mixed
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param mixed $results
     */
    public function setResults($results): void
    {
        $this->results = $results;
    }

}
