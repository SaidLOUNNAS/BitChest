<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user
        User::factory()->count(10)->create();
         // create Admin
        DB::table('users')->insert(array([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email'=>'admin@admin.com',
            'status' => 'admin',
            'password'=>Hash::make('AdminAdmin'),
        ],
        [
            'first_name' => 'customer',
            'last_name' => 'customer',
            'email'=>'customer@customer.com',
            'status' => 'client',
            'password'=>Hash::make('CustomerCustomer'),


        ]));

    }
}
