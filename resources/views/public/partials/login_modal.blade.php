<div class="modal fade modal-theme-1" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            
            <aside class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </aside>
            
            <article class="modal-body">
            
                <section class="row text-center">
                    <a href="{{action('AccessController@social', 'facebook')}}" class="btn btn-lg btn-block blue-bg white-text">
                        LOG IN WITH FACEBOOK
                    </a>
                    <p class="text-center or push-up-30 push-down-20"><span>or</span></p>
                </section>
                
                <section class="login-area row">
                    {!! Form::open(['url'=> action('AccessController@postLogin'), 'method'=>'POST', 'class'=> 'ajax-login', 'login-url'=> action('AccessController@postAjaxLogin') ]) !!}
                    
                    <div class="col-xs-12 no-padding">
                        {!! Form::text('email', old('email'), ['class'=> 'form-control', 'placeholder'=> 'Email']) !!}
                    </div>
                    <div class="col-xs-12 no-padding">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="col-xs-12 no-padding">
                        <p class="login-message"></p>
                    </div>
                    <div class="col-xs-12 col-sm-6 no-padding">
                        <a class="blue-text push-up-15 block" role="button" data-toggle="collapse" href="#forgot-password" aria-expanded="false" aria-controls="forgot-paasword">Forgot Password?</a>
                    </div>
                    
                    <div class="col-xs-12 col-sm-6 no-padding text-right pull-up-20">
                        <button type="submit" class="btn btn-lg gray-text gray-border white-bg login-button">LOG IN</button>
                        <p class="push-up-5">
                            Don't have an account? <a href="{{route('signup')}}" class="blue-text">Sign up now.</a>
                        </p>
                    </div>
                    
                    @include('public.partials.notice')
                    
                    {!! Form::close() !!}
                </section>
                
                <section class="row forgot-password collapse" id="forgot-password">
                    
                    <div class="or push-up-20 push-down-20"></div>
                    
                    <a href="#" class="btn btn-lg btn-block green-bg white-text">
                        RETRIEVE PASSWORD
                    </a>
                    
                    {!! Form::open(['method'=>'post', 'url'=>action('AccessController@forgotPassword'), 'class'=>'form', 'role'=>'form']) !!}
                    
                    <div class="col-xs-12 no-padding">
                        {!! Form::email('recovery_email',null, ['class'=>'form-control', 'placeholder'=>'Enter your email address', 'required'=>'']) !!}
                    </div>
                    
                    <div class="col-xs-12 no-padding text-right pull-up-20">
                        <button type="submit" class="btn btn-lg gray-text gray-border white-bg login-button">SUBMIT</button>
                    </div>
                    
                    {!! Form::close() !!}
                    
                    
                    
                </section>
                
            </article>
            
        </div>
    </div>
</div>
