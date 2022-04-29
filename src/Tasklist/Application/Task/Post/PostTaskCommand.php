<?php

namespace TodoList\Api\Tasklist\Application\Task\Post;


use TodoList\Api\Auth\Domain\User\ValueObject\TokenValue;
use TodoList\Api\Tasklist\Domain\Task\ValueObject\TaskAssignDate;
use TodoList\Api\Tasklist\Domain\Task\ValueObject\TaskTitle;
use TodoList\Api\Shared\Domain\Task\TaskId;
use TodoList\Api\Infrastructure\Api\Bus\Command\Command;

class PostTaskCommand implements Command
{
    private TaskId $id;
    private TaskTitle $title;
    private TaskAssignDate $assignDate;
    private TokenValue $token;

    public function __construct(string $id, string $title, string $assignDate, string $token)
    {
        $this->id = TaskId::fromString($id);
        $this->title = new TaskTitle($title);
        $this->assignDate = new TaskAssignDate($assignDate);
        $this->token = new TokenValue($token);
    }

    public function getId(): TaskId
    {
        return $this->id;
    }

    public function getTitle(): TaskTitle
    {
        return $this->title;
    }

    public function getAssignDate(): TaskAssignDate
    {
        return $this->releaseDate;
    }
    
    public function getToken(): TokenValue
    {
        return $this->token;
    }
}