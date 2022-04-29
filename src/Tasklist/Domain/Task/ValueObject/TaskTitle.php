<?php

namespace TodoList\Api\Tasklist\Domain\Task\ValueObject;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;
use TodoList\Api\Shared\Domain\ValueObject\ValueObjectBase;

class TaskTitle extends ValueObjectBase implements \Stringable
{
    protected static function defineConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraints\Length(['max' => 60]),
        ];
    }
}