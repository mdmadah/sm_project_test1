<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'firstname' => "keerarat",
            'lastname' => "maskasem",
            'nt_id' => "4",
            'position_id' => "1",
            'email' => "keerarat@admin.com",
            'password' => "admin1234",
        ],
        [
            'firstname' => "areeyaporn",
            'lastname' => "sornkshetrin",
            'nt_id' => "4",
            'position_id' => "1",
            'email' => "areeyaporn@admin.com",
            'password' => "admin1234",
        ],
        [
            'firstname' => "charles",
            'lastname' => "jones",
            'nt_id' => "5",
            'position_id' => "2",
            'email' => "charles@jones.com",
            'password' => "charles1234",
        ],
        [
            'firstname' => "samara",
            'lastname' => "young",
            'nt_id' => "4",
            'position_id' => "3",
            'email' => "samara@young.com",
            'password' => "samara1234",
        ]);

    }
}
