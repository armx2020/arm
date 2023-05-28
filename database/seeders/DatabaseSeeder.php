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

        \App\Models\GroupCategory::factory(100)->create();

        \App\Models\User::factory(10)
            ->has(\App\Models\Company::factory()->count(15))
            ->has(\App\Models\Group::factory()->count(15))
            ->has(\App\Models\Resume::factory()->count(15))
            ->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\City::factory(10)->create();

        \App\Models\News::factory(10)->create();

        \App\Models\OfferCategory::factory(30)->create();

        \App\Models\CompanyOffer::factory()->count(60)
            ->sequence(
                ['offer_category_id' => rand(1, 30), 'company_id' => rand(1, 15)],
            )
            ->create();

        \App\Models\Vacancy::factory()->count(16)
            ->sequence(
                ['parent_type' => 'App\Models\Company'],
                ['parent_type' => 'App\Models\Group'],
                ['parent_type' => 'App\Models\User'],
            )
            ->create();

        \App\Models\Project::factory()->count(16)
            ->sequence(
                ['parent_type' => 'App\Models\Company'],
                ['parent_type' => 'App\Models\Group'],
                ['parent_type' => 'App\Models\User'],
            )
            ->create();

        \App\Models\Event::factory()->count(16)
            ->sequence(
                ['parent_type' => 'App\Models\Company'],
                ['parent_type' => 'App\Models\Group'],
                ['parent_type' => 'App\Models\User'],
            )
            ->create();
    }
}
