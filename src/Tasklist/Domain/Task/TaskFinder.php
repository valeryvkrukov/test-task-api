<?php

namespace TodoList\Api\Tasklist\Domain\Task;


use TodoList\Api\Shared\Domain\Task\TaskId;

class TaskFinder
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    
    public function findById(TaskId $id): ?Task
    {
        return $this->taskRepository->getById($id);
    }
}