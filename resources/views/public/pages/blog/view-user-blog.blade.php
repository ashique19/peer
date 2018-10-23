@extends('public.layouts.layout')

@section('main')

<section class="row heading-cover height-100"></section>

<section class="row blog-list">
    
    <div class="search-panel col-xs-12">
        <div class="col-sm-5 col-sm-offset-1 col-xs-12">
            <div class="profile-image pull-left">
                <img src="{{url($user->profile_image)}}" height="100">
            </div>
            <h4>{{$user->alias}}</h4>
            <p>{{$user->designation}}</p>
            <p>Love to share about: {{$user->share_about}}</p>
        </div>
        <div class="col-sm-4 col-sm-offset-2 col-xs-12">
            {!!Form::open(['url'=>'search-public-blog'])!!}
                <ul class="list-inline input-append date">
                      <li>
                        <input type="text" name="search_item" id="datepicker"  class="form-control search red-border" />
                        <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                      </li>
                      <li>
                        <span class="add-on" id="load_datepicker" >
                          <i data-time-icon="icon-time" data-date-icon="icon-calendar"> 
                          <img data-time-icon="icon-time" data-date-icon="icon-calendar" class="input-append date datepicker" style="background-image: url('/public/img/settings/calender.png'); background-color: transparent;background-repeat: no-repeat;  background-position: 0px 0px; border: none;cursor: pointer;height: 28px;vertical-align: middle; width: 25px;margin: 0px;">
                          </i>
                        </span>
                      </li>
                </ul>
                <script type="text/javascript">
                  $('#load_datepicker').click(function(){ 
                    $(function() {
                     $('#datepicker').datepicker().focus();
                   });
                  })
                   
                </script>
                  
                {!!Form::close()!!}
        </div>
    </div>
    
    <div class="col-sm-10 col-sm-offset-1">
        @if(count($blogs) > 0)
            @foreach($blogs as $blog)
            <div class="items row">
                <a href="{{action('BlogPublic@singleBlog', $blog->link)}}">
                    <div class="col-sm-6">
                        <img src="{{$blog->banner_photo}}" alt="" width="100" class="img-responsive pull-left" />
                        <h4 class="red-text">{{$blog->name}}</h4>
                        <p>{{$blog->created_at->format('d')}} {{$blog->created_at->format('M')}} {{$blog->created_at->format('Y')}} @if($blog->createdBy)by {{$blog->createdBy->name}} @endif</p>
                        <ul class="list-inline" style="display: inline-flex;">
                            <li><a>Share: </a></li>
                            <li>
                                <i class="fb-share-button" data-href="{{url('blog',$blog->link)}}" data-layout="button"></i>
                            </li>
                            <li>
                                <a class="twitter-share-button" data-count="none" href="{{url('blog',$blog->link)}}" data-counturl="test">Tweet</a>
                            </li>
                            <li>                           
                                <i> 
                                    <script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US
                                    </script>
                            <script type="IN/Share"data-url="{{url('blog',$blog->link)}}">
                                
                            </script>
                            </i>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <p class="text-justify">
                        {{$blog->short_description}}
                        </p>
                    </div>
                </a>
            </div> 
            @endforeach
            <div class="items row">
                {!! $blogs->render() !!}
            </div>
        @else
            <div class="items row">
                <h2 class="red-text text-center">This author has not written any blog yet. Please Come again soon to see new blog.</h2>
            </div>
            
        @endif
        
    </div>
</section>

@stop
@section('footer_script')
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>
    !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
</script>

@stop