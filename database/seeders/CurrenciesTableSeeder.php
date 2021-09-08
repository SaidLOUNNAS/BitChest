<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'logo'      => 'img/' . Str::kebab($name) . '.png',
                'api_id'    => $api_id
            ]);
        }
    }
}
