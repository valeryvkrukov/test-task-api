<?php

namespace TodoList\Api\Tasklist\Application\Task\Get\Single;


use TodoList\Api\Tasklist\Application\Task\TaskAssembler;
use TodoList\Api\Tasklist\Domain\Task\TaskRepository;
use TodoList\Api\Shared\Application\Service\ApplicationService;
use TodoList\Api\Shared\Application\Service\Request;

class TaskSearcher implements ApplicationService
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(GetTaskQuery|Request $request): TaskResponse
    {
        $task = $this->taskRepository->getById(id: $request->id());
        
        $taskArray = ($task !== null) ? TaskAssembler::fromEntityToResponse($task) : [];
        
        return new TaskResponse($taskArray);
    }
}