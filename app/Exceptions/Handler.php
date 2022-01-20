<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    // /**
    //  * A list of the exception types that are not reported.
    //  *
    //  * @var array
    //  */
    // protected $dontReport = [
    //     //
    // ];

    // /**
    //  * A list of the inputs that are never flashed for validation exceptions.
    //  *
    //  * @var array
    //  */
    // protected $dontFlash = [
    //     'current_password',
    //     'password',
    //     'password_confirmation',
    // ];

    // /**
    //  * Register the exception handling callbacks for the application.
    //  *
    //  * @return void
    //  */
    // public function register()
    // {
    //     $this->reportable(function (Throwable $e) {
    //         //
    //     });
    // }


    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $guard = Arr::get($exception->guards(), 0);
        switch ($guard) {
            case 'customer':
                $login = 'user.login';
                break;
            default:
                $login = 'admin.login';
                break;
        }

        return redirect()->guest(route($login));
    }
}
