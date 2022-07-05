<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{

    public function report(Throwable $exception)
    {

        if ($exception instanceof \League\OAuth2\Server\Exception\OAuthServerException && $exception->getCode() == 9) {
        return response('unauthorized', 401);
        }

        parent::report($exception);
    }
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
