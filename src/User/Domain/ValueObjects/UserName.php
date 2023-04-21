<?php

namespace Src\User\Domain\ValueObjects;

use Src\User\Domain\Exceptions\EmailNullException;
use Src\User\Domain\Exceptions\NameNullException;

class UserName
{
    private string $value;

    public function __construct(string $value)
    {
        $this->setName($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    private function setName(?string $value): void
    {
        if (is_null($value)) {
            throw new NameNullException(400, "The name is required");
        }
        $this->value = $value;
    }
}
