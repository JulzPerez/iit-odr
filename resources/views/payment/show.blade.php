@extends('layouts.master')

@section('main_content')
<div class="container-fluid">
    <div class="row ">
      <div class="col-sm-12">
        <div>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif
            
        </div>
      </div>
    </div>
      <div class="row mt-3">
        <div class="col-md-12">
          <a href="/request">
            <button type="button" class="btn btn-primary float-left"><i class="fas fa-arrow-left"></i> Back to requests</button>
          </a>
        </div>
      </div>
      <hr>
      <div class="row">
          <div class="col-md-12">
              <div class="card">

                @if($payment_status === 'pending')
                  <div class="form-group">
                      <label>Upload Proof of Payment here </label>
                      <input type="file" name="file" class="form-control" >
                      @if ($errors->has('file'))
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                      @endif 
                  </div>
                @elseif($payment_status === 'paid')              
                  <p>{{$payment_status}}</p>
                @endif
              </div>  
          </div>
      </div>
      <div class="row ">        
          <div class="col-md-12">
            <div class="card card-outline card-primary">    
            <div class="card-header">
            ASSESSMENT TOTAL: <h4 style="color:red;"> <strong>Php {{number_format($total, 2, '.' , ',')}}</strong>  </h4>
            </div>           
                  <div class="card-body">  
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:30%"> Name of Fee</th>  
                                <th style="width:20%"> Amount</th>  
                                <th style="width:10%"> Copy</th>  
                                <th style="width:10%"> Pages</th>
                                <th style="width:20%"> Subtotal</th> 
                                                                         
                            </tr>
                        </thead>
                      
                            <tbody style="line-height: 0.75">
                                @foreach($assessments as $key => $assessment)
                                <tr>                                    
                                    <td class="second">{{$assessment->f_name}}</td>
                                    <td class="second">Php {{number_format($assessment->f_amount, 2, '.' , ',') }}</td>
                                    <td class="second">{{$assessment->number_of_copy}}</td> 
                                    <td class="second">{{$assessment->number_of_pages}}</td> 
                                    <td class="second"> Php {{number_format($assessment->amount, 2, '.' , ',') }}</td>
                                </tr>                            
                                @endforeach
                            </tbody>                    
                    </table>                    
                  </div>                
                
            </div>
            <!-- /.card -->
        </div>
        
      </div>    

</div>
@endsection