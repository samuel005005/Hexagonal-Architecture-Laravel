<?php

namespace Src\User\Infrastructure;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Src\User\Application\UserSearchUseCase;
use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\Exceptions\UserNotFoundException;


class AuthController
{
    private UserRepository $repository;
    private UserSearchUseCase $finderUser;


    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->finderUser = new UserSearchUseCase($this->repository);
    }

    public function __invoke(Request $request):string
    {

        $credentials = $request->only('email', 'password');

        $this->finderUser->__invoke($credentials['email']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $user->createToken('token')->plainTextToken;
        }

        throw new  UserNotFoundException(Response::HTTP_UNAUTHORIZED, "User or password incorrect");


    }
}
