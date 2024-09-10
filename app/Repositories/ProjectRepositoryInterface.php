<?php
// app/Repositories/ProjectRepositoryInterface.php
namespace App\Repositories;

interface ProjectRepositoryInterface {
    public function getAllProjects();
    public function getProjectById($projectId);
    public function deleteProject($projectId);
    public function createProject(array $data);
    public function updateProject($projectId, array $data);
}
