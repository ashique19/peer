<section class="row client-nav-area lightGray-bg">
    <div class="col-sm-10 col-sm-offset-1 col-xs-12">
        <ul class="nav nav-tabs no-margin hidden-xs">
            <li><a href="{{route('userDashboard')}}">Dashboard</a></li>
            <li><a href="{{action('UserAccounts@profile')}}">Profile</a></li>
            <li><a href="{{action('Payments@buyer')}}">Payment</a></li>
            <li><a href="{{action('BuyOrders@newOrder')}}">Order</a></li>
            <li>
                <a href="#" class="notification" data-toggle="popover" 
                                                 data-placement="bottom" 
                                                 data-html="true" 
                                                 title="Notifications" 
                                                 data-content='
                                                 @if( auth()->user()->receivedNotifications()->count() > 0 )
                                                 @foreach( auth()->user()->receivedNotifications()->latest()->take(3)->get() as $notification )
                                                 <p>
                                                    <span class="small">{{ $notification->created_at->diffForHumans() }}</span>
                                                    <br />
                                                    <a href="{{ strlen($notification->link) > 2 ? '/user/'.$notification->link : '#' }}">{{ $notification->from ? $notification->from->name : "" }}: {{ $notification->name }}</a>
                                                 </p>
                                                 @endforeach
                                                 @else
                                                 <p>No Notifications yet</p>
                                                 @endif
                                                 <a href="{{ action('Notifications@userView') }}" class="btn btn-block blue-bg white-text">See All</a>
                                                 '>
                    <i class="fa fa-globe fa-2x blue-text">
                        <sup class="green-text">{{ auth()->user()->receivedNotifications()->where('is_delivered', 0)->count() }}</sup>
                    </i>
                    
                </a>
            </li>
        </ul>
        <a class="btn btn-block blue-text hidden-sm hidden-md hidden-lg" role="button" data-toggle="collapse" href="#client-nav-xs" aria-expanded="false" aria-controls="client-nav-xs"><i class="fa fa-caret-down"></i> Menu</a>
        <ul class="nav nav-tabs no-margin hidden-sm hidden-md hidden-lg collapse user-nav" id="client-nav-xs">
            <li><a href="{{route('userDashboard')}}">Dashboard</a></li>
            <li><a href="{{action('UserAccounts@profile')}}">Profile</a></li>
            <li><a href="{{action('Payments@buyer')}}">Payment</a></li>
            <li><a href="{{action('BuyOrders@newOrder')}}">Order</a></li>
            <li>
                <a href="#" class="notification" data-toggle="popover" 
                                                 data-placement="bottom" 
                                                 data-html="true" 
                                                 title="Notifications" 
                                                 data-content='
                                                 @if( auth()->user()->receivedNotifications()->count() > 0 )
                                                 @foreach( auth()->user()->receivedNotifications()->latest()->take(3)->get() as $notification )
                                                 <p>
                                                    <span class="small">{{ $notification->created_at->diffForHumans() }}</span>
                                                    <br />
                                                    <a href="{{ strlen($notification->link) > 2 ? '/user/'.$notification->link : '#' }}">{{ $notification->from ? $notification->from->name : "" }}: {{ $notification->name }}</a>
                                                 </p>
                                                 @endforeach
                                                 @else
                                                 <p>No Notifications yet</p>
                                                 @endif
                                                 <a href="{{ action('Notifications@userView') }}" class="btn btn-block blue-bg white-text">See All</a>
                                                 '>
                    <i class="fa fa-globe fa-2x blue-text">
                        <sup class="green-text">{{ auth()->user()->receivedNotifications()->where('is_delivered', 0)->count() }}</sup>
                    </i>
                    
                </a>
            </li>
        </ul>
    </div>
</section>