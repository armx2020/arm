<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Category::factory(10)->create();
        \App\Models\News::factory(10)->create();

        \App\Models\User::factory(100)
            ->has(\App\Models\Company::factory()->count(2))
            ->has(\App\Models\Group::factory()->count(3))
            ->create();     

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\Experience::factory()->count(5)
        //     ->sequence(
        //         ['resume_id' => rand(1, 10)],
        //         ['resume_id' => rand(1, 10)],
        //         ['resume_id' => rand(1, 10)],
        //     )
        //     ->create();

        \App\Models\CompanyOffer::factory()->count(30)
            ->sequence(
                ['category_id' => rand(1, 10), 'company_id' => rand(1, 20)],
                ['category_id' => rand(1, 10), 'company_id' => rand(1, 20)],
                ['category_id' => rand(1, 10), 'company_id' => rand(1, 20)],
            )
            ->create();

        \App\Models\Project::factory()->count(6)
            ->sequence(
                ['parent_type' => 'App\Models\Company'],
                ['parent_type' => 'App\Models\Group'],
                ['parent_type' => 'App\Models\User'],
            )
            ->create();

        \App\Models\Event::factory()->count(6)
            ->sequence(
                ['parent_type' => 'App\Models\Company'],
                ['parent_type' => 'App\Models\Group'],
                ['parent_type' => 'App\Models\User'],
            )
            ->create();

            DB::table('group_user')->insert(['group_id' => 1, 'user_id' => 1]);
            DB::table('group_user')->insert(['group_id' => 2, 'user_id' => 2]);
            DB::table('group_user')->insert(['group_id' => 3, 'user_id' => 3]);
    }
}
