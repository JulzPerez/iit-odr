<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use Illuminate\Support\Facades\Auth;
use App\DbLog;
use Illuminate\Support\Facades\Log;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        //parent::report($exception);

         // Some exceptions don't have a message
      $exception_message = (!empty($exception->getMessage()) ? trim($exception->getMessage()) : 'App Error Exception');

      // Log message
      $log_message = "\"" . $exception_message . " in file '" . $exception->getFile() . "' on line '" . $exception->getLine() . "'" . "\"";

      if (!config('app.debug')) {
          Log::error($log_message);
      } else {
          parent::report($exception);
      }
       
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \App\Exceptions\ExceptionLogData)  {
           
            return $exception->render($request, $exception);
        }

        return parent::render($request, $exception);
    }
}
