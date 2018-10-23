@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Products @stop
@section('main')
    <div class="wrapper">
		@include('user.pages.product.sidebar')

      <div id="content">
      	@include('user.pages.product.header')
			<div class="container-fluid">
				
				<div class="col-md-12" style="margin: 20px auto;">
                <p>Add your travel. It's easy...</p>
                	@if( $errors->any() && ! $errors->has('user_type') )
	                    <div class="row">
		                    @foreach( $errors->all() as $error )
		                    <p class="alert alert-info">{{ $error }}</p>
		                    @endforeach
	                    </div>
                    @endif
                    {!! Form::open(['url'=> action('Travels@storeMyTravel'), 'class'=> 'travel-info-post blue-label']) !!}
                    <div class="row" style="background: #FBFCFE; margin: 20px auto; padding: 15px;">
                        <div class="col-lg-6">
                          <div class="input-group">
                              <div class="input-group">
                                <div class="input-group-btn">
                                  <img src="{{asset('public/img/peerposted/images/departure.svg')}}" style="width: 20%">
                                  <a class="btn" style="margin-right: 30px; ">Select Departure</a>
                                </div>
                                {!! Form::select('country_from', \App\Country::orderBy('name')->lists('name', 'id'), old('country_from'), ['class'=> 'form-control select2 country-from', 'placeholder'=> 'Country', 'required'=> 'required']) !!}
                              </div>
                          </div><!-- /input-group -->
                        </div>
                        <div class="col-lg-6">
                              <div class="input-group">
                                  <div class="input-group">
                                    <div class="input-group-btn">
                                      <!-- Button and dropdown menu -->
                                      <img src="{{asset('public/img/peerposted/images/airport.svg')}}" style="width: 20%">
                                      <a class="btn" style="margin-right: 30px; ">Select Airport</a>
                                    </div>
		                            {!! Form::select('airport_from', [], old('airport_from'), ['class'=> 'form-control airport-search', 'placeholder'=> 'Airport name', 'required'=> 'required']) !!}
                                  </div>
                              </div><!-- /input-group -->
                            </div>
                    </div>
                    <div class="row" style="background: #FBFCFE; margin: 20px auto; padding: 15px;">
                        <div class="col-lg-6">
                          <div class="input-group">
                              <div class="input-group">
                                <div class="input-group-btn">
                                  <!-- Button and dropdown menu -->
                                  <img src="{{asset('public/img/peerposted/images/destination.svg')}}" style="width: 20%">
                                  <a class="btn" style="margin-right: 30px; ">Select Destination

                                  </a>
                                </div>
                                {!! Form::select('country_to', \App\Country::orderBy('name')->lists('name', 'id'), old('country_to'), ['class'=> 'form-control select2 country-to', 'placeholder'=> 'Country', 'required'=> 'required'    ]) !!}
                              </div>
                          </div><!-- /input-group -->
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                              <div class="input-group">
                                <div class="input-group-btn">
                                  <!-- Button and dropdown menu -->
                                  <img src="{{asset('public/img/peerposted/images/airport.svg')}}" style="width: 20%">
                                  <a class="btn" style="margin-right: 30px; ">Select Airport

                                  </a>
                                </div>
                                {!! Form::select('airport_to', [], old('airport_to'), ['class'=> 'form-control airport-search', 'placeholder'=> 'Airport Name', 'required'=> 'required']) !!}
                              </div>
                          </div><!-- /input-group -->
                        </div>
                    </div>
                    <div class="row" style="background: #FBFCFE; margin: 20px auto; padding: 15px;">
                        <div class="col-lg-6">
                          <div class="input-group">
                              <div class="input-group">
                                <div class="input-group-btn">
                                  <!-- Button and dropdown menu -->
                                  <img src="{{asset('public/img/peerposted/images/calender.svg')}}" style="width: 20%">
                                  <a class="btn" style="margin-right: 30px; ">Departure Date

                                  </a>
                                </div>
                                {!! Form::text('departure_date', old('departure_date'), ['class'=> 'form-control datepicker push-up-10', 'placeholder'=> 'Departure date', 'title'=> 'Departure date', 'required'=> 'required']) !!}
                                <!--<input type="date" name="" style="background: #FBFCFE; border: none; color: red; ">-->

                              </div>
                          </div><!-- /input-group -->
                    </div>
                        <div class="col-lg-6">
                            <div class="input-group">
                          <div class="input-group">
                            <div class="input-group-btn">
                              <!-- Button and dropdown menu -->
                              <img src="{{asset('public/img/peerposted/images/calender.svg')}}" style="width: 20%">
                              <a class="btn" style="margin-right: 30px; ">Arrival Date</a>
                            </div>
                            {!! Form::text('arrival_date', old('arrival_date'), ['class'=> 'form-control datepicker push-up-10', 'placeholder'=> 'Arrival date', 'title'=> 'Arrival date', 'required'=> 'required']) !!}
                          </div>
                      </div><!-- /input-group -->
                        </div>
                    </div>

                </div>
        <!--        <a href="#" class="btn btn-common" style="background: url({{asset('public/img/peerposted/images/destination.svg')}}) no-repeat #43C1B6;background-size: 16% 57%;padding: 1% 5%;background-position: 10px " id="add-return-route">Add Return Route</a>-->
                <input type="submit" class="btn btn-common pull-right" style="padding: 1% 5%;background-position: 10px " value="Add My Travel" />
                {!! Form::close() !!}
			</div>
        </div>
        
    </div>
    
<div class="modal fade in" tabindex="-1" role="dialog" id="for-traveler-modal">
	<div class="modal-dialog for-buyer-traveler-modal" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<figure>
					<img width="100%" src="/public/img/settings/for-traveler.jpg" alt="For Traveler" class="img img-responsive">
				</figure>
				<p class="detail">
				    <h5>Choose your destination</h5>
				    If you already have travel plans or are thinking about traveling somewhere soon, select “from” and “to”, to see what people are ordering and how much money you can make
					<br><br>
					<h5>Choose an Order</h5>
					When you find an order you would like to deliver, notify us by simply selecting that product through our dashboard. 
					<br><br>
					<h5>Purchase the items</h5>
				Peerposted will hold the payment from the buyer and guarantees your payment upon delivering the item. Simply purchase the item with your own money and  you will be paid your commission  after delivery
				<br><br>
				<h5>Deliver and get paid</h5>
				Deliver item to the designated location and receive your payment within 3 working days.
				<p class="text-center">
					<button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
				</p>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
@endsection
@section('js')
<script >
   $(document).ready(function(){
     
     if( localStorage.getItem('traveler-modal-displayed') != "true" && localStorage.getItem('traveler-modal-displayed') != true ){	     $('#for-traveler-modal').modal('show');
    	
      $('#for-traveler-modal').modal('show');	
      	
      localStorage.setItem('traveler-modal-displayed', true )	
    	
    }
     
        $(".datepicker").datepicker();
        $("#add-return-route").on('click', function(e){
           e.preventDefault();
           $("#return-route").show('slow');
        });
       $(".country-to").on('change', function(e){
           initializeAirportSearch(e.target.value)
       });
       $(".country-from").on('change', function(e){
           initializeAirportSearch(e.target.value)
       });
       function initializeAirportSearch(params) {
           if ($('.airport-search').length > 0) {
               $('.airport-search').select2({
                   ajax: {
                       url: ROOT_URL+'airport-search/' + params,
                       dataType: 'json',
                       delay: 250,
                       processResults: function(data) {
                           return {
                               results: data
                           };
                       }
                   }
               });
           }
       }

    }) 
</script>
    <script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script> 
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
<style type="text/css">
	.select2-container--default .select2-selection--single {
		background-color:none !important;
		border:none !important;
	}
	.select2-container--default .select2-selection--single .select2-selection__rendered {
	    color: red;
	    font-size: 16px;
	}
	.input-group-btn>.btn {
	    font-size: 14px;
	}
	.btn-common {
		color: white;
		font-size: 13px;
	}
    .form-control.select2, select.form-control, .datepicker {
        color: red;

    }
</style>
@endsection
