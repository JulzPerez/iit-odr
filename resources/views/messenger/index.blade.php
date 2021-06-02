@extends('layouts.master')

@section('main_content')
  
<div class="container-fluid">    

    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">

            <?php $count = Auth::user()->newThreadsCount(); ?>

               <!--  @if($count > 0)
                    <div class="card-header">You have {{ $count }} new messages  </div>
                @endif -->
                <div class="card-header">Message Threads </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered table-striped">
                            <!--  <thead>
                                    <tr>
                                        <th style="width:5%">Thread Name</th>
                                                                                    
                                    </tr>
                                </thead> -->
                            
                                <tbody style="line-height: 0.75">

                                        @foreach($threads as $thread)
                                        <tr>
                                            <td>
                                            <a href="{{ route('messages.show', $thread->id) }}">
                                                {{ $thread->subject }}
                                            
                                            </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            

        </div>
    </div>
</div>
   
@endsection
