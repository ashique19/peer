<section class="row client-nav-area lightGray-bg">
    <div class="col-sm-10 col-sm-offset-1 col-xs-12">
        <ul class="nav nav-tabs no-margin hidden-xs">
            <li><a href="{{route('userDashboard')}}">Dashboard</a></li>
            <li><a href="{{action('UserAccounts@profile')}}">Profile</a></li>
            <li>
                <a href="{{action('UserChats@indexAndOffers')}}">Inbox | Offer 
                    <span class="counter-icon">
                        {{auth()->user()->receivedChats()->unread()->count()}}/{{auth()->user()->buyOffers()->notReply()->notAgreed()->count()}}
                    </span>
                </a>
            </li>
            <li><a href="{{action('Travels@travellerSearchByBuyer')}}">Traveler Search</a></li>
            <li><a href="{{action('Payments@buyer')}}">Payment</a></li>
            <li><a href="{{action('BuyOrders@newOrder')}}">Airposted Express Mail</a></li>
            <!--<li><a href="{{action('Labels@showLabelToUser')}}">Label</a></li>-->
            <li><a href="{{action('Dashboard@setUserTypeToTraveller')}}">Switch to Traveler</a></li>
        </ul>
        <a class="btn btn-block blue-text hidden-sm hidden-md hidden-lg" role="button" data-toggle="collapse" href="#client-nav-xs" aria-expanded="false" aria-controls="client-nav-xs"><i class="fa fa-caret-down"></i> Menu</a>
        <ul class="nav nav-tabs no-margin hidden-sm hidden-md hidden-lg collapse user-nav" id="client-nav-xs">
            <li><a href="{{route('userDashboard')}}">Dashboard</a></li>
            <li><a href="{{action('UserAccounts@profile')}}">Profile</a></li>
            <li>
                <a href="{{action('UserChats@indexAndOffers')}}">Inbox | Offer 
                <span class="counter-icon">
                    {{auth()->user()->receivedChats()->unread()->count()}}/{{auth()->user()->buyOffers()->notReply()->notAgreed()->count()}}
                </span>
                </a>
            </li>
            <li><a href="{{action('Travels@travellerSearchByBuyer')}}">Traveler Search</a></li>
            <li><a href="{{action('Payments@buyer')}}">Payment</a></li>
            <li><a href="{{action('BuyOrders@newOrder')}}">Airposted Express Mail</a></li>
            <!--<li><a href="{{action('Labels@showLabelToUser')}}">Label</a></li>-->
            <li><a href="{{action('Dashboard@setUserTypeToTraveller')}}">Switch to Traveler</a></li>
        </ul>
    </div>
</section>