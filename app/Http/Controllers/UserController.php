<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use InvalidArgumentException;
use Src\User\Application\UserLoginUseCase;
use Src\User\Domain\Contracts\UserRepository;
use Src\User\Domain\Exceptions\EmailNullException;
use Src\User\Domain\Exceptions\PasswordLengthInvalidException;
use Src\User\Domain\Exceptions\UserNotFoundException;


class UserController extends Controller
{

    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $userEmail = $request->input('email');
            $userPassword = $request->input('password');

            $login = new UserLoginUseCase($this->repository);
            $user = $login->execute($userEmail, $userPassword);

            return response()->json(
                array(
                    "Response" => true,
                    "Data" => $user->_toArray()
                ), 200);

        } catch (   EmailNullException|
                    PasswordLengthInvalidException|
                    InvalidArgumentException|
                    UserNotFoundException $exception) {
            return response()->json(array(
                'Response' => false,
                'Msg' => $exception->getMessage()
            ), 400);
        } catch (\Exception $exception) {
            return response()->json(array(
                'Response' => false,
                'Msg' => $exception->getMessage()
            ), 500);
        }

    }
}
