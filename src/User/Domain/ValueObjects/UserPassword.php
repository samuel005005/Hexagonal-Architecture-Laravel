<?php

namespace Src\User\Domain\ValueObjects;

use Src\User\Domain\Exceptions\PasswordLengthInvalidException;

final class UserPassword
{
    private string $value;

    public function __construct(?string $value)
    {
        $this->setPassword($value);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    private function setPassword(?string $value): void
    {
        if (is_null($value)) {
            throw  new PasswordLengthInvalidException(400, "The password is required");
        }

        if (strlen($value) < 5) {
            throw  new PasswordLengthInvalidException(400, "Password length invalid");
        }
        $this->value = $value;
    }
}
