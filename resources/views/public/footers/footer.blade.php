@if( $setting = \App\Setting::first() )
<footer class="footer col-xs-12 no-padding push-up-50">
    
    <div class="row pull-down-35">
        <section class="col-sm-3 col-sm-offset-1 col-xs-12 site-links">
                <h3>Company</h3>
                <p><a href="{{action('StaticPageController@aboutUs')}}" target="_blank" class="white-text">About Us</a></p>
                <p><a href="{{action('StaticPageController@page', 'career')}}" target="_blank" class="white-text">Careers</a></p>
                <p><a href="{{action('StaticPageController@page', 'terms-of-service')}}" target="_blank" class="white-text">Terms</a></p>
                <p><a href="{{action('StaticPageController@page', 'privacy-policy')}}" target="_blank" class="white-text">Privacy Policy</a></p>
                <!--<p><a href="{{action('StaticPageController@page', 'blog')}}" target="_blank" class="white-text">Blog</a></p>-->
                
        </section>
        <section class="col-sm-4 col-xs-12 contact">
            <h3>Contact Us</h3>
            <p>Fairfax, Virginia, 22030 USA</p>
            <p class="push-up-15">{{$setting->helpmail}}</p>
            
            {!! Form::open(['url'=> action('Subscribers@subscribe'),'class'=>'form form-inline hidden']) !!}
            <h3 class="white-text">Stay in Touch</h3>
            <ul class="list-inline">
                <li class="col-xs-9 col-sm-5"><input type="text" name="email" class="form-control white-bg blue-text square-border" placeholder="Email" /></li>
                <li class="col-xs-3 col-sm-3"><button class="btn green-bg white-text square-border">Send</button></li>
            </ul>
            {!! Form::close() !!}
        </section>
        <section class="col-sm-3 col-xs-12 no-padding">
            <div class="col-xs-12">
                <h3>Connect</h3>
                <p class="social">
                    <a target="_blank" rel="nofollow" href="{{$setting->facebook}}" class="btn btn-rouded"><i class="fa fa-facebook"></i></a>
                    <a target="_blank" rel="nofollow" href="{{$setting->twitter}}" class="btn btn-rouded"><i class="fa fa-twitter"></i></a>
                    <a target="_blank" rel="nofollow" href="{{$setting->google_plus}}" class="btn btn-rouded"><i class="fa fa-google-plus"></i></a>
                    <a target="_blank" rel="nofollow" href="https://www.instagram.com/airpostedus/" class="btn btn-rouded"><i class="fa fa-instagram"></i></a>
                </p>
            </div>
            
        </section>
    </div>
    <!--<div class="col-xs-12 copyright"><p class="text-center">Copyright <i class="fa fa-copyright"></i> Airposted LLC, {{date('Y')}}. All rights reserved.</p></div>-->
</footer>

@endif
