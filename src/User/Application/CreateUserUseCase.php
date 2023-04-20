<?php

declare(strict_types=1);

namespace Src\User\Application;


use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\Exceptions\UserFoundException;
use Src\User\Domain\UserEntity;
use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\ValueObjects\UserEmailVerifiedDate;
use Src\User\Domain\ValueObjects\UserName;
use Src\User\Domain\ValueObjects\UserPassword;
use Src\User\Domain\ValueObjects\UserRememberToken;

final class CreateUserUseCase
{
    private UserSearchUseCase $finderUser;
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {

        $this->repository = $repository;
        $this->finderUser = new UserSearchUseCase($this->repository);
    }

    public function __invoke(
        ?string $userName,
        ?string $email,
        ?string $userEmailVerifiedDate,
        ?string $password,
        ?string $userRememberToken): UserEntity
    {
        $user = $this->finderUser->__invoke($email);

        if (!is_null($user)) {
            throw new UserFoundException(400, "That email already exists");
        }

        return $this->repository->save(
            new UserName($userName),
            new UserEmail($email),
            new UserEmailVerifiedDate($userEmailVerifiedDate),
            new UserPassword($password),
            new UserRememberToken($userRememberToken)
        );
    }

}
