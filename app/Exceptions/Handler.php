<?php

namespace App\Exceptions;

use Throwable;
use Inertia\Inertia;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $statusCode = $exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException
            ? $exception->getStatusCode()
            : 500; // Default to 500 for any unexpected exception

        if (in_array($statusCode, [403, 404, 500, 503])) {
            // detemine if User Logged in or Not..
            return Inertia::render('ErrorPage', ['statusCode' => $statusCode, 'isLoggedIn' => false])
                ->toResponse($request)
                ->setStatusCode($statusCode);
        }

        return parent::render($request, $exception);
    }
}
