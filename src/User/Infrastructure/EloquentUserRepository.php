<?php

namespace Src\User\Infrastructure;

use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\Email;
use Src\User\Domain\UserEntity;


final class EloquentUserRepository implements UserRepository
{

    public function search(Email $email): UserEntity
    {

    }
}
