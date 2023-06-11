<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'login' => 'root',
            'password' => Hash::make('root'),
        ]);
        DB::table('admins')->insert([
            'login' => 'root1',
            'password' => Hash::make('root'),
        ]);
    }
}
