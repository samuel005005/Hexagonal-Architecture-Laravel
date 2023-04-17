<?php

namespace Src\User\Domain;

class UserEntity
{
    private Email $email;
    private Password $password;

    public function __construct(Email $email, Password $password)
    {
        $this->email =$email;
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
}
