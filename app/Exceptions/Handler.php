<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Redirect;
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
	
	public function render($request, Throwable $e)
	{
		return response()->json([
			'msg' => $e->getMessage(),
			'code' => $e->getCode(),
			'file' => $e->getFile(),
			'line' => $e->getLine()
		]);
	}
	
	public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
