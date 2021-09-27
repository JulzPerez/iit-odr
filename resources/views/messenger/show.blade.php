@extends('layouts.app', ['activePage' => 'request', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary direct-chat direct-chat-primary ">
                    <div class="card-header"><h3 class="card-title">Subject Thread:  {{$thread->subject}}</h3></div>
                </div>
                <div class="card-body">
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->

                        @foreach($thread->messages as $message)

                        @if($message->user->id === Auth::id() )

                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">{{ $message->user->first_name .' '.$message->user->last_name  }}</span>
                            <span class="direct-chat-timestamp float-right">Posted {{ $message->created_at->diffForHumans() }}</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="/images/girl.png" alt="message user image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                            {{ $message->body }} 
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                        @else

                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-right">{{ $message->user->first_name .' '.$message->user->last_name  }}</span>
                            <span class="direct-chat-timestamp float-left">Posted {{ $message->created_at->diffForHumans() }}</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="/images/profile.png" alt="message user image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                            {{ $message->body }} 
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        @endif
                        @endforeach
                    </div>   

                </div>
                <div class="card-footer">
                        <form action="{{ route('messages.update', $thread->id) }}" method="post">
                            {{ method_field('put') }}
                            {{ csrf_field() }}

                            <!-- Message Form Input -->
                            <div class="row" >
                                <div class="col-md-10" style="display:inline-block">
                                    <!-- <div class="input-group" >  -->
                                        <textarea name="message" {{ old('message') }} style="width:100%; height:20px" ></textarea>
                                       
                                  <!--   </div>  -->
                                </div>  
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary" > <span class="material-icons">send</span> Send</button>
                                </div>
                            </div>                           

                            @if($users->count() > 0)
                                
                                    @foreach($users as $user)                                        
                                        <input type="hidden" name="recipients[]" value="{{ $user->id }}">                                      
                                    @endforeach
                                
                            @endif
                        
                            
                        
                        </form>                  

                </div>
            </div>
            
        </div>
                  
    </div>
</div>
@endsection
