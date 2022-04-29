<?php

namespace TodoList\Api\Tasklist\Application\Task\Post;


use TodoList\Api\Tasklist\Domain\Task\Task;
use TodoList\Api\Tasklist\Domain\Task\TaskRepository;
use TodoList\Api\Shared\Application\Service\ApplicationService;
use TodoList\Api\Shared\Application\Service\Request;
use TodoList\Api\Shared\Application\Service\Response;
use TodoList\Api\Infrastructure\Api\Bus\Event\EventPublisher;

class TaskCreator implements ApplicationService
{
    private TaskRepository $taskRepository;
    private EventPublisher $publisher;

    public function __construct(TaskRepository $taskRepository, EventPublisher $publisher)
    {
        $this->taskRepository = $taskRepository;
        $this->publisher = $publisher;
    }

    public function execute(PostTaskCommand|Request $request): ?Response
    {
        $task = Task::create(
            id: $request->getId(),
            title: $request->getTitle(),
            releaseDate: $request->getAssignDate(),
        );
        
        $this->taskRepository->post($task);
        $this->publisher->publish(...$task->dropEvents());
        
        return null;
    }
}