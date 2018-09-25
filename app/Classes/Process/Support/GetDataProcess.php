<?php


namespace App\Classes\Process\Support;


use App\Classes\Process\Contracts\AbstractContextProcess;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class GetDataProcess extends AbstractContextProcess
{
    public function run()
    {
        $context = $this->context;


        $company_link = $context->getCompanyLink()[0]->url;
        $client = new Client();
        try {
            $structure = $client->request($context->getMethod(), $company_link, ['verify' => false,]);

            if (empty($structure->getBody())) {
                throw new \RuntimeException('Структура сайта пустая');
            }
            $context->setStructure($structure->getBody());

        } catch (GuzzleException $guzzleException) {
            Log::error($guzzleException->getMessage());
        }
        return $context;
    }

}
