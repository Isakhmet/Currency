<?php

use Illuminate\Database\Seeder;

class CompanyLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\CompanyLink::all()->count() === 0) {

            $date = date('Y-m-d H:i:s');

            $data = [
                [
                    'url' => 'https://www.bcc.kz/about/kursy-valyut/',
                    'company_id' => '1',
                    'exchange_type_id' => '1',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'https://www.bcc.kz/about/kursy-valyut/',
                    'company_id' => '1',
                    'exchange_type_id' => '2',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'https://www.bcc.kz/about/kursy-valyut/',
                    'company_id' => '1',
                    'exchange_type_id' => '3',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'https://mig.kz/additional#main',
                    'company_id' => '2',
                    'exchange_type_id' => '1',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'http://nurbank.kz/currency',
                    'company_id' => '3',
                    'exchange_type_id' => '2',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'http://nurbank.kz/currency',
                    'company_id' => '3',
                    'exchange_type_id' => '3',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'https://www.bankrbk.kz/rus',
                    'company_id' => '4',
                    'exchange_type_id' => '3',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'http://www.nationalbank.kz/?furl=cursFull&switch=rus',
                    'company_id' => '5',
                    'exchange_type_id' => '1',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'https://www.eubank.kz/',
                    'company_id' => '6',
                    'exchange_type_id' => '1',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'https://www.eubank.kz/',
                    'company_id' => '6',
                    'exchange_type_id' => '2',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'https://www.sberbank.kz/ru/individuals/rates/currencies',
                    'company_id' => '7',
                    'exchange_type_id' => '1',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'https://www.sberbank.kz/ru/individuals/rates/currencies',
                    'company_id' => '7',
                    'exchange_type_id' => '3',
                    'currency_id' => null,
                    'created_at' => $date
                ],
                [
                    'url' => 'https://kase.kz/ru/currency/',
                    'company_id' => '8',
                    'exchange_type_id' => '1',
                    'currency_id' => null,
                    'created_at' => $date
                ],

            ];
            /** @noinspection PhpUndefinedMethodInspection */
            \App\Models\CompanyLink::insert($data);
            $this->command->info('Таблица ссылок компаний заполнена');
        } else {
            $this->command->warn('Таблица ссылок компаний уже заполнена');
        }

    }
}
