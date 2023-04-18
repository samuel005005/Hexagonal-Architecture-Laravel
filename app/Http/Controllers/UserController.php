<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use App\Http\Resources\ErrorResponseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Src\Shared\Domain\Exceptions\HttpException;

class UserController extends Controller
{
    private \Src\User\Infrastructure\UserController $userController;

    public function __construct(\Src\User\Infrastructure\UserController $userController)
    {
        $this->userController = $userController;
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            $credentials = request(['email', 'password']);

//           var_dump( Hash::make('123456'));
//           die;

            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user = new LoginResource($this->userController->execute($request));

            return response()->json($user, 200);
        } catch (HttpException $exception) {
            return response()->json(
                new ErrorResponseResource($exception->getMessage()), $exception->getStatusCode());
        } catch (\Exception $exception) {
            return response()->json(
                new ErrorResponseResource($exception->getMessage()), 500);
        }
    }
}
