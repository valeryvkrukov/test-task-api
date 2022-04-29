<?php

namespace TodoList\Api\Auth\Domain\User\ValueObject;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;
use TodoList\Api\Shared\Domain\ValueObject\ValueObjectBase;

class UserPassword extends ValueObjectBase
{
    protected static function defineConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraints\Length(['min' => 10, 'max' => 255]),
        ];
    }
}