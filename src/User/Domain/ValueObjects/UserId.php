<?php

namespace Src\User\Domain\ValueObjects;

use Src\User\Domain\Exceptions\InvalidArgumentException;

final class UserId
{
    private int $id;

    /**
     * UserId constructor.
     * @param int $id
     * @throws InvalidArgumentException
     */
    public function __construct(int $id)
    {
        $this->setValue($id);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    private function setValue(int $id): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );
        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the value <%s>.', self::class, $id)
            );
        }
        $this->id = $id;
    }

}
