<?php

namespace TodoList\Api\Tasklist\Domain\Task;


use TodoList\Api\Tasklist\Application\Task\Criteria;
use TodoList\Api\Tasklist\Domain\Task\Exception\TaskAlreadyExists;
use TodoList\Api\Tasklist\Domain\Task\Exception\TaskNotFound;
use TodoList\Api\Shared\Domain\Task\TaskId;

interface TaskRepository
{
    public function getById(TaskId $id): ?Task;
    
    public function getAll(): TaskResultSet;
    
    public function getMatching(Select $select, Criteria $criteria): TaskResultSet;
    
    public function post(Task $task): void;
    
    public function delete(Task $task): void;
    
    public function put(Task $task): void;
    
    public function patch(Task $task): void;
}