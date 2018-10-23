<header class="row @yield('header-menu') ">
<!--<header class="row fixed">-->
    <div class="container no-padding">
        <ul class="x-navigation x-navigation-horizontal active">
        <li class="xn-logo">
            <a href="{{route('home')}}">
                @if( \Request::route()->getName() == 'home' )
                <img src="/public/img/settings/logo-white.png" width="200"></img>
                @else
                <img src="/public/img/settings/logo.png" width="200"></img>
                @endif
            </a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        
        <!-- User Menu -->
        @if(auth()->user())
        
        <li class="pull-right push-up-20">
            <a class="user-menu" type="button" data-trigger="click" data-toggle="popover" data-container="body" data-placement="bottom" data-content="
            <ul class='profile-img-drop'>
                <li><a href='{{action('UserAccounts@profile')}}'>Profile</a></li>
                <li class='divider'></li>
                <li><a href='{{action('UserAccounts@modify')}}'>Account</a></li>
                <li class='divider'></li>
                <li><a href='{{route('userDashboard')}}'>Dashboard</a></li>
                <li class='divider'></li>
                <li><a href='{{action('AccessController@logout')}}'>Sign Out</a></li>
            </ul>
            ">
                <img src="@if(strlen(auth()->user()->user_photo) > 0){{auth()->user()->user_photo}} @else /public/img/settings/no-image-available-3.png @endif" alt="User Area">
                <span class="slim">Hello,</span> {{auth()->user()->firstname}} 
            </a>
        </li>
        @else
        
        <li class="pull-right push-up-20"><a class="btn btnGray-bg white-border login-signup" type="button" href="#" data-toggle="modal" data-target="#signup-modal">Sign up</a></li>
        <li class="pull-right push-up-20"><a class="btn btnGray-bg white-border login-signup" type="button" href="#" data-toggle="modal" data-target="#login-modal">Log in</a></li>
        
        @endif
        <!-- END POWER OFF -->    
        
        <li class="pull-right push-up-20"><a href="{{action('StaticPageController@contact')}}">CONTACT</a></li>
        <li class="pull-right push-up-20"><a href="{{action('StaticPageController@faq')}}">FAQ</a></li>
        <li class="pull-right push-up-20 link-to-how-it-works dropdown">
            <a href="#services">HOW IT WORKS</a>
            <ul>
                <li><a href="{{action('StaticPageController@howItWorksTravelers')}}">Travel and Earn</a></li>
                <li><a href="{{action('StaticPageController@howItWorksBuyers')}}">Order through Traveler</a></li>
                <li><a href="{{action('StaticPageController@howItWorksAirexpress')}}">Order through Airposted Express Mail</a></li>
            </ul>
        </li>
        <li class="pull-right push-up-20"><a href="{{action('StaticPageController@aboutUs')}}">ABOUT</a></li>
        
    </ul>
    </div>
</header>