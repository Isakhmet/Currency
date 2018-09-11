<?php

use Illuminate\Database\Seeder;

class ExchangeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\ExchangeType::all()->count() === 0) {

            $date = date('Y-m-d H:i:s');

            $data = [
                [
                    'title' => 'Наличный',
                    'name' => 'cash',
                    'created_at' => $date
                ],
                [
                    'title' => 'По платежным карточкам',
                    'name' => 'card',
                    'created_at' => $date
                ],
                [
                    'title' => 'Безналичный',
                    'name' => 'transfer',
                    'created_at' => $date
                ],

            ];
            /** @noinspection PhpUndefinedMethodInspection */
            \App\Models\ExchangeType::insert($data);
            $this->command->info('Таблица типов обмена заполнена');
        } else {
            $this->command->warn('Таблица типов обмена уже заполнена');
        }
    }
}
