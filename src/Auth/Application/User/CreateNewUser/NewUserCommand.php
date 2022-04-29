<?php

namespace TodoList\Api\Auth\Application\User\CreateNewUser;


use TodoList\Api\Infrastructure\Api\Bus\Command\Command;

class NewUserCommand implements Command
{
    private string $email;
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function getPassword(): string
    {
        return $this->password;
    }
}