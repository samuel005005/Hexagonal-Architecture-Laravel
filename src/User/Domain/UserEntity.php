<?php

namespace Src\User\Domain;

use Serializable;
use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\ValueObjects\UserEmailVerifiedDate;
use Src\User\Domain\ValueObjects\UserPassword;
use Src\User\Domain\ValueObjects\UserRememberToken;

class UserEntity
{
    private UserEmail $email;
    private UserPassword $password;
    private UserEmailVerifiedDate $emailVerifiedDate;
    private UserRememberToken $rememberToken;

    public function __construct(
        UserEmail             $email,
        UserEmailVerifiedDate $emailVerifiedDate,
        UserPassword          $password,
        UserRememberToken     $rememberToken)
    {

        $this->email = $email;
        $this->emailVerifiedDate = $emailVerifiedDate;
        $this->password = $password;
        $this->rememberToken = $rememberToken;
    }

    /**
     * @return UserPassword
     */
    public function getPassword(): UserPassword
    {
        return $this->password;
    }

    /**
     * @return UserEmailVerifiedDate
     */
    public function emailVerifiedDate(): UserEmailVerifiedDate
    {
        return $this->emailVerifiedDate;
    }

    /**
     * @return UserEmail
     */
    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    /**
     * @return UserRememberToken
     */
    public function rememberToken(): UserRememberToken
    {
        return $this->rememberToken;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            new UserEmail($data['email']),
            new UserEmailVerifiedDate($data['emailVerifiedDate']),
            new UserPassword($data['password']),
            new UserRememberToken($data['rememberToken'],
            )
        );
    }


    public function login(?UserPassword $password): self
    {
        if ($password->getPassword() == $this->password->getPassword()) {
            return $this;
        }

        throw new  UserNotFoundException("User or password incorrect");
    }

    public static function create(
        UserEmail             $email,
        UserEmailVerifiedDate $emailVerifiedDate,
        UserPassword          $password,
        UserRememberToken     $rememberToken
    ): UserEntity
    {
        return new self($email, $emailVerifiedDate, $password, $rememberToken);
    }

    public function _toArray(): array
    {
        return [
            'email' => $this->email->getEmail()
        ];
    }
}
