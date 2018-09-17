<?php

use Illuminate\Database\Seeder;

class ExchangeDifferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\ExchangeDifference::all()->count() === 0) {

            $data = [
                [
                    'currency_id' => 5,
                    'value' => 367.52,
                    'change' => 2.29,
                    'created_at' => '2018-09-05'
                ],
                [
                    'currency_id' => 5,
                    'value' => 369.89,
                    'change' => 2.37,
                    'created_at' => '2018-09-06'
                ],
                [
                    'currency_id' => 5,
                    'value' => 372.23,
                    'change' => 2.34,
                    'created_at' => '2018-09-07'
                ],
                [
                    'currency_id' => 5,
                    'value' => 375.62,
                    'change' => 3.39,
                    'created_at' => '2018-09-10'
                ],
                [
                    'currency_id' => 5,
                    'value' => 378.11,
                    'change' => 2.49,
                    'created_at' => '2018-09-11'
                ],
                [
                    'currency_id' => 6,
                    'value' => 424.74,
                    'change' => 1.18,
                    'created_at' => '2018-09-05'
                ],
                [
                    'currency_id' => 6,
                    'value' => 428,
                    'change' => 3.26,
                    'created_at' => '2018-09-06'
                ],
                [
                    'currency_id' => 6,
                    'value' => 432.53,
                    'change' => 4.53,
                    'created_at' => '2018-09-07'
                ],
                [
                    'currency_id' => 6,
                    'value' => 437,
                    'change' => 4.47,
                    'created_at' => '2018-09-10'
                ],
                [
                    'currency_id' => 6,
                    'value' => 437.62,
                    'change' => 0.62,
                    'created_at' => '2018-09-11'
                ],
                [
                    'currency_id' => 15,
                    'value' => 5.38,
                    'change' => 0,
                    'created_at' => '2018-09-05'
                ],
                [
                    'currency_id' => 15,
                    'value' => 5.4,
                    'change' => 0.02,
                    'created_at' => '2018-09-06'
                ],
                [
                    'currency_id' => 15,
                    'value' => 5.45,
                    'change' => 0.05,
                    'created_at' => '2018-09-07'
                ],
                [
                    'currency_id' => 15,
                    'value' => 5.45,
                    'change' => 0,
                    'created_at' => '2018-09-10'
                ],
                [
                    'currency_id' => 15,
                    'value' => 5.41,
                    'change' => -0.04,
                    'created_at' => '2018-09-11'
                ],

            ];
            /** @noinspection PhpUndefinedMethodInspection */
            \App\Models\ExchangeDifference::insert($data);
            $this->command->info('Таблица разницы валют заполнена');
        } else {
            $this->command->warn('Таблица разницы валют уже заполнена');
        }
    }
}
