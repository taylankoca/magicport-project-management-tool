<?php
// app/Repositories/ProjectRepository.php
namespace App\Repositories;

use App\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface {
    public function getAllProjects() {
        return Project::all();
    }

    public function getProjectById($projectId) {
        return Project::find($projectId);
    }

    public function deleteProject($projectId) {
        return Project::destroy($projectId);
    }

    public function createProject(array $data) {
        return Project::create($data);
    }

    public function updateProject($projectId, array $data) {
        $project = Project::find($projectId);
        $project->update($data);
        return $project;
    }
}
