<?php

// app/Repositories/TaskRepositoryInterface.php
namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function getTasksByProjectId($projectId);
    public function getTaskById($taskId);
    public function deleteTask($taskId);
    public function createTask(array $data);
    public function updateTask($taskId, array $data);
}
