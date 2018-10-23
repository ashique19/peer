@extends('public.layouts.layout')
@section('title')
@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif-@if($singleBlog){{$singleBlog->name}} @endif 
@stop

@section('main')

<section class="row fixed-banner category-banner">
    <div class="owl-carousel enable-owl-carousel " data-wow-delay="0.7s" data-navigation="false" 
    data-pagination="false" data-single-item="true" data-auto-play="false" data-transition-style="false" 
    data-main-text-animation="false" data-min600="1" data-min800="1" data-min1200="1">
        
                
        <div class="slide">
    	    <a>
    	        <img src="{{$singleBlog->banner_photo}}" alt="{{$singleBlog->name}}" class="img-responsive">
    	    </a>
    	</div>
        
    	
    </div>
</section>

<section class="row blog blog-right single-blog">
    <div class="col-md-10 col-md-offset-1 col-xs-12">
        
        <div class="col-md-9">
            
            @if($errors->has('vote_success'))
        	<div class="alert alert-success">
        		Thank you for your vote.
        	</div>
        	@endif
        	
        	<div class="col-md-12">
				<div class="single-blog-item">
					<div class="down-content">
						<ul>
						    @if($singleBlog->categories()->count() > 0)
						    @foreach($singleBlog->categories as $category)
						    <li><i class="fa fa-circle-o"></i><a href="{{route('blogCategory', $category->link)}}">{{$category->name}}</a></li>
						    @endforeach
						    @endif
							<li><i class="fa fa-clock-o"></i>{{$singleBlog->created_at->format('M d, Y')}}</li>
						</ul>
						<a href="single-blog.html"><h4>Pour-over hoodie swag Wes Anderson</h4></a>
						<p>Roof party wayfarers 8-bit occupy Etsy. Cliche tofu fixie ethical PBRB, gastropub farm-to-table fap asymmetrical meggings sustainable. Godard beard artisan chambray, biodiesel Bushwick Austin lumbersexual fanny pack 3 wolf moon scenester tote bag. Actually 90's lomo, DIY hella swag tote bag distillery flexitarian photo booth Intelligentsia. Pickled semiotics tote bag Neutra keytar shabby chic. Etsy lomo +1, Thundercats vegan tote bag artisan gentrify polaroidade Actually viral Williamsburg<br><br>Whatever deep v pour-over, Echo Park fingerstache Marfa viral squid 8-bit disrupt roof party. Bicycle rights Neutra salvia hella, cray beard fingerstache. Seitan cronutcliche actually. Meh selfies kogi drinking vinegar. Lo-fi mumblecore ennui, pug aesthetic tattooed meggings Pinterest. 3 wolf moon hoodie normcore, Wes Anderso tousled quinoa Blue Bottle flexitarian</p>
						<blockquote>Salvia plaid flexitarian hoodie cold-pressed, meh selfies keffiyeh cray leggings normcore tousled cardigan cliche authentic fingers roof party farm-to-table chambray, Schlitz chia mustache selfies mixtape Tumblr YOLO +1 cronut. Echo Park cornholemus tache, crucifix Tumblr Williamsburg actually chillwave freegan.</blockquote><p>Roof party wayfarers 8-bit occupy Etsy. Cliche tofu fixie ethical PBRB, gastropub farm-to-table fap asymmetrical meggings sustainable. Godard beard artisan chambray, biodiesel Bushwick Austin lumbersexual fanny pack 3 wolf moon scenester tote bag. Actually 90's lomo, DIY hella swag tote bag distillery flexitarian photo booth Intelligentsia. Pickled semiotics tote bag Neutra keytar shabby chic. Etsy lomo +1, Thundercats vegan tote bag artisan gentrify polaroidade Actually viral Williamsburg<br><br>Whatever deep v pour-over, Echo Park fingerstache Marfa viral squid 8-bit disrupt roof party. Bicycle rights Neutra salvia hella, cray beard fingerstache. Seitan cronutcliche actually. Meh selfies kogi drinking vinegar. Lo-fi mumblecore ennui, pug aesthetic tattooed meggings Pinterest</p>
					</div>
					<div class="tags">
						<h4>Tags:</h4><span><a href="#">Shopping </a>/<a href="#"> Clean </a>/<a href="#"> Design</a></span>
					</div>
				</div>
				<div class="comments-section">
					<h2>2 comments</h2>
					<div class="line-dec"></div>
					<div class="comment-item">
						<img src="assets/images/comment-author-01.jpg" alt="">
						<span>December 12, 2015 at 4:20 pm</span>
						<h4>Alonzo Aucock</h4>
						<p>Bicycle rights meh health goth sartorial Portland ethical. Marfa quinoa Austin pop-up gentrify Echo Park selfies, DIY +1 90's flexitarian heirloom hashtag. Schlitz tofu mixtape art party.</p>
						<a href="#">Reply</a>
					</div>
					<div class="comment-item replied-comment">
						<img src="assets/images/comment-author-02.jpg" alt="">
						<span>December 12, 2015 at 5:34 pm</span>
						<h4>Jerry Arnold</h4>
						<p>Bicycle rights meh health goth sartorial Portland ethical. Marfa quinoa Austin pop-up gentrify Echo Park selfies, DIY +1 90's flexitarian heirloom hashtag.</p>
						<a href="#">Reply</a>
					</div>
				</div>
				<div class="leave-comment">
					<h2>Leave a comment</h2>
					<div class="line-dec"></div>
					<div class="leave-comment-form">
						<div class="row">
							<div class="col-md-6">
								<input type="text" class="blog-search-field" name="s" placeholder="NAME" value="">
							</div>
							<div class="col-md-6">
								<input type="text" class="blog-search-field" name="s" placeholder="EMAIL ADDRESS" value="">
							</div>
							<div class="col-md-12">
								<textarea id="message" class="message" name="message" placeholder="YOUR COMMENT"></textarea>
							</div>
							<div class="col-md-12">
								<button class="button button--nina button--text-thick button--text-upper button--size-s" data-text="SUBMIT NOW">
									<span>S</span><span>U</span><span>B</span><span>M</span><span>I</span><span>T</span> <span>N</span><span>O</span><span>W</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
                        
        </div>
        @include('public.pages.blog.partials.right-nav')
        
    </div>
</section>


<section class="col-xs-12 main-body">
    
    <div class="panel panel-default"></div>
    
    @if($singleBlog)
    
    <div class="panel panel-default">
        
        <h2 class="page-title"><center>{{$singleBlog->name}}</center></h2>
        
        <div class="panel-body">
            <img src="{{$singleBlog->banner_photo}}" alt="" class="img-responsive">
        </div>
        <div class="panel-body posts">
            {!! $singleBlog->details !!}
        </div>
        
        <div class="panel-body posts">
            <h3 class="page-title">Comments</h3>
            <ul class="media-list">
                @if($comments)
                    @foreach($comments as $comment)
                    <li class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object img-text" src="@if($comment->user) {{$comment->user->user_photo}} @endif" alt="@if($comment->user) {{$comment->user->name}} @endif" width="64" >
                        </a>
                        <a data-toggle="collapse" href="#reply{{$comment->id}}" aria-expanded="false" aria-controls="reply{{$comment->id}}" role="button" class="btn btn-primary btn-rounded pull-right"><i class="fa fa-mail-reply"></i> Reply</a>
                        <div class="media-body">
                            <h4 class="media-heading">@if($comment->user) {{$comment->user->name}} @endif</h4>
                            <p>{{$comment->name}}</p>
                            <p class="text-muted">{{$comment->created_at}}</p>
                            <div class="panel-body collapse" id="reply{{$comment->id}}">
                                
                                {!! Form::open(['url'=> action('Blogs@commentReplyStore', ['id'=>$singleBlog->id, 'comment'=>$comment->id]) ]) !!}
                                <div class="col-xs-12">
                                    {!! Form::textarea('name', old('name'), ['class'=>'form-control']) !!}
                                </div>
                                <div class="col-xs-12">
                                    {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-rounded btn-xs push-up-10']) !!}
                                </div>
                                {!! Form::close() !!}
                                
                            </div>
                            @if($comment->reply($comment->id)->published()->count() > 0)
                                @foreach($comment->reply($comment->id)->published()->get() as $reply)
                                    <div class="media">
                                        <a class="pull-left" href="#">
                                            <img class="media-object img-text" src="@if($reply->user) {{$reply->user->user_photo}} @endif" alt="@if($reply->user) {{$reply->user->name}} @endif" width="32">
                                        </a>
                                        <div class="media-body">
                                          <h4 class="media-heading">@if($reply->user) {{$reply->user->name}} @endif</h4>
                                          <p>{{$reply->name}}</p>
                                          <p class="text-muted">{{$reply->created_at}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>                                            
                    </li>
                    @endforeach
                @endif
            </ul>
            <br>
            <h3 class="page-title">Make a Comment</h3>
            @if(!auth()->user())
            <div class="col-xs-12 push-down-20">
            <a href="{{route('login')}}" class="badge badge-danger">Please login to comment</a>
            </div>
            @endif
            {!! Form::open(['url'=>action('Blogs@commentStore', $singleBlog->id)]) !!}
            
            <div class="col-xs-12 push-down-20">
            {!! Form::textarea('name', old('name'), ['class'=>'form-control']) !!}
            </div>
            
            <div class="col-xs-12">
            {!! Form::submit('Submit', ['class'=> 'btn btn-info pull-right']) !!}
            </div>
            
            {!! Form::close() !!}
        </div>
        
    </div>
    
    
        
    @else
    
    If the Page does not exist, we say sorry! 
    
    <div class="panel panel-default">
        <h2 class="page-title"><center>Sorry! The page you are looking for, does not exist..</center></h2>
        <strong><center>Come again later to see if it exists or <a href="{{route('home')}}">checkout our collection</a>.</center></strong>
    </div>
    
    @endif
        
</section>

@stop
        