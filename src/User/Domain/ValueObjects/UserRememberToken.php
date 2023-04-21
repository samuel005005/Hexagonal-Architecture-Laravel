<?php

namespace Src\User\Domain\ValueObjects;

class UserRememberToken
{
    private ?string $value;

    public function __construct(?string $rememberToken)
    {
        $this->value = $rememberToken;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
