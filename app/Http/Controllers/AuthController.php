<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneralResponseResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\ErrorResponseResource;
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

    public function register(Request $request): JsonResponse
    {
        $user = new LoginResource($this->userController->__invoke($request));
        return response()->json($user, Response::HTTP_OK)->withoutCookie($cookie);
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $user = new LoginResource($this->userController->__invoke($request));
            $cookie = cookie('token', $user->resource, 60 * 24);
            return response()->json($user, Response::HTTP_OK)->withoutCookie($cookie);
        } catch (HttpException $exception) {
            return response()->json(
                new ErrorResponseResource($exception->getMessage()), $exception->getStatusCode());
        } catch (\Exception $exception) {
            return response()->json(
                new ErrorResponseResource($exception->getMessage()), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function logout(): JsonResponse
    {
        $cookie = cookie()->forget('token');
        return response()->json(new GeneralResponseResource(request()), Response::HTTP_OK)->withoutCookie($cookie);
    }

    public function notAuthorized(): JsonResponse
    {
        return response()->json(new ErrorResponseResource("Access is denied token is invalid"), Response::HTTP_UNAUTHORIZED);
    }
}
