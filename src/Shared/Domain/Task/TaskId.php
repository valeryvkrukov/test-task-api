<?php

namespace TodoList\Api\Shared\Domain\Task;


use TodoList\Api\Shared\Domain\ValueObject\UuidValueObject;

class TaskId extends UuidValueObject
{
    public function toString(): string
    {
        return $this->toRfc4122();
    }
}