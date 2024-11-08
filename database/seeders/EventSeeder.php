<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Add categories for event*/
        DB::table('event_categories')->insert([
            'name' => 'Вечеринка',
            'sort_id' => 0,
            'created_at' => '2023-06-28 14:18:19',
            'updated_at' => '2023-06-28 14:18:19',
        ]);
        DB::table('event_categories')->insert([
            'name' => 'Разное',
            'sort_id' => 1,
            'created_at' => '2023-06-28 14:18:19',
            'updated_at' => '2023-06-28 14:18:19',
        ]);
    }
}
