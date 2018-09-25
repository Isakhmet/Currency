<?php

use Illuminate\Database\Seeder;

/**
 * Class CompanySeeder
 */
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\Company::all()->count() === 0) {

            $date = date('Y-m-d H:i:s');

            $data = [
                [
                    'name' => 'Банк ЦентрКредит',
                    'code' => 'bcc',
                    'type' => 'bank',
                    'created_at' => $date
                ],
                [
                    'name' => 'МиГ',
                    'code' => 'mig',
                    'type' => 'exchange',
                    'created_at' => $date
                ],
                [
                    'name' => 'Нурбанк',
                    'code' => 'nur',
                    'type' => 'bank',
                    'created_at' => $date
                ],
                [
                    'name' => 'Bank RBK',
                    'code' => 'rbk',
                    'type' => 'bank',
                    'created_at' => $date
                ],
                [
                    'name' => 'Национальный Банк',
                    'code' => 'nbr',
                    'type' => '',
                    'created_at' => $date
                ],
                [
                    'name' => 'Евразийский Банк',
                    'code' => 'eub',
                    'type' => 'bank',
                    'created_at' => $date
                ],
                [
                    'name' => 'Сбербанк',
                    'code' => 'sber',
                    'type' => 'bank',
                    'created_at' => $date
                ],
                [
                    'name' => 'Казахстанская фондовая биржа',
                    'code' => 'kase',
                    'type' => '',
                    'created_at' => $date
                ],
            ];
            /** @noinspection PhpUndefinedMethodInspection */
            \App\Models\Company::insert($data);
            $this->command->info('Таблица компаний заполнена');
        } else {
            $this->command->warn('Таблица компаний уже заполнена');
        }
    }
}
