@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav-order')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
        
            <div class="col-xs-12">
                
                <h1 class="section-heading blue-text">Notifications</h1>
                
                {!! errors($errors) !!}
                
                <div class="col-xs-12">
                
                @if( count($notifications) > 0 )
                
                    @foreach( $notifications as $notification )
                    <p>
                        <a href="{{ strlen($notification->link) > 2 ? '/user/'.$notification->link : '#' }}">{{ $notification->created_at->format('Y-M-d H:i') }} | {{ $notification->from ? $notification->from->name : "" }}: {{ $notification->name }}</a>
                    </p>
                    @endforeach
                
                {!! $notifications->render() !!}
                
                @else
                
                <h2 class="section-heading green-text">No Notifications yet.</h2>
                
                @endif
                
                </div>
                
            </div>
        </div>
        
        
    </div>
</section>


@stop