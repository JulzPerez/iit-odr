<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        $results = null;
        return view('monitoring.index', compact('results'));
    }

    public function getStat(Request $request)
    {
        try
        {
            $results = DB::table('work_assignment')   
                    ->select(
                        DB::raw('DATE(created_at) as date_created'),
                        DB::raw("count( case when work_type = 'assess' then 1 end) as assessed  "),
                        DB::raw("count( case when work_type = 'verify' then 1 end) as verified  "),
                        DB::raw("count( case when work_status = 'completed' then 1 end) as completed  "),
                        DB::raw("count( case when work_type = 'release' then 1 end) as released  "),
                        )
                    ->whereDate('created_at','>=',$request['dateFrom'])
                    ->whereDate('created_at','<=',$request['dateTo'])
                    ->groupBy('date_created')  
                    ->orderBy('date_created', 'ASC')   
                    //->paginate(2);                  
                    ->get();
           
        }
        catch(\Exception $exception)
        {
            throw new \App\Exceptions\ExceptionLogData($exception);
        }        

       
        return view('monitoring.index',compact('results'));
       

        
    }

    public function generatePDF()
    {
        $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        $pdf = PDF::loadView('Monitoring.reportPDFview', $data);
  
        return $pdf->download('work-report.pdf');
    }
}
