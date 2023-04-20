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

    public function __invoke(Request $request): string
    {

        $email = $request->input('email');
        $password = $request->input('password');

        $this->finderUser->__invoke($email);

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            return $user->createToken('auth_token')->plainTextToken;
        }

        throw new  UserNotFoundException(Response::HTTP_UNAUTHORIZED, "Access is denied due to invalid credentials");

    }


}
