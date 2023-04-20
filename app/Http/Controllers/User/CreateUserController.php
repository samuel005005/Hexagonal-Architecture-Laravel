<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\ErrorServerResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Shared\Domain\Exceptions\HttpException;
use Symfony\Component\HttpFoundation\Response;
use \Src\User\Infrastructure\CreateUserController as CreateUser;

class CreateUserController extends Controller
{
    private CreateUser $createUserController;

    public function __construct(CreateUser $createUserController)
    {
        $this->createUserController = $createUserController;
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $user = new UserResource($this->createUserController->__invoke($request));
            return response()->json($user, Response::HTTP_OK);
        } catch (HttpException $exception) {
            return response()->json(
                new ErrorResponseResource($exception->getMessage()), $exception->getStatusCode());
        } catch (\Exception $exception) {
            return response()->json(
                new ErrorServerResource($exception->getMessage()), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
