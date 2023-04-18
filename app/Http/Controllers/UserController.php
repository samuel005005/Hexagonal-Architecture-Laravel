<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use App\Http\Resources\ErrorResponseResource;
use Illuminate\Http\Request;
use Src\Shared\Domain\Exceptions\HttpException;

class UserController extends Controller
{
    private \Src\User\Infrastructure\UserController $userController;

    public function __construct(\Src\User\Infrastructure\UserController $userController)
    {
        $this->userController = $userController;
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
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
