<?php

namespace TodoList\Api\Shared\Domain\ValueObject;


use Symfony\Component\Validator\Validation;

abstract class ValueObjectBase
{
    protected mixed $value;
    
    public function __construct($value)
    {
        $this->value = $this->validateInput($value);
    }

    protected function validateInput($value)
    {
        $violations = Validation::createValidator()->validate($value, self::getConstraints());

        if (count($violations) > 0) {
            throw new RuntimeException(
                sprintf('%s Value: %s. Object: %s', $violations[0]->getMessage(), $value, self::class)
            );
        }

        return $value;
    }

    public static function getConstraints(): array
    {
        return static::defineConstraints();
    }

    abstract protected static function defineConstraints(): array;

    public function value()
    {
        return $this->value;
    }
}