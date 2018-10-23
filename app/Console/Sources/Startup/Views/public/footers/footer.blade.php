@if( $setting = \App\Setting::first() )
<footer class="footer col-xs-12 no-pull">
    <img src="/public/img/settings/footer.jpg" class="background">
    <div class="row">
        <section class="col-sm-3 col-sm-offset-1 col-xs-12 site-links">
                <h3>Company</h3>
                <p><a href="{{action('StaticPageController@page', 'career')}}" target="_blank" class="white-text">Career</a></p>
                <p><a href="{{action('StaticPageController@page', 'terms-of-service')}}" target="_blank" class="white-text">Terms</a></p>
                <p><a href="{{action('StaticPageController@page', 'privacy-policy')}}" target="_blank" class="white-text">Privacy Policy</a></p>
                <p><a href="{{action('StaticPageController@page', 'blog')}}" target="_blank" class="white-text">Blog</a></p>
                <p class="social">
                    <a href="{{$setting->facebook}}" class="btn btn-rouded"><i class="fa fa-facebook"></i></a>
                    <a href="{{$setting->twitter}}" class="btn btn-rouded"><i class="fa fa-twitter"></i></a>
                    <a href="{{$setting->google_plus}}" class="btn btn-rouded"><i class="fa fa-google-plus"></i></a>
                </p>
        </section>
        <section class="col-sm-3 col-xs-12">
            <h3>Contact Us</h3>
            <ul class="list-inline contact white-text">
                <li><i class="fa fa-volume-control-phone"></i> <span>{{$setting->helpline}}</span></li>
                <li><i class="fa fa-paper-plane"></i> <span>{{$setting->helpmail}}</span></li>
                <li><i class="fa fa-map-signs"></i> <span><address>{{$setting->address}} {{$setting->city}} {{$setting->country}} {{$setting->postcode}}</address></span></li>
            </ul>
            
            {!! Form::open(['url'=> action('Subscribers@subscribe'),'class'=>'form form-inline']) !!}
            <h3 class="white-text">Stay in Touch</h3>
            <ul class="list-inline">
                <li class="col-xs-9 col-sm-5"><input type="text" name="email" class="form-control white-bg blue-text square-border" placeholder="Email" /></li>
                <li class="col-xs-3 col-sm-3"><button class="btn green-bg white-text square-border">Send</button></li>
            </ul>
            {!! Form::close() !!}
        </section>
        <section class="col-sm-4 col-xs-12">
            <div class="col-xs-12">
                <h3>Get in Touch</h3>
            </div>
            {!! Form::open(['url'=> action('StaticPageController@postContact')]) !!}
            <div class="col-xs-6 form-group">
                <input type="text" class="form-control white-bg blue-text square-border" placeholder="Name" >
            </div>
            <div class="col-xs-6 form-group">
                <input type="text" class="form-control white-bg blue-text square-border" placeholder="Email" >
            </div>
            <div class="col-xs-12 form-group">
                <input type="text" class="form-control white-bg blue-text square-border" placeholder="Subject" >
            </div>
            <div class="col-xs-12 form-group">
                <textarea row="10" type="text" class="form-control white-bg blue-text square-border" placeholder="Message" ></textarea>
            </div>
            <div class="col-xs-12 form-group">
                <button type="submit" class="btn green-bg white-text white-text square-border pull-right">Send</button>
            </div>
            {!! Form::close() !!}
            
        </section>
    </div>
    <div class="col-xs-12 copyright"><p class="text-center white-text">Copyright <i class="fa fa-copyright"></i> {{$setting->application_name}}, {{date('Y')}}. All rights reserved.</p></div>
</footer>

@endif