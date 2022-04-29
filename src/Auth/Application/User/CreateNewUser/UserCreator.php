<?php

namespace TodoList\Api\Auth\Application\User\CreateNewUser;


use TodoList\Api\Auth\Domain\User\Exception\UserAlreadyExists;
use TodoList\Api\Auth\Domain\User\User;
use TodoList\Api\Auth\Domain\User\UserRepository;
use TodoList\Api\Auth\Domain\User\ValueObject\UserEmail;
use TodoList\Api\Auth\Domain\User\ValueObject\UserPassword;
use TodoList\Api\Shared\Application\Service\ApplicationService;
use TodoList\Api\Shared\Application\Service\Request;
use TodoList\Api\Shared\Application\Service\Response;
use TodoList\Api\Shared\Domain\User\UserId;

class UserCreator implements ApplicationService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(NewUserCommand|Request $request): ?Response
    {
        $this->userRepository->post(
            User::create(
                new UserId(UserId::v4()->toRfc4122()),
                new UserEmail($request->getEmail()),
                new UserPassword(password_hash($request->getPassword(), PASSWORD_ARGON2ID))
            )
        );

        return null;
    }
}