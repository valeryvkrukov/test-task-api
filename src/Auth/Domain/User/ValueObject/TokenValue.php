<?php

namespace TodoList\Api\Auth\Domain\User\ValueObject;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints;
use TodoList\Api\Shared\Domain\ValueObject\ValueObjectBase;

class TokenValue extends ValueObjectBase
{
    public const BYTES_LENGTH = 32;
    public const HEX_LENGTH = 64;
    
    protected static function defineConstraints(): array
    {
        return [
            new Constraints\NotBlank(),
            new Constraints\Length([
                'min' => self::HEX_LENGTH,
                'max' => self::HEX_LENGTH
            ]),
        ];
    }
}