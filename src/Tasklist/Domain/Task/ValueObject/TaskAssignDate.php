<?php

namespace TodoList\Api\Tasklist\Domain\Task\ValueObject;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;
use TodoList\Api\Shared\Domain\ValueObject\ValueObjectBase;

class TaskAssignDate extends ValueObjectBase implements \Stringable
{
    public const FORMAT = 'Y-m-d H:i:s';

    protected static function defineConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraints\DateTime(),
        ];
    }

    public function __toString(): string
    {
        $this->value;
    }
}