@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Amazon Products @stop
@section('main')
    <div class="wrapper">
		@include('user.pages.product.sidebar')

        <!-- Page Content Holder -->
        <div id="content">
        	@include('user.pages.product.header')
			<div class="container">
				<div class="messaging">
					<div class="inbox_msg">
						<div class="inbox_people">
							<div class="headind_srch">
								<div class="recent_heading">
									<h4>Recent Messages</h4>
								</div>
								
							</div>
							<div class="inbox_chat">
								<div class="chat_list active_chat">
									<div class="chat_people">
										<div class="chat_img"> <img src="{{asset('public/product/user-profile.png')}}" alt="sunil"> </div>
										<div class="chat_ib">
											<h5>Admin User <span class="chat_date">{{(count($messages) > 0) ? $messages[0]->created_at->format('j M') : '' }}</span></h5>
											<p>{{(count($messages) > 0) ? $messages[0]->name : 'Write to Admin' }}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="mesgs">
							<div class="msg_history" id="msg-container">
								@if(count($messages) > 0)
									@foreach($messages as $key => $message)
										@if($message->message_from !== $loggedInUserId)
											<div class="incoming_msg">
												<div class="incoming_msg_img"> <img src="{{asset('public/product/user-profile.png')}}" alt="sunil"> </div>
												<div class="received_msg">
													<div class="received_withd_msg">
														<p>{{$message->name}}</p>
														<p>{{$message->details}}</p>
														<span class="time_date"> {{$message->created_at->format('g:i a | M j')}}</span></div>
												</div>
											</div>
										@else
											<div class="outgoing_msg">
												<div class="sent_msg">
													<p>{{$message->name}}</p>
													@if($message->details)
														<p>{{$message->details}}</p>
													@endif
													<span class="time_date"> {{$message->created_at->format('g:i a | M j')}}</span> </div>
											</div>
										@endif
									@endforeach
								@else
									<div class="alert alert-info"> Send Message to Support or Admin</div>
								@endif

							</div>
							<div class="type_msg">
								<div class="input_msg_write">
									<input type="text" class="write_msg" name="message" id="msg-input" placeholder="Type a message" />
									<button class="msg_send_btn" type="button" id="message-send"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			</div>
        </div>
    </div>
@stop

@section('footer-js')
<script type="text/javascript" src="{{ asset('public/preview/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script>
<script type="text/javascript">
	var lastMessageId = '{{isset($key) ? $key : 0}}';
	console.log(lastMessageId);
    $("#msg-input").on("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            $("#message-send").trigger('click');
        }
    });
	$("#message-send").on('click', function(e){
	   e.preventDefault();
	   var message = $('#msg-input').val();
	   if(message == '') {
	       return false;
	   }
        var date = new Date(Date.now()).toLocaleString(),
            msg = '<div class="outgoing_msg"><div class="sent_msg"><p>' + message + '</p><span class="time_date"> ' + date + '</span> </div></div>';
        $("#msg-container").append(msg);

        $.ajax({
            method: 'post',
            url: ROOT_URL + "user/messages",
            data:{name: message, message_from: '{{$loggedInUserId}}', message_to: 1,},
        }).done(function( response ) {
            if(response.status === 200) {
                $('#msg-input').val('');
			} else {
                $("#msg-container").append('<div class="alert alert-danger"> Failed to send the message, Try again later.</div>');
			}
        }).error(function(e){
            console.log(e);
        });

	});

</script>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
<style>
	.container{max-width:1170px; margin:auto;}
	img{ max-width:100%;}
	.inbox_people {
		background: #f8f8f8 none repeat scroll 0 0;
		float: left;
		overflow: hidden;
		width: 35%; border-right:1px solid #c4c4c4;
	}
	.inbox_msg {
		border: 1px solid #c4c4c4;
		clear: both;
		overflow: hidden;
	}
	.top_spac{ margin: 20px 0 0;}


	.recent_heading {float: left; width:40%;}
	.srch_bar {
		display: inline-block;
		text-align: right;
		width: 60%; padding:
	}
	.headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

	.recent_heading h4 {
		color: #05728f;
		font-size: 21px;
		margin: auto;
	}
	.srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
	.srch_bar .input-group-addon button {
		background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
		border: medium none;
		padding: 0;
		color: #707070;
		font-size: 18px;
	}
	.srch_bar .input-group-addon { margin: 0 0 0 -27px;}

	.chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
	.chat_ib h5 span{ font-size:13px; float:right;}
	.chat_ib p{ font-size:14px; color:#989898; margin:auto}
	.chat_img {
		float: left;
		width: 11%;
	}
	.chat_ib {
		float: left;
		padding: 0 0 0 15px;
		width: 88%;
	}

	.chat_people{ overflow:hidden; clear:both;}
	.chat_list {
		border-bottom: 1px solid #c4c4c4;
		margin: 0;
		padding: 18px 16px 10px;
	}
	.inbox_chat { height: 550px; overflow-y: scroll;}

	.active_chat{ background:#ebebeb;}

	.incoming_msg_img {
		display: inline-block;
		width: 6%;
	}
	.received_msg {
		display: inline-block;
		padding: 0 0 0 10px;
		vertical-align: top;
		width: 92%;
	}
	.received_withd_msg p {
		background: #ebebeb none repeat scroll 0 0;
		border-radius: 3px;
		color: #646464;
		font-size: 14px;
		margin: 0;
		padding: 5px 10px 5px 12px;
		width: 100%;
	}
	.time_date {
		color: #747474;
		display: block;
		font-size: 12px;
		margin: 8px 0 0;
	}
	.received_withd_msg { width: 57%;}
	.mesgs {
		float: left;
		padding: 30px 15px 0 25px;
		width: 60%;
	}

	.sent_msg p {
		background: #F27F2C none repeat scroll 0 0;
		border-radius: 3px;
		font-size: 14px;
		margin: 0; color:#fff;
		padding: 5px 10px 5px 12px;
		width:100%;
	}
	.outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
	.sent_msg {
		float: right;
		width: 46%;
	}
	.input_msg_write input {
		background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
		border: medium none;
		color: #4c4c4c;
		font-size: 15px;
		min-height: 48px;
		width: 100%;
	}

	.type_msg {border-top: 1px solid #c4c4c4;position: relative;}
	.msg_send_btn {
		background: #05728f none repeat scroll 0 0;
		border: medium none;
		border-radius: 50%;
		color: #fff;
		cursor: pointer;
		font-size: 17px;
		height: 33px;
		position: absolute;
		right: 0;
		top: 11px;
		width: 33px;
	}
	.messaging { padding: 0 0 50px 0;}
	.msg_history {
		height: 516px;
		overflow-y: auto;
	}
</style>
@endsection