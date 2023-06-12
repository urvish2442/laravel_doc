<?php

namespace App\Exceptions;

use App\Mail\ExceptionMail;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class Handler extends ExceptionHandler
{
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

    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            $this->sendExceptionEmail($exception);
        }

        parent::report($exception);
    }

    private function sendExceptionEmail(Throwable $exception)
    {
        $content['url'] = request()->url();
        $content['ip'] = request()->ip();
        $content['Exception Class'] = get_class($exception);
        $content['Exception Message'] = $exception->getMessage();
        $content['Exception Code'] = $exception->getCode();
        $content['Request Method'] = request()->method();
//        $content['Request Params'] = request()->all();
//        $content['Request Headers'] = request()->header();
        $content['file'] = $exception->getFile();
        $content['line'] = $exception->getLine();
        $content['StackTrace'] = $exception->getTraceAsString();
//        $content['trace'] = $exception->getTrace();
            Mail::to('r.urvish@gmail.com')->send(new ExceptionMail($content));
    }
}
