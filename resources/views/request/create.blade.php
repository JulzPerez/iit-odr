@extends('layouts.app', ['activePage' => 'request', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name) ])

@section('content')
<div class="content">
  <div class="container-fluid">
      
        <div class="row mt-3">
          <div class="col-md-8">
              <div class="card card-danger">
                  <div class="card-header">
                      <h4><b>Request Form<b></h4>
                  </div>
                  <form method="POST" action="{{ route('request.store') }} " enctype="multipart/form-data" id="request_form">
                  @csrf
                      <div class="card-body">
                            <div class="form-group">
                                <label>Document to Request</label>
                                <select class="form-control " name="docID" id="selectDocument"  style="width: 100%;">
                                  <option value=''> --Select-- </option>  
                                  @foreach($docs as $doc)
                                    <option value="{{$doc->id}},{{$doc->require_file_upload}},{{$doc->doc_fee}},{{$doc->auto_assess}}"> 
                                      {{$doc->docName.' '.$doc->docParticular}} 
                                    </option>
                                  @endforeach
                                </select>

                              <!--  @if ($errors->has('docID'))
                                    <span class="text-danger">{{ $errors->first('docID') }}</span>
                                @endif --> 
                            </div>

                            <br>
                            <div class="form-group">
                                <label>Number of Copy </label>
                                <input  type="number" class="form-control" name="copy" value="1">

                                <span class="text-danger error-text copy_error"></span>
                              
                            </div>
                            <br>
                            <div class="form-group">
                                  <label>Purpose of Request</label>
                                  <!-- <input  type="text" class="form-control"  name="request_purpose">  -->
                                  <textarea class="form-control" rows="2" name="request_purpose"></textarea>              
                  
                                  <span class="text-danger error-text request_purpose_error"></span>
                                                      
                            </div>

                                  
                            <br>
                            <div id="displayUpload" style="display:none;">                            
                              <div class="input-group control-group increment" id="displayUpload" >
                                <input type="file" name="filename[]" class="form-control" id="file">
                                <div class="input-group-btn"> 
                                  <button id="btnAddFile" class="btn btn-success btn-sm" type="button">
                                    <span class="material-icons">add </span>Add File
                                  </button>                                
                                </div>                             
                              </div>
                              <div>
                                  <span class="text-danger error-text filename_error"></span>
                              </div> 
                              <div class="clone" style="display:none">
                                <div class="control-group input-group" style="margin-top:10px">
                                  <input type="file" name="filename[]" class="form-control">
                                  <div class="input-group-btn"> 
                                    <button id="btnRemoveFile" class="btn btn-default btn-sm" type="button">
                                      <span class="material-icons">close </span>Remove</button>
                                  </div>
                                </div>
                              </div>
                            </div> 
                           
                      <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Add Request</button>
                      </div>
                      
                    </form>
                  
              </div>
              <!-- /.card -->
          </div>
        </div>    

  </div>
</div>
@endsection

@push('js')

<script type="text/javascript">
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $(document).ready(function () {
             
          $('#selectDocument').on('change',function(e) {
          
          var doc_key = e.target.value;
          console.log(doc_key);
          
          var res = doc_key.split(',');
          var required = res[1];
      
          if(required==='1')
          {            
            document.getElementById("displayUpload").style.display = "block";         
            //console.log();
          }
          else
          {            
            document.getElementById("displayUpload").style.display = "none";           
            //console.log();
          }
            
        });   

        $('#selectRequest').on('change',function(e) {
          
          var request_id = e.target.value;
           
          document.getElementById('request_id').value = request_id; 
    
        });   
        
      });

      $(function()
      {
          $("#request_form").on('submit', function(e){
              e.preventDefault();

              if($('#selectDocument').val()==="")
              {
               
                Swal.fire({
                  text: 'Please select a document to request.',
                  icon: 'warning',
                  showConfirmButton: true,
                })
              }

              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              $.ajax({
                  url:$(this).attr('action'),
                  method:$(this).attr('method'),
                  data:new FormData(this),
                  processData:false,
                  dataType:'json',
                  contentType:false,
                  beforeSend:function(){
                      $(document).find('span.error-text').text('');
                  },
                  success:function(data){
                      if(data.status == 0){
                          $.each(data.error, function(prefix, val){
                              $('span.'+prefix+'_error').text(val[0]);
                          });
                      }else{
                          $('#request_form')[0].reset();
                            //Swal.Fire('Your Post as been submited!','success');
                            window.location.href = "{{route('request.index')}}";
                          
                      }
                  }
              });
          });
        }); 
        
        $(document).ready(function() {

          $("#btnAddFile").click(function(){ 
              var html = $(".clone").html();
              $(".increment").after(html);
          });

          $("#request_form").on("click",".btn-default",function(){ 
              $("#btnRemoveFile").parents(".control-group").remove();
          });

        });

</script>

@endpush


