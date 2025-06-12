<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["name" => "Adm da Silva", "email" => "adm@gmail.com", "password" => Hash::make("12345678"), "role" => "admin"],
        ];
        DB::table('users')->insert($data);
    }
}
