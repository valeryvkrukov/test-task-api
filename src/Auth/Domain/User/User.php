<?php

namespace TodoList\Api\Auth\Domain\User;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use TodoList\Api\Auth\Domain\User\ValueObject\UserEmail;
use TodoList\Api\Auth\Domain\User\ValueObject\UserPassword;
use TodoList\Api\Shared\Domain\Aggregate;
use TodoList\Api\Shared\Domain\User\UserId;

class User extends Aggregate implements \Stringable
{
    private Collection $tokens;
    private UserId $id;
    private UserEmail $email;
    private UserPassword $password;

    private function __construct(UserId $id, UserEmail $email, UserPassword $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->tokens = new ArrayCollection();
    }

    public static function create(UserId $id, UserEmail $email, UserPassword $password): User
    {
        return new self($id, $email, $password);
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getTokens(): Collection
    {
        return $this->tokens;
    }
    
    public function comparePassword(UserPassword $password): boolval
    {
        return password_verify($password->value(), $this->password->value());
    }

    public function __toString(): string
    {
        return $this::class . ':' . $this->id->value();
    }
}