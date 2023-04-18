<?php

declare(strict_types=1);

namespace Src\User\Application;


use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\UserEntity;
use Src\User\Domain\ValueObjects\UserPassword;

final class UserLoginUseCase
{
    private UserSearchUseCase $finderUser;
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {

        $this->repository = $repository;
        $this->finderUser = new UserSearchUseCase($this->repository);
    }

    public function execute(?string $email, ?string $password): UserEntity
    {
        $user = $this->finderUser->execute($email);

        return $user->login(new UserPassword($password));

    }

}
