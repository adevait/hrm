<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'currency_code' => 'EUR',
                'currency_display' => 'EUR',
            ],
            [
                'currency_code' => 'USD',
                'currency_display' => 'USD',
            ],
            [
                'currency_code' => 'MKD',
                'currency_display' => 'MKD',
            ],
        ]);
    }
}
