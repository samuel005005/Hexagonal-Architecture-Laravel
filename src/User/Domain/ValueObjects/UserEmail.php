<?php

namespace Src\User\Domain\ValueObjects;

use Src\Shared\Domain\Exceptions\HttpException;
use Src\User\Domain\Exceptions\EmailNullException;
use Src\User\Domain\Exceptions\InvalidArgumentException;

final class UserEmail
{
    private ?string $value;

    public function __construct(?string $value)
    {
        $this->setEmail($value);
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function setEmail(?string $value): void
    {
        if (is_null($value)) {
            throw new EmailNullException(400, "The email is required");
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(400, sprintf('<%s> does not allow the invalid email: <%s>.', UserEmail::class, $value)
            );
        }

        $this->value = $value;
    }

}
