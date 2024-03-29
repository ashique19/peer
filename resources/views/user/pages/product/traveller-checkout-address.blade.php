@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Products @stop
@section('main')
    <div class="wrapper">
		@include('user.pages.product.sidebar')
      <div id="content">
			@include('user.pages.product.header')
			<div class="container-fluid"  style="margin-top:3%">
				<h5>Traveller Cart Products</h5>
				@if(count($data['items']) > 0)
				    
		        <ul class="list-unstyled video-list-thumbs row">
			        
		        	@foreach($data['items'] as $cart)
						<li class="col-lg-2 col-sm-3 col-xs-4">
							<a href="#" title="Claudio Bravo, antes su debut con el Barça en la Liga">
								<img src="{{$cart->products->image or asset('public/product/photo_not_available.png')}}" alt="Barca" class="img-responsive" height="130px" />
								<h6 class="limited-text">{{$cart->products->title}}</h6>
							</a>
						</li>

		            @endforeach
		            <li class="col-lg-2 col-sm-3 col-xs-4">
						<a href="{{route('buyer-search')}}">
							<img src="http://via.placeholder.com/200x140?text=Shop more" alt="Shop more" class="img-responsive" height="130px" />
						</a>
					</li>
				</ul>
				    
				@else
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-container">
                                    <header class="page-header clearfix">
                                            <div class="alert alert-info text-center"> No item in your cart. Add to cart for checkout.</div>
                                    </header>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div style="margin-top:5%"></div>
                <!-- Add Address option -->
                <h5>Select your delivery method</h5>
				<div id="delivery-method">
					<button class="btn btn-lg" id="ship-to-office" value="ship">Ship to Office</button>
					<button class="btn btn-common btn-lg" id="pick-up" value="pick-up">Pick up request</button>
					{{--<button class="btn btn-lg" id="later" value="later">Decide Later</button>--}}
				</div>
				<br><br>
                {!! errors($errors) !!}
            	<form class="form-horizontal" role="form" action="{{route('buyer-store')}}" method="post">
				      <input type="hidden" name="_token" value="{{csrf_token()}}" />
				      @foreach($data['items'] as $cart)
				      	<input type="hidden" name="title" value="{{$cart->title}}" />
				      	<input type="hidden" name="price" value="{{$cart->price}}" />
				      	<input type="hidden" name="url" value="{{$cart->url}}" />
				      	<input type="hidden" name="image" value="{{$cart->image}}" />
				      	<input type="hidden" name="quantity" value="{{$cart->quantity}}" />
				      	<input type="hidden" name="description" value="{{$cart->description}}" />
					  @endforeach
                 <div class="row" id="pick-up-content">
				   <!-- <div class="col-md-6 hidden">-->
				   <!--     <fieldset>-->
				
				          <!-- Form Name -->
				   <!--       <legend>From</legend>-->
							<!--{!! Form::select('from_country_id', \App\Country::orderBy('name')->lists('name', 'id'), old('country_from'), ['class'=> 'form-control select2', 'placeholder'=> '- Please select From Country-', 'required'=> 'required']) !!}-->
							<!--<br/>-->
				          <!-- Text input-->
				   <!--       <div class="form-group">-->
				   <!--         <div class="col-sm-10">-->
				   <!--           <input type="text" name="from_address" placeholder="Address" class="form-control">-->
				   <!--         </div>-->
				   <!--       </div>-->
			
				          <!-- Text input-->
				   <!--       <div class="form-group">-->
				   <!--         <div class="col-sm-4">-->
				   <!--           <input type="text" name="from_state" placeholder="State" class="form-control">-->
				   <!--         </div>-->
				   <!--         <div class="col-sm-4">-->
				   <!--           <input type="text" name="from_zip" placeholder="Zipcode" class="form-control">-->
				   <!--         </div>-->
				   <!--       </div>-->
				   <!--     </fieldset>-->
				   <!-- </div>-->
				    <div class="col-xs-12 ">
				        <fieldset>
				          <!-- Form Name -->
				          <legend>Address</legend>
						  {!! Form::select('to_country_id', \App\Country::orderBy('name')->lists('name', 'id'), old('country_to'), ['class'=> 'form-control select2', 'placeholder'=> '- Please select To Country -', 'required'=> 'required']) !!}
							<br/>
				          <!-- Text input-->
				          <div class="form-group">
				            <div class="col-sm-10">
				              <input type="text" name="to_address" placeholder="Address" class="form-control">
				            </div>
				          </div>
			
				          <!-- Text input-->
				          <div class="form-group">
				            <div class="col-sm-4">
				              <input type="text" name="to_state" placeholder="State" class="form-control">
				            </div>
				            <div class="col-sm-4">
				              <input type="text" name="to_zip" placeholder="Zipcode" class="form-control">
				            </div>
				          </div>
						<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
				
				        </fieldset>
				    </div>
				</div><!-- /.row -->
				 <div class="row" id="ship-content" style="margin: 20px; display: none;">
					 <fieldset>
						 <legend>Select Office</legend>
						 <div class="col-md-12 ">
							 <div class="input-group">
								 <div class="input-group-btn">
									 <img src="{{asset('public/img/peerposted/images/dashboard/travel.svg')}}" style="width: 20%">
									 <a class="btn" style="margin-right: 30px; ">Select Office</a>
								 </div>
								 <select class="form-control select2 country-to" name="to_address" id="office">
									 <option value="gulshan">Gulshan</option>
									 <option value="airport">Airport</option>
								 </select>
							 </div>
						 </div>
					 </fieldset>
				 </div>
				<div class="row">
					<div class="col-md-2"><a href="{{route('product-lists')}}" class="btn color-text"><i class="fa fa-angle-left"></i> Continue Shopping</a></div>
					<div class="col-md-8"></div>
					<div class="col-md-2"><button class="btn btn-info btn-block" type="submit" name="submit">checkout</button></div>
				</div>
		      </form>
			
			</div>
        </div>
        
    </div>
    
@endsection
@section('js')
<script >
   $(document).ready(function() {
       $("#office").select2();
       $("#delivery-method").on('click', 'button', function(e) {
           var self = $(this), val = self.val();
          self.parent().find('button').removeClass('btn-common');
          self.addClass('btn-common');
          console.log();
          if(val === 'pick-up') {
              $("#pick-up-content").show('slow');
              $("#ship-content").hide('slow');
		  } else if(val === 'ship') {
              $("#pick-up-content").hide('slow');
              $("#ship-content").show('slow');
              $('')
		  } else {
              $("#pick-up-content").hide('slow');
              $("#ship-content").hide('slow');
		  }
	   });
    })
</script>
    <script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
<style>
	.limited-text {
		white-space: nowrap;
		width: 150px;
		overflow: hidden;
		text-overflow: ellipsis;
	}
</style>
@endsection
