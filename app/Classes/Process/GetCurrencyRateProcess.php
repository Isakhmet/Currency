<?php


namespace App\Classes\Process;


use App\Classes\Process\Support\CheckProcess;
use App\Classes\Process\Support\GetDataProcess;
use App\Classes\Process\Support\ParseProcess;
use App\Classes\Process\Support\ResolveProcess;
use App\Classes\Process\Support\SaveProcess;
use Illuminate\Support\Facades\Log;

class GetCurrencyRateProcess
{

    protected $context;
    protected $company_id;
    protected $exchange_type_id;

    public function __construct(
        ProcessContext $context,
        $company_id,
        $exchange_type_id
    )
    {
        $this->context = $context;
        $this->company_id = $company_id;
        $this->exchange_type_id = $exchange_type_id;
    }

    public function run()
    {
        $context = $this->context;

        try {
            $context = (new ResolveProcess($context))->run();
            $context = (new GetDataProcess($context))->run();

            $context = (new CheckProcess($context))->run();

            $context = (new ParseProcess($context))->run();
            $context = (new SaveProcess($context))->run();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage(), $exception);
        }

        return $context;
    }

}
