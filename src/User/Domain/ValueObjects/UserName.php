<?php

namespace Src\User\Domain\ValueObjects;

use Src\User\Domain\Exceptions\EmailNullException;
use Src\User\Domain\Exceptions\NameNullException;

class UserName
{
    private string $name;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    private function setName(?string $name): void
    {
        if (is_null($name)) {
            throw new NameNullException(400, "The name is required");
        }
        $this->name = $name;
    }
}
