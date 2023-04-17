<?php

namespace Src\User\Domain;

class Password
{
    private string $password;

    public function __construct(string $password)
    {
        $this->setPassword($password);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    private function setPassword(string $password): void
    {
        if ($password < 5) {
            throw  new PasswordLengthInvalidException("Password length Invalid");
        }
        $this->password = $password;
    }
}
