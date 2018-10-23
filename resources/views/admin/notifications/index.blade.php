
@extends('admin.layout')

@section('title') Notification @stop

@section('main')

<h1><center>Notifications @if($notifications) : {{$notifications->total()}} @endif</center></h1>

 <section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">Send Notification</h4>
 
    {!! Form::open( ['url'=> action('Notifications@store'), 'class'=> 'form form-inline', 'enctype'=>'multipart/form-data' ]) !!}
    
        {!! Form::hidden('notification_from', auth()->user()->id ) !!}
            
        <div class="col-sm-6 col-xs-12">
            {!! Form::textarea('name', old('name') , ['class'=>'form-control', 'placeholder'=> 'Type is Message', 'required'=> '']) !!}
        </div>
        
        <div class="col-sm-6 col-xs-12 well push-up-10">
            
            <div class="row push-up-10">
                <div class="input-group col-xs-12">
                    <select name="notification_to" id="notification_to" class="form-control user-search" style="margin: 0px;" required>
                        <option value="">-Select Receiver-</option>
                    </select>
                </div>
            </div>
            
            <div class="row push-up-20">
                <div class="input-group col-xs-12">
                    <span class="input-group-addon" id="link">https://airposted.com/user/</span>
                    <input name="link" type="text" class="form-control" id="link" placeholder="URL (optional)" aria-describedby="link" style="margin: 0px;">
                </div>
            </div>
            
            <div class="row">
                {!! Form::submit('Send', ['class'=>'form-control btn btn-success btn-block push-up-20', 'style'=> 'margin-left: 0px; margin-right: 0px;']) !!}
            </div>
            
        </div>
        
        <div class="col-xs-12">{!! errors($errors) !!}</div>
            
{!! Form::close() !!}

</section>

<section class="col-md-10 col-md-offset-1 push-down-20">
    
    <h4 class="page-title btn-info">Filters: 
        <a href="{{ action('Notifications@index') }}" class="btn btn-sm">All</a> | 
        <a href="{{ action('Notifications@sent') }}" class="btn btn-sm">Sent</a> | 
        <a href="{{ action('Notifications@received') }}" class="btn btn-sm">Received</a> | 
        <a href="{{ action('Notifications@undelivered') }}" class="btn btn-sm">Undelivered</a> | 
        <span class="btn btn-sm">
        {!! Form::open(['url'=> action('Notifications@search')]) !!}
        {!! Form::select('search_name', [], null, ['class'=> 'form-control user-search', 'placeholder'=> '-Filter by User-', 'required'=> '']) !!}
        {!! Form::submit('Filter', ['class'=> 'btn btn-primary btn-sm']) !!}
        {!! Form::close() !!}
        </span>
    </h4>
    
    <div class="col-xs-12 scrollable">
        
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th width="70">Date</th>
                    <th width="150">From</th>
                    <th width="150">To</th>
                    <th>Notification</th>
                    <th width="30"></th>
                </tr>
            </thead>
            <tbody>
                @if($notifications)
                    @foreach($notifications as $notification)
                    <tr>
                        <td>
                            <span class="small">
                                {!! $notification->created_at->format('M-d H:i') !!}
                            </span>
                        </td>
                        <td>
                            @if( $notification->notification_from == auth()->user()->id )
                            <a href="#" class="btn btn-xs">Me</a>
                            @else
                            <a href="{{ action('Notifications@byUser', $notification->notification_from) }}" class="btn btn-xs">
                                {!! $notification->from ? $notification->from->name : "" !!}
                                &nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i>
                            </a>
                            @endif
                        </td>
                        <td>
                            @if( $notification->notification_to == auth()->user()->id )
                            <a href="#" class="btn btn-xs">Me</a>
                            @else
                            <a href="{{ action('Notifications@byUser', $notification->notification_to) }}" class="btn btn-xs">
                                {!! $notification->to ? $notification->to->name : "" !!}
                                &nbsp;&nbsp;&nbsp;<i class="fa fa-chevron-right"></i>
                            </a>
                            @endif
                        </td>
                        <td>
                            @if( $notification->notification_to == auth()->user()->id )
                            <i class="fa fa-circle text-success"></i>
                            @else
                            <i class="fa fa-circle @if($notification->is_delivered ==1)text-success @else text-warning @endif"></i>
                            @endif
                            {{$notification->name}}
                        </td>
                        <td>
                            {!! deletes('Notifications', $notification['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-xs']) !!}
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        
        {!! $notifications->render() !!}
        
    </div>
</section>

@stop
        