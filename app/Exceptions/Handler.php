<?php

namespace App\Exceptions;

use ErrorType;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use App\Profiles\Exceptions\ProfileDoesNotExist;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
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
                'error' => ErrorType::NO_PERMISSION
            ], 403);
         }

          // Validation
          if ($exception instanceof ValidationException)
          {             
              return response()->json([
                 'ok' => false,
                 'error' => ErrorType::VALIDATION_FAILED,
                 'validation_errors' => $exception->errors(),
                 'stuff' => $exception->getMessage() 
             ], 401);
          }
 
         // 401 Unauthorized
         if ($exception instanceof AuthenticationException)
         {           
             if ($request->expectsJson()) {
                 return response()->json([
                     'ok' => false,
                     'error' => ErrorType::NOT_AUTHED,
                     'stuff' => $exception->getMessage()
                 ], 401);
             }
         }

         // Wrong Token
        if ($exception instanceof InvalidSignatureException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'error' => ErrorType::INVALID_TOKEN
                ], 404);
            }
         }

        //  Throttle 
        if ($exception instanceof ThrottleRequestsException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'error' => ErrorType::TOO_MANY_ATTEMPTS
                ], 429);
            }
         }

         //  Profile not found 
        if ($exception instanceof ProfileDoesNotExist) {
            if ($request->expectsJson()) {
                return response()->json([
                    'ok' => false,
                    'error' => ErrorType::PROFILE_NOT_FOUND,
                    'stuff' => $exception->getMessage()
                ], 429);
            }
         }


        return parent::render($request, $exception);       
    }
}
