<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
        $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {

            // Send Alert
            Alert::html('Unauthorize User', 'You does not have the right permissions. <br> Please contact your <b>Administrator</b>', 'warning');
            
            return back();
        });
    }
}
