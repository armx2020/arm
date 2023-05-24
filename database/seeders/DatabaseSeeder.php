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

         \App\Models\User::factory(10)
                        ->has(\App\Models\Company::factory()->count(5))
                        ->has(\App\Models\Group::factory()->count(5))
                        ->has(\App\Models\Resume::factory()->count(5))
                        ->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\City::factory(3)->create();

        \App\Models\News::factory(3)->create();

        \App\Models\OfferCategory::factory(3)->create();

        \App\Models\CompanyOffer::factory()->count(6)
                    ->sequence(
                        ['offer_category_id' => rand(1, 3), 'company_id' => rand(1, 5)],
                    )
                    ->create();

        \App\Models\Vacancy::factory()->count(6)
                    ->sequence(
                        ['parenttable_type' => 'company'], ['parenttable_type' => 'group'], ['parenttable_type' => 'user'],
                    )
                    ->create();

        \App\Models\Project::factory()->count(6)
                    ->sequence(
                        ['parenttable_type' => 'company'], ['parenttable_type' => 'group'], ['parenttable_type' => 'user'],
                    )
                    ->create();

        \App\Models\Event::factory()->count(6)
                    ->sequence(
                        ['parenttable_type' => 'company'], ['parenttable_type' => 'group'], ['parenttable_type' => 'user'],
                    )
                    ->create();
    }
}
