<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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

    /**
     * Render the exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
    
            switch ($exception->getStatusCode()) {
                case 404:
                    return response()->view('errors.404');
    
                case 403:
                    return response()->view('errors.403');
    
                default:
                    return response()->view('errors.500');
    
            }
            
        } else {
            return response()->view('errors.500');

        }
    
    }
    
}