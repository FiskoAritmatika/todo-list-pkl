<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'name'=>'Fisko',
                'email'=>'fisko@gmail.com',
                'password'=>'fisko123'
            ],
            [
                'name'=>'Lutung',
                'email'=>'lutung@gmail.com',
                'password'=>'lutung123'
            ]
        ]);
    }
}
