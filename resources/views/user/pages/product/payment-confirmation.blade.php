@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Payment @stop
@section('main')

    <div class="wrapper payment-confirmation">
		@include('user.pages.product.sidebar')

      <div id="content">
      	@include('user.pages.product.header')
			<div class="container-fluid">

				<div class="col-md-12">
					<h4>Payment Confirmation</h4>
					<div class="alert">
						<h2>Payment Successful!</h2>
						<div class="row layout">
							<div class="col-md-3 left-bar lay-l">
								<h4>Transaction ID</h4>
								<h1><b>B5879</b></h1>
							</div>

							<div class="col-md-6 col-sm-offset-3 lay-r">
								<h4>Bought Products</h4>
								<a href="{{route('product-lists')}}" class="btn btn-common">Check Products </a>
								{{--<a href="#" class="btn btn-common">Download Invoice</a>--}}
							</div>
						</div>
					</div>
					<div>
						<p>General information of delivery and Shipping term & condition will described here.</p>
						<br>
						<p> If you have any query please contact to our support (Contact details are on footer)</p>
						<p>Thanks. <br>PeerPosted Team</p><br>
					</div>
					<p class="color-light">Contact</p>
					<div class="row bottom">
						<div class="col-md-4">
							<img class="img-responsive" src="{{asset('public/img/peerposted/images/demo.jpg')}}">
							<div class="col-md-8">
								<p><b>Booth</b><br><span class="color-light">Dreseden Airport, Germany <br>DRS<br>+567838877<br>pp-drs@peerposted.com</span></p>
							</div>
						</div>
						<div class="col-md-4">
							<img class="img-responsive" src="{{asset('public/img/peerposted/images/demo.jpg')}}">
							<div class="col-md-8">
								<p><b>Support</b> <br><span class="color-light">678B/2, Dhaka, Bangladesh<br>+880154879663<br>support@peerposted.com</span></p>
							</div>
						</div>
						<div class="col-md-4">
							<img class="img-responsive" src="{{asset('public/img/peerposted/images/demo.jpg')}}">
							<div class="col-md-8">
								<p><b>Germany Office</b><br><span class="color-light">Wilane Street, Berlin,AA32, Germany<br>+52489766545-7<br>germany@peerposted.com</span></p>
							</div>
						</div>

					</div>

				</div>
                
			</div>
        </div>
        
    </div>
    
@endsection
@section('js')
<script >
   $(document).ready(function(){
       
    }) 
</script>
    <script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script> 
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
@endsection
