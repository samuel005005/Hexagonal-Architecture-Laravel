<?php

namespace Src\User\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Src\User\Application\CreateUserUseCase;
use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\UserEntity;

class CreateUserController
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request): UserEntity
    {
        $userName = $request->input('name');
        $userEmail = $request->input('email');
        $userEmailVerifiedDate = null;
        $userPassword = Hash::make($request->input('password'));
        $userRememberToken = null;

        $createUserUseCase = new CreateUserUseCase($this->repository);
        return $createUserUseCase->__invoke(
            $userName,
            $userEmail,
            $userEmailVerifiedDate,
            $userPassword,
            $userRememberToken
        );
    }
}
