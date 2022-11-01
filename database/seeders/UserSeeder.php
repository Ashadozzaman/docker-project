<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name'   => 'User',
            'is_admin'     => 0,
            'email'       => 'user@gmail.com',
            'password'    => bcrypt('user'),
        ]);
    }
}
