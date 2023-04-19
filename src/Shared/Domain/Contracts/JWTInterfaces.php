<?php

namespace Src\Shared\Domain\Contracts;

use Illuminate\Contracts\Auth\Guard;

interface JWTInterfaces
{
    public function attempt(array $credentials = [], $remember = false);
}
