<?php

namespace App\Http\Controllers;

use Src\User\Application\UserLoginUseCase;
use Src\User\Infrastructure\EloquentUserRepository;

class UserController extends Controller
{
    /**
     * Show a list of all the application's users.
     */
    public function index(): string
    {
        $login = new UserLoginUseCase(new EloquentUserRepository());
        $login->execute("samuel005@gmail.com","s");

        return "22";
    }
}
