<?php

namespace TodoList\Api\Tasklist\Domain\Worker\ValueObject;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;
use TodoList\Api\Shared\Domain\ValueObject\ValueObjectBase;

class WorkerAddingDate extends ValueObjectBase
{
    public const FORMAT = 'Y-m-d H:i:s';

    protected static function defineConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraints\DateTime(),
        ];
    }
}