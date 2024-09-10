<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->words(4, true),
            'status' => 'todo', // Default status (can be overridden in seeder)
            'project_id' => null, // Will be set in the seeder
        ];
    }
}
