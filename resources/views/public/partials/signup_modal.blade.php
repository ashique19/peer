<div class="modal fade modal-theme-1" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            
            <aside class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </aside>
            
            <article class="modal-body">
            
                <section class="row text-center">
                    <a href="{{action('AccessController@social', 'facebook')}}" class="btn btn-lg btn-block blue-bg white-text">
                        SIGN UP WITH FACEBOOK
                    </a>
                    <p class="text-center or push-up-30 push-down-20"><span>or</span></p>
                </section>
                
                <section class="login-area row">
                    {!! Form::open([ 'url'=> action('AccessController@postSignup'), 'method'=>'POST', 'class'=> 'ajax-signup', 'sign-url' => action('AccessController@postAjaxSignup') ]) !!}
                    
                    <div class="col-xs-12 no-padding">
                        {!! Form::text('firstname', old('firstname'), ['class'=> 'form-control', 'placeholder'=> 'First name']) !!}
                    </div>
                    <div class="col-xs-12 no-padding">
                        {!! Form::text('lastname', old('lastname'), ['class'=> 'form-control', 'placeholder'=> 'Last name']) !!}
                    </div>
                    <div class="col-xs-12 no-padding">
                        {!! Form::text('email', old('email'), ['class'=> 'form-control', 'placeholder'=> 'Email']) !!}
                    </div>
                    <div class="col-xs-12 no-padding">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                        <small class="help-text">Must be alpha-numeric and 8 characters long.</small>
                    </div>
                    <div class="col-xs-12 no-padding">
                        <p class="signup-message"></p>
                    </div>
                    <div class="col-sm-6 col-xs-12 no-padding push-up-20">
                        By creating an account, you confirm that you agree with our 
                        <a class="blue-text push-up-15" href="{{action('StaticPageController@page', 'terms-of-service')}}" >Terms of Service</a>
                    </div>
                    
                    <div class="col-sm-6 col-xs-12 no-padding text-right push-up-20">
                        <button type="submit" class="btn btn-lg gray-text gray-border white-bg login-button signup-button">SIGN UP</button>
                        <p class="push-up-5">
                            Have an account? <a href="{{route('login')}}" class="blue-text">Log in here</a>
                        </p>
                    </div>
                    
                    {!! Form::close() !!}
                </section>
                
            </article>
            
        </div>
    </div>
</div>
