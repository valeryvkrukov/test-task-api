<?php

namespace TodoList\Api\Tasklist\Domain\Worker\ValueObject;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;
use TodoList\Api\Shared\Domain\ValueObject\ValueObjectBase;

class WorkerName extends ValueObjectBase
{
    protected static function defineConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraints\Length(['min' => 1, 'max' => 255]),
        ];
    }
}