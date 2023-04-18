<?php

namespace Src\User\Domain;

use Serializable;
use Src\User\Domain\Exceptions\UserNotFoundException;
use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\ValueObjects\UserEmailVerifiedDate;
use Src\User\Domain\ValueObjects\UserName;
use Src\User\Domain\ValueObjects\UserPassword;
use Src\User\Domain\ValueObjects\UserRememberToken;

class UserEntity
{
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;
    private UserEmailVerifiedDate $emailVerifiedDate;
    private UserRememberToken $rememberToken;

    public function __construct(
        UserName              $name,
        UserEmail             $email,
        UserEmailVerifiedDate $emailVerifiedDate,
        UserPassword          $password,
        UserRememberToken     $rememberToken)
    {
        $this->name = $name;
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

    /**
     * @return UserEmailVerifiedDate
     */
    public function getEmailVerifiedDate(): UserEmailVerifiedDate
    {
        return $this->emailVerifiedDate;
    }

    /**
     * @return UserRememberToken
     */
    public function getRememberToken(): UserRememberToken
    {
        return $this->rememberToken;
    }

    /**
     * @return UserName
     */
    public function getName(): UserName
    {
        return $this->name;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            new UserName($data['name']),
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

        throw new  UserNotFoundException(404, "User or password incorrect");
    }

    public static function create(
        UserName              $name,
        UserEmail             $email,
        UserEmailVerifiedDate $emailVerifiedDate,
        UserPassword          $password,
        UserRememberToken     $rememberToken
    ): UserEntity
    {
        return new self($name, $email, $emailVerifiedDate, $password, $rememberToken);
    }

    public function _toArray(): array
    {
        return [
            'name' => $this->name->getName(),
            'email' => $this->email->getEmail()
        ];
    }
}
