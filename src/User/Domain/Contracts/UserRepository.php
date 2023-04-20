<?php

namespace Src\User\Domain\Contracts;

use Src\User\Domain\UserEntity;
use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\ValueObjects\UserEmailVerifiedDate;
use Src\User\Domain\ValueObjects\UserName;
use Src\User\Domain\ValueObjects\UserPassword;
use Src\User\Domain\ValueObjects\UserRememberToken;

interface UserRepository
{
    public function search(UserEmail $email): ?UserEntity;

    public function save(
        UserName $name,
        UserEmail $email,
        UserEmailVerifiedDate $userEmailVerifiedDate,
        UserPassword $userPassword,
        UserRememberToken $userRememberToken
    ): UserEntity;

}
