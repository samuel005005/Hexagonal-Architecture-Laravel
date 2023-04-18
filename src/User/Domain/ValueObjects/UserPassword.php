<?php

namespace Src\User\Domain\ValueObjects;

use Src\User\Domain\Exceptions\PasswordLengthInvalidException;

final class UserPassword
{
    private string $password;

    public function __construct(?string $password)
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
     * @param string|null $password
     */
    private function setPassword(?string $password): void
    {
        if (is_null($password)) {
            throw  new PasswordLengthInvalidException(400,"Password is required");
        }

        if ($password < 5) {
            throw  new PasswordLengthInvalidException(400,"Password length Invalid");
        }
        $this->password = $password;
    }
}
