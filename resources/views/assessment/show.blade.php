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
      <div class="row mt-1">
        <div class="col-md-12">
          <a href="/assessments">
            <button type="button" class="btn btn-default float-left"><i class="fas fa-arrow-left"></i> Back</button>
          </a>
        </div>
      </div>
      
        <div class="row ">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h6 class="lead">Request Details</h6>
              </div>
              <div class="card-body">
                  <div class="form-group">
                      <label class="text-muted">Requester</label>
                      <h5>{{ucfirst($request_info->first_name)}} {{ucfirst($request_info->middle_name)}} {{ucfirst($request_info->last_name)}}</h5>
                  </div>
                  <div class="form-group">
                      <label class="text-muted">Requested Document</label>
                      <h5>{{ucfirst($request_info->docName)}} {{ucfirst($request_info->docParticular)}} </h5>
                  </div>

              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                  <h6 class="lead">Assign Fees</h6>
                </div>
                <div class="card-body"> 
                  <form method="POST" action="{{ route('assessments.store') }} ">
                  @csrf                    
                          <div class="form-group">
                            <label class="text-muted">Name of Fee</label>
                            <select class="form-control select2bs4" name="fee_id" style="width: 100%;">
                                @foreach($fees as $key => $fee)
                                  <option value="{{$fee->id}}" class="list-text-color">{{ucwords($fee->fee_name)}} --------- Php{{$fee->amount}} </option>                                  
                                @endforeach                                
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="text-muted">Number of Copy: </label>
                            <input  type="number" name="copy" value="1" size="5">                            
                          </div>
                          <div class="form-group">
                            <label class="text-muted">Number of pages: </label>
                            <input  type="number" name="pages" value="1" size="5">                            
                          </div>
                          
                          <input  type="hidden" name="request_id" value="{{$request_id}}">

                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Add</button>
                          </div>
                    
                    </form>
                </div>              
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">        
          <div class="col-md-12 col-sm-12">
            <div class="card card-outline card-primary">    
            <div class="card-header">
            <p class="text-info lead">ASSESSMENT TOTAL:</p> <h4> <strong class="text-danger">Php {{number_format($total, 2, '.' , ',')}}</strong> </h4>
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
                                <th style="width:10%"> Action</th>                                          
                            </tr>
                        </thead>
                      
                            <tbody style="line-height: 0.75">
                                @foreach($assessments as $key => $assessment)
                                <tr>
                                    
                                    <td class="second">{{$assessment->f_name}}</td>
                                    <td class="second">Php {{number_format($assessment->f_amount, 2, '.' , ',') }}</td>
                                    <td class="second">{{$assessment->number_of_copy}}</td>
                                    <td class="second">{{$assessment->number_of_pages}}</td>
                                  <!--   <td class="second">                                            
                                            <input  type="hidden" name="request_id" value="{{$request_id}}">
                                            <input  type="hidden" name="amount" value="{{$assessment->f_amount}}">
                                       
                                    </td> -->
                                    <td class="second"> Php {{number_format($assessment->amount, 2, '.' , ',') }}</td>
                                    <td>
                                        <form action="{{ route('assessments.destroy', $assessment->fees_id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input  type="hidden" name="request_id" value="{{$request_id}}">
                                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                        </form>
                                    </td>
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
</div>
@endsection