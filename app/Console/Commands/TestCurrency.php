<?php

namespace App\Console\Commands;


use App\Classes\Process\GetCurrencyRateProcess;
use App\Classes\Process\ProcessContext;
use App\Models\CompanyLink;
use Illuminate\Console\Command;

class TestCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = CompanyLink::get(['company_id', 'exchange_type_id'])->toArray();

        foreach ($model as $data) {
            $gcrp = new GetCurrencyRateProcess(new ProcessContext(), $data['company_id'], $data['exchange_type_id']);
            $gcrp->run();
        }
    }
}
