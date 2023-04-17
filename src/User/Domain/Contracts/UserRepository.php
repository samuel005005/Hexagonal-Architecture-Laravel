<?php

namespace Src\User\Domain\Contracts;

use Src\User\Domain\Email;
use Src\User\Domain\UserEntity;

interface UserRepository
{
    public function search(Email $email): UserEntity;
}
