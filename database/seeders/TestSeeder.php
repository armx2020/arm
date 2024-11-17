<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'firstname' => 'Севак',
            'email' => 'armxgm@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$nEWrsey19h5.SM5hfLi5peK4xKHLQu6ADEsNBcs9IU30aplkN6DZW',
            'remember_token' => 'cCdEH9jqG9Y5wgocFdL6ooi0hkFVP5bILgmkANX41Nrx7EIT40Clnf2Ch3b1',
            'phone' => '+7 (978) 220-50-08',
            'city_id' => 1121,
            'region_id' => 1
        ]);

        DB::table('users')->insert([
            'firstname' => 'Тамара',
            'email' => 'tamara.sargsyan.97@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$TY80IHAQ5vEaCb68c7uosORIZyGubaVD2SpFVzpLbnuDy2n6rTYJW',
            'remember_token' => 'gQgbaQmOyelDK2ztTvvYBemHda07z9HaZNKMwCd9HPwRzI4Bxul7ZoeSPxjd',
            'phone' => '+7 (634) 349-99-99',
            'city_id' => 1,
            'region_id' => 1
        ]);

        DB::table('users')->insert([
            'firstname' => 'Арсен',
            'email' => 'manasyan.a.s@ya.ru',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'gQgbaQmOyelDK2ztTvvYBemHda07z9HaZNKMwCd9HPwRzI4Bxul7ZoeSPxjd',
            'phone' => '+7 (939) 752-44-10',
            'city_id' => 1,
            'region_id' => 1
        ]);
    }
}