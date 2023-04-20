<?php

namespace Src\User\Domain;

use Src\User\Domain\ValueObjects\UserEmail;
use Src\User\Domain\ValueObjects\UserEmailVerifiedDate;
use Src\User\Domain\ValueObjects\UserId;
use Src\User\Domain\ValueObjects\UserName;
use Src\User\Domain\ValueObjects\UserPassword;
use Src\User\Domain\ValueObjects\UserRememberToken;

class UserEntity
{
    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;
    private UserEmailVerifiedDate $emailVerifiedDate;
    private UserRememberToken $rememberToken;

    public function __construct(
        UserId                $id,
        UserName              $name,
        UserEmail             $email,
        UserEmailVerifiedDate $emailVerifiedDate,
        UserPassword          $password,
        UserRememberToken     $rememberToken)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->emailVerifiedDate = $emailVerifiedDate;
        $this->password = $password;
        $this->rememberToken = $rememberToken;
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
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
            new UserId($data['id']),
            new UserName($data['name']),
            new UserEmail($data['email']),
            new UserEmailVerifiedDate($data['email_verified_at']),
            new UserPassword($data['password']),
            new UserRememberToken($data['remember_token'],
            )
        );
    }

    public static function create(
        UserId                $id,
        UserName              $name,
        UserEmail             $email,
        UserEmailVerifiedDate $emailVerifiedDate,
        UserPassword          $password,
        UserRememberToken     $rememberToken
    ): UserEntity
    {
        return new self($id, $name, $email, $emailVerifiedDate, $password, $rememberToken);
    }

    public function _toArray(): array
    {
        return [
            'id' => $this->id->getId(),
            'name' => $this->name->getName(),
            'email' => $this->email->getEmail()
        ];
    }
}
