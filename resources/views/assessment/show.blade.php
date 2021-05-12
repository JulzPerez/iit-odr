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
    
      <div class="row ">
        <div class="col-md-12">
            <div class="card">
              <div class="card-body"> 
                <form method="POST" action="{{ route('assessments.store') }} ">
                @csrf                    
                          <div class="form-group">
                            <label>Fees</label>
                            <select class="duallistbox " multiple="single" name="fee_id[]">
                                @foreach($fees as $key => $fee)
                                  <option value="{{$fee->id}}" class="list-text-color"> {{++$key}}. {{ucwords($fee->fee_name)}} --------- Php{{$fee->amount}} </option>                                  
                                @endforeach 
                               
                            </select>
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
          <div class="col-md-12">
            <div class="card">    
            <div class="card-header">
               ASSESSMENT TOTAL: Php {{number_format($total, 2, '.' , ',')}}
            </div>           
                  <div class="card-body">  
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:30%"> Name of Fee</th>  
                                <th style="width:20%"> Amount</th>  
                                <!-- <th style="width:10%"> Copy</th>  -->
                                <th style="width:15%"> Number of Pages</th>  
                                <th style="width:10%"> Subtotal</th> 
                                <th style="width:15%"> Action</th>                                          
                            </tr>
                        </thead>
                      
                            <tbody style="line-height: 0.75">
                                @foreach($assessments as $key => $assessment)
                                <tr>
                                    
                                    <td class="second">{{$assessment->f_name}}</td>
                                    <td class="second">Php {{number_format($assessment->f_amount, 2, '.' , ',') }}</td>
                                    <!-- <td class="second">{{$assessment->number_of_copy}}</td> -->
                                    <td class="second">
                                        <form action="{{ route('assessments.update', $assessment->fees_id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                            <input  type="number" name="pages" value="{{$assessment->number_of_pages}}" size="5" >
                                            <button class="btn btn-primary btn-sm" type="submit">Save <i class="fas fa-save"></i></button>
                                            <input  type="hidden" name="request_id" value="{{$request_id}}">
                                            <input  type="hidden" name="amount" value="{{$assessment->f_amount}}">
                                        </form>
                                    </td>
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
@endsection