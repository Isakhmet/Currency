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
                    'name' => 'Банк Центр Кредит',
                    'created_at' => $date
                ],
                [
                    'name' => 'МиГ',
                    'created_at' => $date
                ],
                [
                    'name' => 'Нурбанк',
                    'created_at' => $date
                ],
                [
                    'name' => 'Банк РБК',
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
