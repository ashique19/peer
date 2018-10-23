@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <h1 class="section-heading black-text">Messages</h1>
        
        <div class="col-xs-12 push-up-50 no-padding">
            @if($errors->any())
            <div class="alert alert-warning">
                @foreach($errors->all() as $error)
                <p class="black-text">{{$error}}</p>
                @endforeach
            </div>
            @endif
            
            <section class="row messages">
                
                
                <div class="col-sm-3 push-down-20 no-padding">
                    <nav class="btn-group btn-block message-buttons" role="tablist">
                        <a href="#inbox" role="tab" data-toggle="tab" class="btn btn-lg square-border col-xs-6">Inbox</a>
                        <a href="#outbox" role="tab" data-toggle="tab" class="btn btn-lg square-border col-xs-6">Outbox</a>
                    </nav>
                    <div class="row nicescroll message-list tab-content">
                    <ul role="tabpanel" id="inbox" class="tab-pane active list-group inbox">
                        <li class="list-group-item blue-bg"><h5 class="text-center white-text">Inbox</h5></li>
                        @if(count($myReceivedMessages) > 0)
                        @foreach($myReceivedMessages as $message)
                        <li class="list-group-item">
                            <a href="#" get-message="{{url("/user/my-messages/".$message->id)}}" @if($message->is_read == 0 ) class="unread" @endif>
                                <h4>{{$message->name}}</h4>
                                <p>
                                    @if($message->from){{$message->from->name}} @endif
                                </p>
                                <span class="date pull-right">
                                    {{$message->created_at}}
                                </span>
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <ul role="tabpanel" id="outbox" class="tab-pane list-group outbox">
                        <li class="list-group-item blue-bg"><h5 class="text-center white-text">Outbox</h5></li>
                        @if(count($mySentMessages) > 0)
                        @foreach($mySentMessages as $message)
                        <li class="list-group-item light-gray-bg">
                            <a href="#" get-message="{{url("/user/my-messages/".$message->id)}}">
                                <h4>{{$message->name}}</h4>
                                <p>
                                    @if($message->to){{$message->to->name}} @endif
                                </p>
                                <span class="date pull-right">
                                    {{$message->created_at}}
                                </span>
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    </div>
                </div>
                
                <div class="col-sm-9 message-details no-padding nicescroll">
                    <div class="message row white-bg">
                        <h4>Please select a message from list. </h4>
                    </div>
                </div>
                
            </section>
            
        </div>
        
    </div>
</section>


@stop