<?php

namespace Src\User\Domain;

class Email
{
    private ?string $email;

    public function __construct(?string $email)
    {
        $this->email = $email;
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
            throw  new EmailNullException("The Email is null");
        }
        $this->email = $email;
    }

}
