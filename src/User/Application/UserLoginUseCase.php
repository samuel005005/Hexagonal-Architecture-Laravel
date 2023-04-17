<?php

declare(strict_types=1);

namespace Src\User\Application;


use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\Password;

final class UserLoginUseCase
{
    private UserSearchUseCase $finderUser;
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {

        $this->repository = $repository;
        $this->finderUser = new UserSearchUseCase($this->repository);
    }

    public function execute(string $email, string $password): void
    {
        $user = $this->finderUser->execute($email);

        $user->login(new Password($password));

    }

}
