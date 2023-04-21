<?php

namespace Src\User\Domain\ValueObjects;

use Src\User\Domain\Exceptions\InvalidArgumentException;

final class UserId
{
    private int $value;

    /**
     * UserId constructor.
     * @param int $value
     * @throws InvalidArgumentException
     */
    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    private function setValue(int $value): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );
        if (!filter_var($value, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', self::class, $value)
            );
        }
        $this->value = $value;
    }

}
