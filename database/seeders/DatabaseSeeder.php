<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Child;
use App\Models\Sponsor;
use App\Models\Widow;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

       /*  \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'test@admin.com',
         ]);*/

       Widow::factory()
            ->has(Child::factory()
                ->has(Sponsor::factory())
                ->count(2))
            ->count(100)
            ->create();

    }
}
