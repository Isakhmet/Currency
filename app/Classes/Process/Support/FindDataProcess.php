<?php


namespace App\Classes\Process\Support;

use App\Classes\Process\Contracts\AbstractContextProcess;
use App\Classes\Process\ProcessContext;

class FindDataProcess extends AbstractContextProcess
{


    protected $company_id;
    protected $exchange_type_id;

    /**
     * FindDataProcess constructor.
     * @param ProcessContext $context
     * @param integer $company_id
     * @param integer $exchange_type_id
     */
    public function __construct($context, $company_id, $exchange_type_id)
    {
        $this->company_id = $company_id;
        $this->exchange_type_id = $exchange_type_id;
        parent::__construct($context);
    }

    public function run()
    {
        $context = $this->context;

        $company = null;
        if ($this->company_id) {
            $company = $context->getCompanyModel()->find($this->company_id);
        }

        $exchangeType = null;
        if ($this->exchange_type_id) {
            $exchangeType = $context->getExchangeTypeModel()->find($this->exchange_type_id);
        }
        $companyLink = null;
        if ($this->company_id && $this->exchange_type_id) {
            $companyLink = $context->getCompanyLinkModel()
                ->where('company_id', $this->company_id)
                ->where('exchange_type_id', $this->exchange_type_id)
                ->get();
        }

        if (!$company) {
            throw new \RuntimeException('invalid company id');
        }

        if (!$exchangeType) {
            throw new \RuntimeException('invalid exchange type id');
        }


        $context->setCompany($company);
        $context->setExchangeType($exchangeType);
        $context->setCompanyLink($companyLink);

        return $context;
    }

}
