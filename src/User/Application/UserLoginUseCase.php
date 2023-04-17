<?php

declare(strict_types=1);

namespace Src\User\Application;


use Src\User\Domain\Password;
use Src\User\Domain\UserEntity;
use Src\User\Domain\UserName;

final class UserLoginUseCase
{
    private UserSearchUseCase $finderUser;
    public function __construct()
    {
        $this->finderUser = new UserSearchUseCase();
    }

    public function execute(string $userName, string $password): void
    {

        $this->finderUser->execute();

        $userEntity = new UserEntity(
            new UserName($userName),
            new Password($password)
        );
    }


}
