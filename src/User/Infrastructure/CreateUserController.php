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
    private CreateUserUseCase $createUserUseCase;
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->createUserUseCase = new CreateUserUseCase($this->repository);
    }

    public function __invoke(Request $request): UserEntity
    {
        $userName = $request->input('name');
        $userEmail = $request->input('email');
        $userEmailVerifiedDate = null;
        $userPassword = Hash::make($request->input('password'));
        $userRememberToken = null;

        return $this->createUserUseCase->__invoke(
            $userName,
            $userEmail,
            $userEmailVerifiedDate,
            $userPassword,
            $userRememberToken
        );
    }
}
