<?php

namespace Src\User\Domain;

class UserEntity
{
    private Email $email;
    private Password $password;

    public function __construct(Email $email, Password $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    public static function fromArray(UserEntity $data): self
    {
        return new self(
            new Email($data['email']),
            new Password($data['password']
            )
        );
    }

    public function login(Password $password): bool
    {
        if ($password->getPassword() == $this->password) {
            return true;
        }

        return false;
    }


}
