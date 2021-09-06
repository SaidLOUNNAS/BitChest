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
        DB::table('user')->insert([
            'first_name'=>'admin',
            'email'=>'said.lounnas1@gmail.com',
            'password'=>Hash::make('AdminAdmin')
          ]);

    }
}
