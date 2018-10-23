<section class="floating-contact">
    
    <h4 class="btn btn-block btn-lg square-border blue-bg white-text">Contact us</h4>
    
    @if($errors->any())
    <ul class="auto-dismissable">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    
    {!! Form::open(['url'=> action('StaticPageController@postContact'), 'class'=> 'push-up-20' ]) !!}
    <div class="col-xs-6 form-group">
        <input name="name" type="text" class="form-control white-bg blue-text square-border" placeholder="Name" required="required" >
    </div>
    <div class="col-xs-6 form-group">
        <input name="email" type="text" class="form-control white-bg blue-text square-border" placeholder="Email" required="required" >
    </div>
    <div class="col-xs-12 form-group">
        <input name="subject" type="text" class="form-control white-bg blue-text square-border" placeholder="Subject" required="required" >
    </div>
    <div class="col-xs-12 form-group">
        <textarea name="detail" row="10" type="text" class="form-control white-bg blue-text square-border" placeholder="Message" required="required" ></textarea>
    </div>
    <div class="col-xs-12 form-group">
        <button type="submit" class="btn green-bg white-text white-text square-border pull-right">Send</button>
    </div>
    {!! Form::close() !!}
    
</section>