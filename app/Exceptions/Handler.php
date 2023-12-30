<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
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
        // $this->reportable(function (QueryException $e) {
            // dd($e->getMessage());
            // report($e);
            // abort(500,$e->getMessage());
            // return response()->view('inproduction', ['error'=>$e]);
        // });
    }
}
