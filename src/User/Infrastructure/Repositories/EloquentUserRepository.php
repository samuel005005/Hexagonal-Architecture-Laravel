<?php
declare(strict_types=1);

namespace Src\User\Infrastructure\Repositories;

use App\Models\User;
use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\UserEntity;
use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\ValueObjects\UserEmailVerifiedDate;
use Src\User\Domain\ValueObjects\UserName;
use Src\User\Domain\ValueObjects\UserPassword;
use Src\User\Domain\ValueObjects\UserRememberToken;


final class EloquentUserRepository implements UserRepository
{
    private User $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function search(UserEmail $email): UserEntity
    {
        $row = $this->model->query()->where('email', '=', $email->getEmail())->firstOrFail();
        return UserEntity::create(
            new UserName ($row->getAttribute('name')),
            new UserEmail($row->getAttribute('email')),
            new UserEmailVerifiedDate($row->getAttribute('email_verified_at')),
            new UserPassword($row->getAttribute('password')),
            new UserRememberToken($row->getAttribute('remember_token')),
        );
    }
}
