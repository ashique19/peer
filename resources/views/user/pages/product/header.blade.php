<nav class="top-navbar">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{url('/')}}">
				<img class="logo" src="{{asset('public/img/peerposted/images/logo.png')}}" alt="logo">
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="{{route('user-dashboard')}}" class="{{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
				<li><a href="{{route('product-lists')}}" class="{{ Request::is('user/products') ? 'active' : '' }}" >For Buyer</a></li>
				<li><a href="{{route('travel-add')}}" class="{{ Request::is('user/travel/add') ? 'active' : '' }}">For Traveler</a></li>
				<li><a href="{{route('buyer-search')}}" class="{{ Request::is('user/buyer/search/new') ? 'active' : '' }}">Request</a></li>
{{--				<li><a href="{{route('amazon')}}" class="{{ Request::is('amazon') ? 'active' : '' }}">Iphone Accessories</a></li>--}}
{{--				<li><a href="{{route('amazon1')}}" class="{{ Request::is('electronics') ? 'active' : '' }}">Electronics Accessories</a></li>--}}
				<li><a href="{{route('payment-new')}}" class="{{ Request::is('user/payment/new') ? 'active' : '' }}">Payment</a></li>
				{{--<li><a href="#">Setting</a></li>--}}

				@if( Auth::check() )
					<li><a href="{{route('logout')}}">Logout</a></li>
				@else
					<li><a href="#" id="login-btn" data-toggle="modal" data-target="#loginModal">Log In</a></li>
				@endif
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{route('traveller-checkout')}}"><span class="small">Traveler Bag</span> <img src="{{asset('public/img/peerposted/images/Traveller_Bag_icon.svg')}}" /><span id="traveller-cart-quantity" class="label label-default">@if(Session('travellerCartCount') > 0){{ Session('travellerCartCount') }}@endif</span></a></li>
				<li><a href="{{route('checkout')}}"><span class="small">Buyer Cart</span><img src="{{asset('public/img/peerposted/images/cart.svg')}}" /><span id="cart-quantity" class="label label-default">@if(Auth::check() && (Session('cartCount') > 0)){{ Session('cartCount') }}@endif</span></a></li>
				@if( Auth::check() )
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" role="button" ><img src="{{asset('public/img/settings/no-image-available-3.png')}}"> </a>
						<ul class="dropdown-menu">
							<li><a href="{{route('home')}}">Dashboard</a></li>
							<li><a href="{{route('my-travels')}}">My Travels</a></li>
							<li><a href="{{route('user-settings')}}">My Profile</a></li>
							<li><a href="{{route('inbox')}}">My Inbox</a></li>
							<li><a href="{{route('withdraw-payment')}}">Withdraw money</a></li>
							<li><a href="{{route('payout')}}">Payout money</a></li>
							<li><a href="{{route('logout')}}">Logout</a></li>
						</ul>
				</li>
				@endif
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
	</nav>

@if( Auth::check() )
@else
	<!-- Login Modal -->
	<!-- Login Modal -->
<div class="modal fade bs-example-modal-lg" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
      	<div class="row">
      		<div class="col-md-6 padding-0" style="background-image: url('{{asset('public/img/peerposted/images/login.jpg')}}');padding-bottom:20% ">
				<div class="login-wrap">
					<img class="logo-login" src="{{asset('public/img/peerposted/images/logo.png')}}" alt="logo">
					<h1>Start Sharing!</h1>
					<h1><b>Smart Shipping...</b></h1>
				</div>
      		</div>
      		<div class="col-md-6">
      			<div class="right-half">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <br><br>
		      		<h4 class="login-title">Someone is waiting ...<br> Start helping him by Log in</h4>
					<form class="form-horizontal" id="Login">
						{{ csrf_field() }} 
					  <div class="form-group">
					    <div class="col-sm-12">
					      <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="email/username">
					      <span class="text-danger" id="login-email-error"></span>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-12">
					      <input type="password" class="form-control" name="password" id="login-password" placeholder="Password">
					      <span class="text-danger" id="login-password-error"></span>
					    </div>
					  </div>
                      <div class="row">
      	                  <span class="text-danger" id="login_error_message"></span>
                      </div>
					  <button type="button" class="btn btn-lg btn-common" id="loginSubmit">Login</button>
					</form>
					<div class="social-icon-modal">
						<p>Social Login: </p>
						{{--<img src="{{asset('public/img/peerposted/images/social/twitter.svg')}}">--}}
						{{--<img src="{{asset('public/img/peerposted/images/social/instagram.svg')}}">--}}
						<a href="{{route('social-login', ['social' => 'facebook'])}}"><img src="{{asset('public/img/peerposted/images/social/facebook.svg')}}"></a>
					</div>
					<p class="modal-bottom"><a href="#">Forget Password </a> | <a href="#" id="sign-up">Sign Up</a></p>
      			</div>
      		</div>
      	</div>
      </div>
    </div>
  </div>
</div>
<!-- !END Login Modal  -->
<div class="modal fade bs-example-modal-lg" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 padding-0" style="background-image: url('{{asset('public/img/peerposted/images/login.jpg')}}');padding-bottom:20% ">
							<div class="login-wrap">
								<img class="logo-login" src="{{asset('public/img/peerposted/images/logo.png')}}" alt="logo">
								<h1>Start Sharing!</h1>
								<h1><b>Be a Part...</b></h1>
							</div>
						</div>
						<div class="col-md-6">
							<div class="right-half">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <br><br>
								<h4 class="login-title">Awesome!!!<br> Let's get started</h4>
								<form class="form-horizontal" id="signup">
									{{ csrf_field() }}
									<div class="form-group ">
										<div class="col-sm-12">
											<label for="name">I am</label>
											<input type="text" class="form-control" name="name" id="inputName" placeholder="your name">
											<span class="text-danger" id="login-name-error"></span>
										</div>
									</div>
									<div class="form-group hide" id="email-div">
										<div class="col-sm-12">
											<label for="email">Email</label>
											<input type="email" class="form-control" name="email" id="inputEmail" placeholder="email">
											<span class="text-danger" id="login-email-error"></span>
										</div>
									</div>
									<div class="form-group hide" id="password-div">
										<label for="password"></label>
										<div class="col-sm-12">
											<input type="password" id="s_password" class="form-control" name="password" placeholder="Password">
											<span class="text-danger" id="login-password-error"></span>
										</div>
										<div class="col-sm-12">
											<input type="password" id="sc_password" class="form-control" name="cpassword" placeholder="Confirm Password">
											<span class="text-danger" id="login-password-error"></span>
										</div>
										<div class="form-group">
											<button type="button" class="btn btn-lg btn-common" id="signupSubmit">Signup</button>
										</div>
									</div>

									<div class="row">
										<span class="text-danger" id="signup_error_message"></span>
									</div>
								</form>
								<div class="social-icon-modal">
									<p class="text-info">Please ENTER to continue</p><br>
									<p>Social Login: </p>
									{{--<img src="{{asset('public/img/peerposted/images/social/twitter.svg')}}">--}}
									{{--<img src="{{asset('public/img/peerposted/images/social/instagram.svg')}}">--}}
									<a href="{{route('social-login', ['social' => 'facebook'])}}"><img src="{{asset('public/img/peerposted/images/social/facebook.svg')}}"></a>
								</div>
								<p class="modal-bottom">Have an account? | <a href="#" id="sign-in">Login</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	$('body').on('click', '#loginSubmit', function(e) {
		e.preventDefault();
		var formData = $("#Login").serialize();
		$('#login-email-error').html("");
		$('#login-password-error').html("");

		$.ajax({
        url: ROOT_URL + 'login/new',
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log(response);
//            var response = JSON.parse(response);
            if (response.errors) {

                $('#login_error_message').text('Please check your email and password.');
                if (response.errors.email) {
                    $('#login-email-error').html(response.errors.email[0]);
                }
                if (response.errors.password) {
                    $('#login-password-error').html(response.errors.password[0]);
                }
            }

            if (response.status == 200) {
                if(response.data.id === 2) { //ADMIN ID IS 2
                    window.location.href = ROOT_URL + 'admin/dashboard';
				}
                else if( typeof detailsRoute !== 'undefined') {
                    window.location.href = ROOT_URL + 'dashboard';
                } else {
                    location.reload();
                }
            }

        },
        error: function(response) {
            console.log(response);
        }
    });
	});
	$("#sign-up").on('click', function () {
	    $("#loginModal").modal('hide');
        $("#signupModal").modal('show');
	});
    $("#sign-in").on('click', function () {
        $("#signupModal").modal('hide');
        $("#loginModal").modal('show');
    });

    $('body').on('click', '#signupSubmit', function(e) {
        e.preventDefault();
        var formData = $("#signup").serialize();
        $('#signup_error_message').html('');
        $.ajax({
            url: ROOT_URL + 'api/v1/signup',
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
//            var response = JSON.parse(response);
                if (response.status == 'failed') {
					$('#signup_error_message').html(response.message[0]);
                } else if (response.status == 'success') {
                    if( typeof detailsRoute !== 'undefined') {
                        window.location.href = ROOT_URL + 'dashboard';
                    } else {
                        location.reload();
                    }
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    });


    // Enter key press
    $('#loginModal').on('shown.bs.modal', function (e) {
        $("#login-password").keyup(function(e) {
            if (e.which == 13) {
				$("#loginSubmit").trigger('click');
            }
        });

    });

    $('#signupModal').on('shown.bs.modal', function (e) {
        enterKeyPressCount = 0;
        $(document).keyup(function(e) {
            var value = $(e.target).val();
            if(value == '' && (enterKeyPressCount == 0 || (enterKeyPressCount !== 3))) {
                $("#signup_error_message").html('This field is required');
                return;
			}

            if (e.which == 13) {
                if(enterKeyPressCount == 1) {
                    if(/^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/.test(value)) {
                        console.log('passed');
                        emailDuplicateCheck(value);
                        return;
                    } else {
                        $("#signup_error_message").html('Please enter valid Email');
                        return;
                    }
                }
                if(enterKeyPressCount == 2) {
					var password = $("#s_password").val();
                    if(/^[a-zA-Z].*[0-9]|[0-9].*[a-zA-Z]+$/.test(password) === false) {
                        $("#signup_error_message").html('Password must be Alphanumeric.');
                        return;
                    }
                    if(password.length < 8) {
                        $("#signup_error_message").html('Password must be at least 8 character length.');
                        return;
                    }
                    if(password !== $("#sc_password").val() ) {
                        $("#signup_error_message").html('Password and confirm password must be same');
                        return;
                    }
					$("#signupSubmit").trigger('click');
                }

                if(enterKeyPressCount > 2) {
                    $("#signupSubmit").trigger('click');
                    return;
                }
                enterKeyPressCount++;
                $("#signup_error_message").html('');
                var p = $(e.target).closest('.form-group');
				p.next().removeClass('hide');
				p.hide();
            }
        });
    });
    function emailDuplicateCheck(emailID) {

        $.ajax({
            url: ROOT_URL + 'email-check',
            type: 'POST',
            data: {email:emailID},
            success: function(response) {
                console.log(response);
//            var response = JSON.parse(response);
				if( response.status === 204) {
                    enterKeyPressCount++;
                    $("#email-div").addClass('hide');
				    $("#password-div").removeClass('hide');
				    $("#signup_error_message").html('');
				} else {
                    $("#signup_error_message")
						.html('Email is already exist. Please try another...');
				}

            },
            error: function(response) {
                console.log(response);
            }
        });
	}

</script>
@endif
<style>
	.hide {
		display: none;
	}
	#signup_error_message {
		margin-left: 5px;
	}
</style>
