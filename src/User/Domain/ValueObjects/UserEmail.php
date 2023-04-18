<?php

namespace Src\User\Domain\ValueObjects;

use Src\User\Domain\Exceptions\EmailNullException;
use Src\User\Domain\Exceptions\InvalidArgumentException;

final class UserEmail
{
    private ?string $email;

    public function __construct(?string $email)
    {
        $this->setEmail($email);
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        if (is_null($email)) {
            throw  new EmailNullException("The UserEmail is null");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the invalid email: <%s>.', static::class, $email)
            );
        }

        $this->email = $email;
    }

}
