@extends('public.layouts.layout')
@section('title')
@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif-@if($blogPost){{$blogPost->name}} @endif 
@stop

@section('main')


<section class="row page-banner">
    @if($blogPost)
    <img src="{{$blogPost->banner_photo}}" alt="{{$blogPost->name}} Blogs" width="100%" class="img-responsive">
    @endif
</section>




<div class="row">
    <div class="col-md-9">
        
		<div class="panel panel-default">
		    <div class="panel-body posts">
		        
		        @if($blogPost)
		        
		        <div class="post-item">
		            <div class="post-title">
		                {{$blogPost->name}}
		            </div>
		            <div class="post-date"><span class="fa fa-calendar"></span> {{$blogPost->created_at->format('m D, Y')}} </div>
		            <div class="post-text">{!! $blogPost->details !!}</div>
		            <div class="post-row">
		                <div class="post-info">
		                    <span class="fa fa-eye"></span> {{$blogPost->views}} - <span class="fa fa-star"></span> {{$blogPost->votes()->count()}}                                                
		                </div>
		            </div>
		            
		            <h3 class="push-down-20">Comments</h3>
		            
		            @if( ! auth()->user() )
                    <div class="col-xs-12 push-down-20">
                    <a href="{{route('login')}}" class="badge badge-danger">Please login to comment</a>
                    </div>
                    @endif
                    
					<div class="leave-comment-form">
					    {!! Form::open(['url'=>action('Blogs@commentStore', $blogPost->id)]) !!}
						<div class="row">
							<div class="col-md-12">

								<ul class="list-inline" title="You must be logged in to vote">
                                	<li><h4>Rate:</h4></li>
                                	<li><p class="form-group"><input type="radio" name="rate" value="1" required /> 1 </p></li>
                                	<li><p class="form-group"><input type="radio" name="rate" value="2" required /> 2 </p></li>
                                	<li><p class="form-group"><input type="radio" name="rate" value="3" required /> 3 </p></li>
                                	<li><p class="form-group"><input type="radio" name="rate" value="4" required /> 4 </p></li>
                                	<li><p class="form-group"><input type="radio" name="rate" value="5" required checked /> 5 </p></li>
                                </ul>

							</div>
							<div class="col-md-12">
								{!! Form::textarea('name', old('name'), ['class'=>'form-control', 'placeholder'=> 'YOUR COMMENT']) !!}
							</div>
							<div class="col-md-12">
								<button type="submit" class="btn blue-bg white-text square-border push-up-10 push-down-10">SUBMIT</button>
							</div>
						</div>
						{!! Form::close() !!}
					</div>
					
					<ul class="media-list">
						@if( $blogPost->comments()->published()->notReply()->count() > 0 )
						@foreach( $blogPost->comments()->published()->notReply()->get() as $comment )
						
						<li class="media">
					        <a class="pull-left" href="#">
					            <img class="media-object img-text" src="@if($comment->user->user_photo){{$comment->user->user_photo}} @else /public/img/settings/no-image-available-3.png @endif" alt="{{$comment->commenter_name}}" width="64">
					        </a>
					        <div class="media-body">
					            <h4 class="media-heading">{{$comment->commenter_name}}</h4>
					            <p>{{$comment->name}}</p>
					            <p class="text-muted">{{$comment->created_at->format('M d, Y H:i')}}</p>
					            
					            <a data-toggle="collapse" href="#reply{{$comment->id}}" aria-expanded="false" aria-controls="reply{{$comment->id}}" role="button" class="btn btn-primary btn-rounded pull-right"><i class="fa fa-mail-reply"></i> Reply</a>
    					    
	    					    <div class="panel-body collapse push-up-20" id="reply{{$comment->id}}">
	                                
	                                {!! Form::open(['url'=> action('Blogs@commentReplyStore', ['id'=>$blogPost->id, 'comment'=>$comment->id]) ]) !!}
	                                <div class="col-xs-12">
	                                    {!! Form::textarea('name', old('name'), ['class'=>'form-control']) !!}
	                                </div>
	                                <div class="col-xs-12">
	                                    {!! Form::submit('Submit', ['class'=>'btn btn-primary btn-rounded btn-xs push-up-10']) !!}
	                                </div>
	                                {!! Form::close() !!}
	                                
	                            </div>
					            
					            
					            @if( \App\Comment::replyOf( $comment->id )->published()->count() > 0 )
					            @foreach( \App\Comment::replyOf( $comment->id )->published()->get() as $reply )
					            <div class="media">
					                <a class="pull-left" href="#">
					                    <img class="media-object img-text" src="@if($reply->user->user_photo){{$reply->user->user_photo}} @else /public/img/settings/no-image-available-3.png @endif" alt="{{$reply->commenter_name}}" width="64">
					                </a>
					                <div class="media-body">
					                  <h4 class="media-heading">{{$reply->commenter_name}}</h4>
					                  <p>{{$reply->name}}</p>
					                  <p class="text-muted">{{$reply->created_at->format('M d, Y H:i')}}</p>
					                </div>
					            </div> 
					            @endforeach
					            @endif
					            
					            
					            
					        </div>                                            
					    </li>
					    
						@endforeach
						@endif
					</ul>
					
		        </div>    
		        
		        @endif
		           
		    </div>
		</div>
        
    </div>   
    @include('public.pages.blog.partials.right-nav')
</div>


@stop