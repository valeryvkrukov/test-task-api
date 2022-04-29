<?php

namespace TodoList\Api\Tasklist\Domain\Task;


use TodoList\Api\Tasklist\Application\Task\TaskAssembler;

class TaskResultSet
{
    private array $tasks;
    private int $total;

    public function __construct(array $tasks, int $total)
    {
        $this->tasks = $tasks;
        $this->total = $total;
    }

    public function getTasks(): array
    {
        $tasks = [];

        foreach ($this->tasks as $task) {
            if ($task instanceof Task) {
                $tasks[] = TaskAssembler::fromEntityToResponse($task);
            } else {
                $tasks[] = TaskAssembler::fromArrayToResponse($task);
            }
        }

        return $tasks;
    }
    
    public function getTotal(): int
    {
        return $this->total;
    }
}