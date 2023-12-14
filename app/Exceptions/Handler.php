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
		if ($e->getMessage()) {
			return response()->json($e);
		}
		return Redirect::to('/login');
	}
	
	public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
