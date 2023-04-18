<?php

namespace Src\Shared\Domain\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class HttpException extends \RuntimeException  implements HttpExceptionInterface
{
    private int $statusCode;
    private array $headers;

    public function __construct(int $statusCode, string $message = null, \Throwable $previous = null, array $headers = [], ?int $code = 0)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;

        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

}
