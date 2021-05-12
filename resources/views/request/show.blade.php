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
      <div class="row">
        <div class="col-md-12">
          <a href="/request">
            <button type="button" class="btn btn-primary float-right"><i class="fas fa-arrow-left"></i> Back to assessments</button>
          </a>
        </div>
      </div>
      <hr>
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
                                            
                                        </form>
                                    </td>
                                    <td class="second"> Php {{number_format($assessment->amount, 2, '.' , ',') }}</td>
                                    <td>
                                        <form action="{{ route('assessments.destroy', $assessment->fees_id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            
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