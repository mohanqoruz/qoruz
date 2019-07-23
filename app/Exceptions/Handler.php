<?php

namespace App\Exceptions;

use ErrorType;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
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

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
         // 403 Forbidden
         if ($exception instanceof AuthorizationException)
         {             
             return response()->json([
                'ok' => false,
                'error'=> ErrorType::NO_PERMISSION
            ], 403);
         }
 
         // 401 Unauthorized
         if ($exception instanceof AuthenticationException)
         {           
             if ($request->expectsJson()) {
                 return response()->json([
                     'ok' => false,
                     'error'=> ErrorType::NOT_AUTHED
                 ], 401);
             }
         }

         // Wrong Token
        if ($exception instanceof InvalidSignatureException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'error'=> ErrorType::INVALID_TOKEN
                ], 404);
            }
         }

        //  Throttle 
        if ($exception instanceof ThrottleRequestsException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'error'=> ErrorType::TOO_MANY_ATTEMPTS
                ], 429);
            }
         }


        return parent::render($request, $exception);       
    }
}
