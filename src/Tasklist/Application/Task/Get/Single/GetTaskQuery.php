<?php

namespace TodoList\Api\Tasklist\Application\Task\Get\Single;


use TodoList\Api\Shared\Domain\Task\TaskId;
use TodoList\Api\Infrastructure\Api\Bus\Query\SyncQuery;

class GetTaskQuery implements SyncQuery
{
    private TaskId $id;
    
    public function __construct(string $id)
    {
        $this->id = new TaskId($id);
    }
    
    public function id(): TaskId
    {
        return $this->id;
    }
}