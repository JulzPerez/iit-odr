@extends('layouts.app', ['activePage' => 'monitoring', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

@section('content')
<div class="content">
    <div class="container-fluid">
        
        <div class="row mt-1">
            <div class="col-md-12">                
                <div class="card">
                    <div class="card-header"><h4><strong>Reports</strong></h4>
                        
                        
                    </div>

                    <div class="card-body">
                    
                    @if(empty($results))
                        <div style="color:red">Please select valid date.</div>
                        
                    @else   
                        @if($results->isEmpty())
                                <div style="color:red">No record found.</div>
                                <br>
                                <hr>
                        @else
                        <hr>
                        <br>
                        <table class="table">
                            <thead>
                                    <tr>
                                        <th style="text-align:center"><strong>Date<strong></th>
                                        <th style="text-align:center"><strong>Assessed</strong></th>
                                        <th style="text-align:center"><strong>Verified</strong></th>
                                        <th style="text-align:center"><strong>Completed</strong></th>
                                        <th style="text-align:center"><strong>Released</strong></th>
                                       
                                    </tr>
                            </thead>
                            
                                <tbody>
                                    @foreach($results as $result)
                                        <tr> 
                                            <td style="text-align:center">{{$result->date_created}}</td>
                                            <td style="text-align:center">{{$result->assessed}}</td>
                                            <td style="text-align:center">{{$result->verified}}</td>
                                            <td style="text-align:center">{{$result->completed}}</td>
                                            <td style="text-align:center">{{$result->released}}</td>
                                        </tr>
                                    @endforeach    
                                </tbody>                           
                        </table>
                       
                        @endif
                    @endif

                    </div>              
                </div> 
            </div>       
        </div>  

    </div>
</div>
@endsection



