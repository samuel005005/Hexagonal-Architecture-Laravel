<?php

namespace Src\User\Domain\ValueObjects;

use DateTime;

final class UserEmailVerifiedDate
{
    private ?DateTime $value;

    public function __construct(?DateTime $emailVerifiedDate)
    {
        $this->setValue($emailVerifiedDate);
    }

    public function value(): ?DateTime
    {
        return $this->value;
    }

    /**
     * @param DateTime|null $value
     */
    private function setValue(?DateTime $value): void
    {
        $this->value = $value;

    }
}
