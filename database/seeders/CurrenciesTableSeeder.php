<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
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
        foreach (config('cryptocurrencies_list') as $api_id => $name) {
            DB::table('currencies')->insert([
                'name'      => $name,
                'api_id'    => $api_id
            ]);
        }
    }
}
