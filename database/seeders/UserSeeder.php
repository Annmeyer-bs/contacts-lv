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
        DB::table('users')->insert([
            'name' => 'Lita Binar',
            'email' => 'hr.bd@gmail.com',
            'adress' => 'Ukraine, Kharkiv',
            'photo' => '',
            'password' => bcrypt('111'),
        ]);
        DB::table('users')->insert([
            'name' => 'Lone Doe',
            'email' => 'r.bd@gmail.com',
            'adress' => 'Ukraine, Zaporozhye',
            'photo' => '',
            'password' => bcrypt('111'),
        ]);
        DB::table('users')->insert([
            'name' => 'Leo Doe',
            'email' => 'anr.bd@gmail.com',
            'adress' => 'Ukraine, Kharkiv',
            'photo' => '',
            'password' => bcrypt('111'),
        ]);
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'run.bd@gmail.com',
            'adress' => 'Ukraine, Zaporozhye',
            'photo' => '',
            'password' => bcrypt('111'),
        ]);
    }
}
