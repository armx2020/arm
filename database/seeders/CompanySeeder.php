<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Add company*/
        DB::table('companies')->insert([
            'name' => 'Тест компания',
            'city_id' => 1,
            'region_id' => 1,
            'user_id' => 1,
        ]);

        /* Add action*/
        DB::table('actions')->insert([
            'name' => 'Тестируем',
            'price' => 777
        ]);

        /* Add action*/
        DB::table('action_company')->insert([
            'action_id' => 1,
            'company_id' => 1
        ]);
    }
}
