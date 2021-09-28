<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Auth;
use App\DbLog;

class ExceptionLogData extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report(){
    }
 
    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
  
      /* $log = new DbLog;
      $log->user_id = Auth::user()->id;
      $log->user_type = Auth::user()->user_type;
      $log->action = $request->fullUrl();
      $log->exception = $exception->getMessage();
      $log->save();  */

      $query = DB::table('db_log')->insert([
        'user_id' => Auth::user()->id,
        'user_type' => Auth::user()->user_type,
        'action' => $request->fullUrl(),
        'exception' => $exception->getMessage(),
      ]);

      return \Redirect()->back()->with(['error' => 'Something Went Wrong. Please email the administrator (admin@g.com) to fix the issue.']);
    }

}
