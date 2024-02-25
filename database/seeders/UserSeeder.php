<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name' => 'Ahmed Elazony',
           'email' => 'ahmed@ahmedelazony.tech',
           'password' => Hash::make('helloworld'),
           'phone_number' => '012383403433'
        ]);

        DB::table('users')->insert([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('systemadmin'),
            'phone_number' => '12343479355'
        ]);
    }
}
