<?php

namespace Src\User\Infrastructure;

use Illuminate\Http\Request;
use Src\User\Application\UserLoginUseCase;
use Src\User\Domain\Contracts\UserRepository;

class UserController
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(Request $request): \Src\User\Domain\UserEntity
    {

        $userEmail = $request->input('email');
        $userPassword = $request->input('password');

        $login = new UserLoginUseCase($this->repository);
        return $login->execute($userEmail, $userPassword);

    }
}