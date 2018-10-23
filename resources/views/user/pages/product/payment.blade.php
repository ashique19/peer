@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Payments @stop
@section('main')

    <div class="wrapper order">
		@include('user.pages.product.sidebar')

      <div id="content">
      	@include('user.pages.product.header')
			<div class="container-fluid">
				
				<div class="col-md-12">
					<h4>Payment</h4>
                    <?php  $amount = 0; ?>

					@if(count($data['items']) > 0)
						@foreach($data['items'] as $cart)
						<?php $amount += is_numeric($cart->price) ? $cart->price : 0; ?>
						@endforeach
					@else
						<div class="alert alert-success"> No product found to payment for</div>
					@endif
					<h4 class="alert"><span>Total Payable </span><span class="pull-right text-danger"><b>BDT {{ isset($amount) ? $amount : 0}}</b></span></h4>
					{!! errors($errors) !!}
					<div class="row">
						<div class="col-md-3 left-bar layout-2">
							<h4>Pay With</h4>
							<p><img class="card" src="{{asset('public/img/peerposted/images/card.svg')}}"></p>
							<p><img class="payoneer" src="{{asset('public/img/peerposted/images/amazon.svg')}}"></p>
						</div>

						<div class="col-md-5">
							<br><br><br>
							<form>
								<div class="form-group">
								  <div class="col-10">
								    <input class="form-control" type="text" placeholder="XXXX-XXXX-XXXX-4321" id="example-text-input" maxlength="16">
								  </div>
								</div>
								<div class="form-group row">
									<div class="col-md-8">
								    	<input class="form-control" type="date" placeholder="MM/YY">
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control" id="pwd" placeholder="CVV" maxlength="3">
									</div>
								</div>
								<div class="checkbox">
									<label><input type="checkbox"> Save for later</label>
								</div>
							</form>
						</div>

						<div class="col-md-4">

							<h4 class="saved-card">Saved Cards</h4>
							<button class="btn btn-active save-1">....XXXX 4589</button>
							<button class="btn btn-common save-2">....XXXX 4589</button>
							<form action="{{action("Stripes@index", 1)}}" method="POST">
								<input name="_token" type="hidden" value="{{csrf_token()}}" />
								<script
										src="https://checkout.stripe.com/checkout.js" class="stripe-button"
										data-key="{!! env("STRIPE_PUBLISH_KEY") !!}"
										data-amount="{{$amount * 100}}"
										data-name="Peerposted LLC"
										data-description="Widget"
										data-image="{{asset('/public/img/peerposted/images/logo.png')}}"
										data-locale="auto">
								</script>
							</form>
						</div>
						
					</div>
					<div class="col-md-12 footer">
						<a href="#" class="btn color-text"><i class="fa fa-angle-left"></i> Continue Shopping </a>

						<a href="#" class="btn btn-common pull-right">Continue to Cart <i class="fa fa-angle-right"></i></a>

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
