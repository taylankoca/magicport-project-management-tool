<?php
// app/Repositories/ProjectRepository.php
namespace App\Repositories;

use App\Models\Project;
use App\Events\ProjectUpdated;

class ProjectRepository implements ProjectRepositoryInterface {
    public function getAllProjects() {
        return Project::all();
    }

    public function getProjectById($projectId) {
        return Project::find($projectId);
    }

    public function deleteProject($projectId) {
        event(new ProjectUpdated($projectId));
        return Project::destroy($projectId);
    }

    public function createProject(array $data) {
        event(new ProjectUpdated($data));
        return Project::create($data);
    }

    public function updateProject($projectId, array $data) {
        $project = Project::find($projectId);
        $project->update($data);

        // Dispatch ProjectUpdated event after the project is updated
        event(new ProjectUpdated($project));

        return $project;
    }
}
