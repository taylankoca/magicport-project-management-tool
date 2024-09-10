<?php

// app/Repositories/TaskRepository.php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function getTasksByProjectId($projectId)
    {
        // Fetch tasks for a specific project ID
        return Task::where('project_id', $projectId)->get();
    }

    public function getTaskById($taskId)
    {
        return Task::find($taskId);
    }

    public function deleteTask($taskId)
    {
        return Task::destroy($taskId);
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function updateTask($taskId, array $data)
    {
        $task = Task::find($taskId);
        $task->update($data);
        return $task;
    }
}
