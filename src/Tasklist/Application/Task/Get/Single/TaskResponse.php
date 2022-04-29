<?php

namespace TodoList\Api\Tasklist\Application\Task\Get\Single;


use TodoList\Api\Shared\Application\Service\Response;

class TaskResponse implements Response
{
    private array $task;

    public function __construct(array $task)
    {
        $this->task = $task;
    }

    public function getTotal(): int
    {
        return count($this->task);
    }

    public function toJson(): string
    {
        return json_encode(['data' => $this->task], JSON_THROW_ON_ERROR);
    }
}