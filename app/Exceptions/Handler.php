<?php

namespace App\Exceptions;

use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\ErrorServerResource;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Src\Shared\Domain\Exceptions\HttpException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function render($request, Throwable $e): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|Response
    {
        if ($e instanceof HttpException) {
            return response()->json(
                new ErrorResponseResource($e->getMessage()), $e->getStatusCode());
        }
        if ($e instanceof Exception) {
            return response()->json(
                new ErrorServerResource($e->getMessage()), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $rendered = parent::render($request, $e);

        return response()->json(
            new ErrorResponseResource($e->getMessage()), $rendered->getStatusCode());
    }
}
