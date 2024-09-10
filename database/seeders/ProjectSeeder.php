<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 4 projects
        Project::factory()->count(4)->create()->each(function ($project) {
            // For each project, create 3 tasks with different statuses
            Task::factory()->create([
                'project_id' => $project->id,
                'status' => 'todo',
            ]);

            Task::factory()->create([
                'project_id' => $project->id,
                'status' => 'in-progress',
            ]);

            Task::factory()->create([
                'project_id' => $project->id,
                'status' => 'done',
            ]);
        });
    }
}
