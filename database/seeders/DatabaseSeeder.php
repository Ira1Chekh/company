<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Project;
use App\Models\User;
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
         Company::factory(5)->create();
         User::factory(10)->create();
         Project::factory(10)->withUsers(2)->create();
    }
}
