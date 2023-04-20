<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\GeneralResponseResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Shared\Domain\Exceptions\HttpException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private \Src\User\Infrastructure\AuthController $userController;

    public function __construct(\Src\User\Infrastructure\AuthController $userController)
    {

        $this->userController = $userController;
    }

    public function login(Request $request): JsonResponse
    {
        $user = new LoginResource($this->userController->__invoke($request));
        $cookie = cookie('token', $user->resource, env('JWT_TTL'));
        return response()->json($user, Response::HTTP_OK)->withoutCookie($cookie);
    }

    public function logout(): JsonResponse
    {
        $cookie = cookie()->forget('token');
        return response()->json(new GeneralResponseResource('Successfully logged out'), Response::HTTP_OK)->withoutCookie($cookie);
    }

    public function notAuthorized(): JsonResponse
    {
        return response()->json(new ErrorResponseResource("Access is denied token is invalid"), Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(new UserResource(auth()->user()));
    }

}
