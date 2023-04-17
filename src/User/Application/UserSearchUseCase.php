<?php

declare(strict_types=1);

namespace Src\User\Application;

use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\UserEntity;
use Src\User\Domain\UserName;

final class UserSearchUseCase
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {

        $this->repository = $repository;
    }

    public function execute(string $userName): ?UserEntity
    {
       return $this->repository->search(new UserName($userName));

    }
}
