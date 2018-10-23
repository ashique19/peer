

<!-- START PAGE SIDEBAR -->
<!--<div class="page-sidebar">-->
    <!-- START X-NAVIGATION -->
    
    @if(auth()->user())
    <ul class="x-navigation x-navigation-horizontal public">
        <li class="xn-logo">
            <a href="{{route('dashboard')}}">TeamSourcing</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="pull-right">
            <a href="{{route('logout')}}"><span class="fa fa-lock"></span><span class="xn-text">Logout</span></a>                        
        </li>
        <li class="pull-right">
            <a href="{{route('dashboard')}}"><span class="fa fa-shopping-cart"></span><span class="xn-text">Interview list</span></a>                        
        </li>
        <li class="pull-right">
            <a href="{{url(action('dumbpages@contact'))}}"><span class="fa fa-globe"></span><span class="xn-text">Contact us</span></a>                        
        </li>
        <li class="pull-right">
            <a href="{{url(action('dumbpages@privacyPolicy'))}}"><span class="fa fa-pencil"></span><span class="xn-text">Privacy</span></a>                        
        </li>
        <li class="pull-right">
            <a href="{{url(action('dumbpages@aboutUs'))}}"><span class="fa fa-smile-o"></span><span class="xn-text">About</span></a>                        
        </li>
    </ul>
    @else
    <ul class="x-navigation x-navigation-horizontal public">
        <li class="xn-logo">
            <a href="{{route('dashboard')}}">TeamSourcing</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="pull-right">
            <a href="{{route('login')}}"><span class="fa fa-unlock-alt"></span> <span class="xn-text">Login</span></a>                        
        </li class="pull-right">
        <li class="pull-right">
            <a href="{{url(action('dumbpages@openClientAccount'))}}"><span class="fa fa-user-secret"></span> <span class="xn-text">Open client account</span></a>                        
        </li class="pull-right">
        <li class="pull-right">
            <a href="{{url(action('dumbpages@openCandidateAccount'))}}"><span class="fa fa-users"></span> <span class="xn-text">Open candidate account</span></a>                        
        </li class="pull-right">
        <li class="pull-right">
            <a href="{{url(action('dumbpages@aboutUs'))}}"><span class="fa fa-smile-o"></span> <span class="xn-text">About us</span></a>                        
        </li>
        <li class="pull-right">
            <a href="{{url(action('dumbpages@privacyPolicy'))}}"><span class="fa fa-pencil"></span> <span class="xn-text">Privacy policy</span></a>                        
        </li>
        <li class="pull-right">
            <a href="{{url(action('dumbpages@contact'))}}"><span class="fa fa-globe"></span> <span class="xn-text">Contact us</span></a>                        
        </li>
    </ul>
    @endif
    <!-- END X-NAVIGATION -->
<!--</div>-->
<!-- END PAGE SIDEBAR -->
