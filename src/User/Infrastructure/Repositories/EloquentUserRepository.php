<?php
declare(strict_types=1);

namespace Src\User\Infrastructure\Repositories;

use App\Models\User;
use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\Exceptions\UserFoundException;
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
        $row = $this->model->query()->where('email', '=', $email->getEmail())->first();

        if (is_null($row)) {
            throw new UserFoundException(404, "User not found");
        }

        return UserEntity::create(
            new UserName ($row->getAttribute('name')),
            new UserEmail($row->getAttribute('email')),
            new UserEmailVerifiedDate($row->getAttribute('email_verified_at')),
            new UserPassword($row->getAttribute('password')),
            new UserRememberToken($row->getAttribute('remember_token')),
        );
    }

    public function save(
        UserName              $name,
        UserEmail             $email,
        UserEmailVerifiedDate $userEmailVerifiedDate,
        UserPassword          $userPassword,
        UserRememberToken     $userRememberToken
    ): UserEntity
    {
        $this->model->setAttribute('name', $name);
        $this->model->setAttribute('email', $email);
        $this->model->setAttribute('email_verified_at', $userEmailVerifiedDate);
        $this->model->save();
    }
}
