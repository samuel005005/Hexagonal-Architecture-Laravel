<?php

namespace Src\User\Domain\ValueObjects;

use Src\Shared\Domain\Exceptions\HttpException;
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
            throw new EmailNullException(400, "The UserEmail is null");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(400, sprintf('<%s> does not allow the invalid email: <%s>.', UserEmail::class, $email)
            );
        }

        $this->email = $email;
    }

}
