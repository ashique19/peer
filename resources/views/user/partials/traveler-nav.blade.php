<section class="row client-nav-area lightGray-bg">
    <div class="col-sm-10 col-sm-offset-1 col-xs-12">
        <ul class="nav nav-tabs no-margin hidden-xs">
            <li><a href="{{route('userDashboard')}}">Dashboard</a></li>
            <li><a href="{{action('UserAccounts@profile')}}">Profile</a></li>
            <li>
                <a href="{{action('UserChats@indexAndOffers')}}">Inbox | Offer 
                    <span class="counter-icon">
                        {{auth()->user()->receivedChats()->unread()->count()}}/{{auth()->user()->carryOffers()->notReply()->notAgreed()->count()}}
                    </span>
                </a>
            </li>
            <li><a href="{{action('Buyers@buyerSearchByTraveller')}}">Buyer Search</a></li>
            <li><a href="{{action('Payments@traveller')}}">Payment</a></li>
            <li><a href="{{action('Dashboard@setUserTypeToBuyer')}}">Switch to Buyer</a></li>
        </ul>
        <a class="btn btn-block blue-text hidden-sm hidden-md hidden-lg" role="button" data-toggle="collapse" href="#traveller-nav-xs" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-caret-down"></i> Menu</a>
        <ul class="nav nav-tabs no-margin hidden-sm hidden-md hidden-lg collapse user-nav" id="traveller-nav-xs">
            <li><a href="{{route('userDashboard')}}">Dashboard</a></li>
            <li><a href="{{action('UserAccounts@profile')}}">Profile</a></li>
            <li>
                <a href="{{action('UserChats@indexAndOffers')}}">Inbox | Offer 
                    <span class="counter-icon">
                        {{auth()->user()->receivedChats()->unread()->count()}}/{{auth()->user()->carryOffers()->notReply()->notAgreed()->count()}}
                    </span>
                </a>
            </li>
            <li><a href="{{action('Buyers@buyerSearchByTraveller')}}">Buyer Search</a></li>
            <li><a href="{{action('Payments@traveller')}}">Payment</a></li>
            <li><a href="{{action('Dashboard@setUserTypeToBuyer')}}">Switch to Buyer</a></li>
        </ul>
    </div>
</section>