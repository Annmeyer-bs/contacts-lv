<?php

namespace Database\Seeders;

use App\Models\User;
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
//        User::factory(500)->create();
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' =>  Str::random(10) + @gmail.com,
            'adress' => Str::random(10),
            'photo' => Str::random(10),
            'password' => bcrypt('111'),
        ]);
//        DB::table('users')->insert([
//            'name' => 'Lone Doe',
//            'email' => 'r.bd@gmail.com',
//            'adress' => 'Ukraine, Zaporozhye',
//            'photo' => '',
//            'password' => bcrypt('111'),
//        ]);
//        DB::table('users')->insert([
//            'name' => 'Leo Doe',
//            'email' => 'anr.bd@gmail.com',
//            'adress' => 'Ukraine, Kharkiv',
//            'photo' => '',
//            'password' => bcrypt('111'),
//        ]);
//        DB::table('users')->insert([
//            'name' => 'John Doe',
//            'email' => 'run.bd@gmail.com',
//            'adress' => 'Ukraine, Zaporozhye',
//            'photo' => '',
//            'password' => bcrypt('111'),
//        ]);
    }
}
