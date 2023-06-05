<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\GroupCategory::factory(10)->create();
        \App\Models\OfferCategory::factory(10)->create();
        \App\Models\City::factory(10)->create();
        \App\Models\News::factory(10)->create();

        \App\Models\User::factory(10)
            ->has(\App\Models\Company::factory()->count(2))
            ->has(\App\Models\Group::factory()->count(3))
            ->has(\App\Models\Resume::factory()->count(4))
            ->create();     

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Experience::factory()->count(5)
            ->sequence(
                ['resume_id' => rand(1, 10)],
                ['resume_id' => rand(1, 10)],
                ['resume_id' => rand(1, 10)],
            )
            ->create();

        \App\Models\CompanyOffer::factory()->count(30)
            ->sequence(
                ['offer_category_id' => rand(1, 10), 'company_id' => rand(1, 20)],
                ['offer_category_id' => rand(1, 10), 'company_id' => rand(1, 20)],
                ['offer_category_id' => rand(1, 10), 'company_id' => rand(1, 20)],
            )
            ->create();

        \App\Models\Vacancy::factory()->count(6)
            ->sequence(
                ['parent_type' => 'App\Models\Company'],
                ['parent_type' => 'App\Models\Group'],
                ['parent_type' => 'App\Models\User'],
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
    }
}
