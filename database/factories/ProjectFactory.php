<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }

    public function withUsers($count = 1): self
    {
        return $this->afterCreating(fn (Project $project) => $project->users()->attach(
            User::query()->inRandomOrder()->take($count)->get()
        ));
    }
}
