<?php

namespace Src\User\Domain\ValueObjects;

use DateTime;

final class UserEmailVerifiedDate
{
    private ?DateTime $value;

    public function __construct(?DateTime $emailVerifiedDate)
    {
        $this->value = $emailVerifiedDate;
    }

    public function value(): ?DateTime
    {
        return $this->value;
    }
}
