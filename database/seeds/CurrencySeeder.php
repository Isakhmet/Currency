<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\Currency::all()->count() === 0) {

            $date = date('Y-m-d H:i:s');

            $data = [
                [
                    'name' => 'AUD',
                    'title' => 'Австралийский доллар',
                    'sign' => '$',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'GBP',
                    'title' => 'Английский фунт стерлингов',
                    'sign' => '£',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'DKK',
                    'title' => 'Датская крона',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'AED',
                    'title' => 'Дирхам ОАЭ',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'USD',
                    'title' => 'Доллар США',
                    'sign' => '$',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'EUR',
                    'title' => 'Евро',
                    'sign' => '€',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'CAD',
                    'title' => 'Канадский доллар',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'CNY',
                    'title' => 'Китайский юань',
                    'sign' => '¥',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'KWD',
                    'title' => 'Кувейтский динар',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'KGS',
                    'title' => 'Кыргызский сом',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'LVL',
                    'title' => 'Латвийский лат',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'MDL',
                    'title' => 'Молдавский лей',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'NOK',
                    'title' => 'Норвежская крона',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'SAR',
                    'title' => 'Риял Саудовской Аравии',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'RUB',
                    'title' => 'Российский рубль',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'XDR',
                    'title' => 'СДР',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'SGD',
                    'title' => 'Сингапурский доллар ',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'TRL',
                    'title' => 'Турецкая лира',
                    'sign' => '',
                    'count' => 1000,
                    'created_at' => $date
                ],
                [
                    'name' => 'UZS',
                    'title' => 'Узбекский сум',
                    'sign' => '',
                    'count' => 100,
                    'created_at' => $date
                ],
                [
                    'name' => 'UAH',
                    'title' => 'Украинская гривна',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'SEK',
                    'title' => 'Шведская крона',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'CHF',
                    'title' => 'Швейцарский франк',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'EEK',
                    'title' => 'Эстонская крона',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'KRW',
                    'title' => 'Южно-корейский вон',
                    'sign' => '',
                    'count' => 100,
                    'created_at' => $date
                ],
                [
                    'name' => 'JPY',
                    'title' => 'Японская йена',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'BYN',
                    'title' => 'Белорусский рубль',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'PLN',
                    'title' => 'Польский злотый',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'ZAR',
                    'title' => 'Южно-африканский ранд',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'TRY',
                    'title' => 'Турецкая лира',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'HUF',
                    'title' => 'Венгерский форинт',
                    'sign' => '',
                    'count' => 10,
                    'created_at' => $date
                ],
                [
                    'name' => 'CZK',
                    'title' => 'Чешская крона',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'TJS',
                    'title' => 'Таджикский сомони',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'HKD',
                    'title' => 'Гонконгский доллар',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'BRL',
                    'title' => 'Бразильский реал',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'MYR',
                    'title' => 'Малазийский ринггит',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'AZN',
                    'title' => 'Азербайджанский манат',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'INR',
                    'title' => 'Индийская рупия',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'THB',
                    'title' => 'Тайский бат',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'AMD',
                    'title' => 'Армянский драм',
                    'sign' => '',
                    'count' => 10,
                    'created_at' => $date
                ],
                [
                    'name' => 'GEL',
                    'title' => 'Грузинский лари',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
                [
                    'name' => 'IRR',
                    'title' => 'Иранский риал',
                    'sign' => '',
                    'count' => 1000,
                    'created_at' => $date
                ],
                [
                    'name' => 'MXN',
                    'title' => 'Мексиканский песо',
                    'sign' => '',
                    'count' => 1,
                    'created_at' => $date
                ],
            ];
            /** @noinspection PhpUndefinedMethodInspection */
            \App\Models\Currency::insert($data);
            $this->command->info('Таблица валют заполнена');
        } else {
            $this->command->warn('Таблица валют уже заполнена');
        }
    }
}
