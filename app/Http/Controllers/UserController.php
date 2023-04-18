<?php

namespace App\Http\Controllers;

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
            $user = $this->userController->execute($request);
            return response()->json($user, 200);
        } catch (HttpException $exception) {
            return response()->json(
                array(
                    "Response" => true,
                    "Msj" => $exception->getMessage()
                ), $exception->getStatusCode());
        } catch (\Exception $exception) {
            return response()->json(
                array(
                    "Response" => true,
                    "Msj" => $exception->getMessage()
                ), 500);
        }
    }
}
