<?php

namespace TodoList\Api\Auth\Domain\User;


use TodoList\Api\Auth\Domain\User\Exception\UserAlreadyExists;
use TodoList\Api\Auth\Domain\User\ValueObject\UserEmail;
use TodoList\Api\Auth\Domain\User\ValueObject\UserPassword;

interface UserRepository
{
    public function getByEmail(UserEmail $email): ?User;

    public function getByEmailAndPassword(UserEmail $email, UserPassword $password): ?User;

    public function post(User $user): void;
}