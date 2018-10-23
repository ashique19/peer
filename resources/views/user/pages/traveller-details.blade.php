@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        {!! errors($errors) !!}
        
        <div class="col-xs-12 no-padding">
            
            <div class="col-sm-3 no-padding">
                <ul class="user-action-ul profile-nav">
                    <li class="user-actions">
                        <img src="{{$traveller->user_photo}}" alt="Profile Photo" class="img-responsive profile-img">
                    </li>
                    <li class="user-actions">
                        <a>{{$traveller->city}}, {{$traveller->state}} @if($traveller->country){{$traveller->country->name}} @endif</a>
                    </li>
                    <li class="user-actions">
                        <a href="#" class="btn btn-lg btn-block blue-bg white-text"  data-toggle="modal" data-target="#message{{$traveller->id}}" >Message <img src="/public/img/settings/chat-icon.png" alt=" - " width="30" /> </a>
                        
                        @section('bodyScope')
                        
                        <div class="modal fade modal-theme-1" id="message{{$traveller->id}}" tabindex="-1" role="dialog" aria-labelledby="message">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    
                                    <aside class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </aside>
                                    
                                    <article class="modal-body no-padding">
                                        
                                        {!! Form::open([ 'url'=> action('UserChats@store', $traveller->id), 'class'=> 'send-message', 'enctype'=> "multipart/form-data" ]) !!}
                                        <section class="row send-message-heading">
                                            <h2>Messenger</h2>
                                            <h5>To [{{$traveller->name}}]</h5>
                                        </section>
                                        
                                        <section class="login-area row send-message-details">
                                            
                                            <div class="col-xs-12 no-padding">
                                                {!! Form::textarea('name', null, ['class'=> 'form-control', 'placeholder'=> 'Message', 'required'=> 'required']) !!}
                                                
                                                <p class="small message"></p>
                                                
                                            </div>
                                            <div class="col-xs-12 col-sm-6 no-padding push-up-20">
                                                <a class="push-up-20 darkGray-text" href="{{action('UserChats@indexAndOffers')}}" >View my Inbox</a>
                                            </div>
                                            
                                            <div class="col-xs-12 col-sm-6 no-padding text-right push-up-20">
                                                <button type="submit" class="btn btn-sm white-text blue-bg">Send</button>
                                            </div>
                                            
                                        </section>
                                        
                                        <section class="row message-success hidden">
                                            <figure class="text-right">
                                                <img src="/public/img/settings/message-success.png" alt="Hurrahhh!">
                                            </figure>
                                            <figcaption>Message Sent!</figcaption>
                                            <figdetails>Head to your inbox to see all your messages.</figdetails>
                                            <p class="text-center"><a href="{{action('UserChats@indexAndOffers')}}">View my inbox</a></p>
                                        </section>
                                        
                                        {!! Form::close() !!}
                                        
                                    </article>
                                    
                                </div>
                            </div>
                        </div>
                        
                        @stop
                        
                    </li>
                </ul>
            </div>
            
            <div class="col-sm-9 push-up-80 form-theme-1">
                <section class="row white-bg">
            
                    <h1>Hey, I'm {{$traveller->name}} !</h1>
                    <h4 class="boldest pull-5">Member since {{$traveller->created_at->format('F Y')}}</h4>
                    
                    <h2 class="boldest push-up-30">About me</h2>
                    <p>{{$traveller->note}}</p>
                    
                </section>
                
                <section class="row white-bg scrollable">
                    
                    <h2 class="boldest push-up-30">My Trips</h2>
                    
                    <table class="table table-responsive table-theme-1">
                        <thead>
                            <tr>
                                <th>Send Request</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Arrival date</th>
                                <th>Departure date</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if( count($travels) > 0 )
                            @foreach( $travels as $traveller)
                            
                            <tr>
                                <td>
                                    <a href="#" class="btn" data-toggle="modal" data-target="#traveller{{$traveller->id}}">
                                        <img src="/public/img/settings/send-icon.png" alt="Send Request" class="img-responsive">
                                    </a>
                                    
                                    @if($traveller->user_id != auth()->user()->id)
                                    
                                        @include('user.partials.buyer-offers-traveler-modal')
                                    
                                    @endif
                                    
                                </td>
                                <td>
                                    @if($traveller->airportFrom){{$traveller->airportFrom->name}}@endif
                                </td>
                                <td>
                                    @if($traveller->airportTo){{$traveller->airportTo->name}}@endif
                                </td>
                                <td>{{$traveller->arrival_date->format('Y-m-d')}}</td>
                                <td>{{$traveller->departure_date->format('Y-m-d')}}</td>
                            </tr>
                            
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                    
                </section>

                 <section class="row white-bg scrollable">
                    
                    <h2 class="boldest push-up-30">My Reviews</h2>
                    
                    <table class="table table-responsive table-theme-1">
                        <thead>
                            <tr>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Rate By</th>
                                <th>Review date</th>
                            </tr>
                        </thead>
                        <tbody id="review-data">
                            
                            @if( count($reviews) > 0 )
                            @foreach( $reviews as $review)
                            
                            <tr>
                                <td>
                                    {{$review->comment}}
                                </td>
                                <td>
                                    @for ($i=1; $i <= 5 ; $i++)
                                      <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
                                    @endfor
                                </td>
                                <td>
                                    {{$review->by->firstname}}
                                </td>

                                <td>{{$review->created_at->format('Y-m-d')}}</td>
                            </tr>
                            
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                    <div class="row">
                           <div class="text-right">
                <a href="#reviews-anchor" id="open-review-box" class="btn btn-primary btn-sm blue-bg white-text" style="display: inline-block;">Leave a Review</a>
              </div>
              
              <div class="row" id="post-review-box" style="display: none;">
                <div class="col-md-12">
                  <form method="POST" action="#" accept-charset="UTF-8">
                      <input name="_token" id="token" type="hidden" value="{{csrf_token()}}">   
                      <input id="ratings-hidden" name="rating" type="hidden">              
                      <textarea rows="5" id="new-review" class="form-control animated" placeholder="Enter your review here..." name="comment" cols="50" autocomplete="off" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 54px;"></textarea>              
                      <div class="text-right">
                    <div class="stars starrr" data-rating="0">
                    </div>
                    <a href="#" class="btn btn-default btn-sm" id="close-review-box" style="margin-right: 10px; display: none;"> <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                    <button class="btn btn-primary btn-sm blue-bg white-text" type="submit" id="review-save">Save</button>
                  </div>
                </form>                
                </div>
              </div>
                    </div>
                </section>
            </div>
            
        </div>
        
        
        
    </div>
</section>

@stop

@section('footer-js')
<script src="http://demos.maxoffsky.com/shop-reviews/js/expanding.js"></script>
  <script src="http://demos.maxoffsky.com/shop-reviews/js/starrr.js"></script>


 <script type="text/javascript">
    $(function(){

      // initialize the autosize plugin on the review text area
      $('#new-review').autosize({append: "\n"});

      var reviewBox = $('#post-review-box');
      var newReview = $('#new-review');
      var openReviewBtn = $('#open-review-box');
      var closeReviewBtn = $('#close-review-box');
      var ratingsField = $('#ratings-hidden');

      openReviewBtn.click(function(e)
      {
        reviewBox.slideDown(400, function()
          {
            $('#new-review').trigger('autosize.resize');
            newReview.focus();
          });
        openReviewBtn.fadeOut(100);
        closeReviewBtn.show();
      });

      closeReviewBtn.click(function(e)
      {
        e.preventDefault();
        reviewBox.slideUp(300, function()
          {
            newReview.focus();
            openReviewBtn.fadeIn(200);
          });
        closeReviewBtn.hide();
        
      });

      // If there were validation errors we need to open the comment form programmatically 
      
      // Bind the change event for the star rating - store the rating value in a hidden field
      $('.starrr').on('starrr:change', function(e, value){
        ratingsField.val(value);
      });
      
      $("#review-save").on('click', function(e){
          e.preventDefault();
          var rating = $("#ratings-hidden").val(), comment = $("#new-review").val();
          $.ajax({
              url: "{{route('traveller-review-add', ['id' => $traveller->id])}}",
              data: {_token: $("#token").val(), rating: rating, comment: comment },
              method: 'POST'
            }).done(function(res) {
              var data = JSON.parse(res);
              if(data.status == 201) {
                  closeReviewBtn.trigger('click');
                  var ratingIcon = '', icon, date = new Date(),
                  today = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate();

                  for ( var i=1; i <= 5 ; i++) {
                      icon = (i <= rating) ? '' : '-empty';
                      ratingIcon += '<span class="glyphicon glyphicon-star' + icon +'"></span>';
                  }
                  
                  $("#review-data").append('<tr><td>'+comment+'</td><td>'+ratingIcon+'</td><td></td><td>'+today+'</td></tr>')
              }
              
            });
      })
    });
  </script>

@endsection