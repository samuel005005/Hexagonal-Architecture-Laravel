<?php

declare(strict_types=1);

namespace Src\User\Application;

use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\Email;
use Src\User\Domain\UserEntity;


final class UserSearchUseCase
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {

        $this->repository = $repository;
    }

    public function execute(string $email): ?UserEntity
    {
        $data = $this->repository->search(new Email($email));

        $this->ensureExists($data);

        return UserEntity::fromArray($data);
    }

    private function ensureExists(UserEntity $data): void
    {
    }
}
