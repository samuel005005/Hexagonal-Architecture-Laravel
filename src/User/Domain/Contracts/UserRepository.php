<?php

namespace Src\User\Domain\Contracts;

use Src\User\Domain\UserEntity;
use Src\User\Domain\ValueObjects\UserEmail;

interface UserRepository
{
    public function search(UserEmail $email): UserEntity;
}
