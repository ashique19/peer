@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Products @stop
@section('main')

    <div class="wrapper">
		@include('user.pages.product.sidebar')

      <div id="content">
      	@include('user.pages.product.header')
			<div class="container-fluid request">
				
				<div class="col-lg-12 input-box">
                      <div class="input-group">
                        <div class="input-group-btn">
                          <!-- Button and dropdown menu -->
                          <img src="{{asset('public/img/peerposted/images/departure.svg')}}" style="width: 20%">
                          <a class="btn" style="margin-right: 30px; ">Select Departure </a>
                        </div>
                        <select class="form-control text-danger" id="travels">
                          
			                @foreach($myTravels as $travel)
	                        	<option value="{{$travel->id}}">{{$travel->departure_date->format("d-m-Y")}} | {{$travel->countryFrom->code}} - {{$travel->countryTo->code}}</option>
	                        @endforeach      
                        </select>
                        
                      </div>
                </div><!-- /.row -->
			    <div class="col-md-12">
				    <h5>Available shipping request.</h5>
				    <div id="products" class="row list-group">
				    	@if($buyers)
				    	@foreach($buyers as $buyer)
				    		<div class="request-item col-xs-3 col-lg-3">
					            <div class="thumbnail">
					            	<a href="#" class="btn btn-danger">-10%</a>
					            	<a href="#" class="btn btn-primary pull-right" >Earn: {{round($buyer->price * .125, 2)}}</a>
					                <img class="group list-group-image" src="{{$buyer->image}}" alt="" />
					                <a href="{{$buyer->url}}" target="_blank"><img class="group hover-icon-eye" src="{{asset('public/img/peerposted/images/details.svg')}}" alt="" /></a>
					                <!--<img class="group hover-icon-cart add-to-tr-cart" src="{{asset('public/img/peerposted/images/add_to_cart.svg')}}" alt="cart" data-id="{{$buyer->id}}" />-->
					                <div class="caption col-md-12">
					                	<div class="row">
					                		<div class="col-md-12">
							                    <a href=""><h5 class="group inner list-group-item-heading">{{$buyer->title}}</h5></a>
							                    <h5 class="group inner list-group-item-heading">
							                        {{$buyer->description}}</h5>
					                		</div>
					                		{{--<div class="col-md-2 ">--}}
					                            {{--<a href="#" class="btn btn-info pull-right">{{round($buyer->price * .125, 2)}}</a>--}}

					                		{{--</div>--}}
					                		
					                	</div>
					                	<div class="row">
					                		<div class="col-md-6">
					                            <a  href="#" data-id="{{$buyer->id}}" class="btn btn-common pull-left collect add-to-tr-cart">Collect</a>
					                		</div>
					                		<div class="col-md-6">
                                                <a href="#" class="btn btn-common pull-right contact">BDT {{$buyer->price}}</a>
					                		</div>
					                	</div>
					                </div>
					            </div>
					        </div>
			    		@endforeach
				    	@else
				    		<div class="container">
		                        <div class="row">
		                            <div class="col-sm-12">
		                                <div class="page-container">
		                                    <header class="page-header clearfix">
		                                            <div class="alert alert-info text-center"> Add Travel first to choose your product.</div>
		                                    </header>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
				    	@endif
				    </div>
			    </div>
			</div>
        </div>
        
    </div>
    
@endsection
@section('js')
<script >
	var dRoute = '{{route("product-details")}}';
   $(document).ready(function(){
       $("#travels").on('change', function(e) {
       		e.preventDefault();
           console.log($(this).val());
           
           $.ajax({
              url: ROOT_URL + 'user/travel/' + $(this).val() + '/buyer'})
              .done(function( data ) {
              	
              	var products = data, productsDiv = '',
                    img, productContainer = $('#products'), column = 0;
                    
                console.log(products);
                if(products.status === 200) {
                    
                    productContainer.html('');
                    $.each(products.data, function(key, product) {
                        
                       img = (product.image) ? product.image : 'http://placehold.it/300x140/ffffff/000000?text=image';
                    
          				detailsUrl = dRoute + '?id='+product.id+'&title='+product.title + '&price='+product.currency+' ' +product.price+'&image=' + img + '&url='+product.url+'&category=' + product.category;
          				detailsUrl = encodeURI(detailsUrl);
          				
          				productsDiv += '<div class="request-item col-xs-3 col-lg-3"><div class="thumbnail"><a href="#" class="btn btn-danger">-10%</a><a href="#" class="btn btn-primary pull-right" >Earn:' + product.price * .125 + '</a><img class="group list-group-image" src="'+img+'" alt="" />'+
          				'<a href="'+product.url+'" target="_blank"><img class="group hover-icon-eye" src="{{asset("public/img/peerposted/images/details.svg")}}" alt="details"/></a>'+
          				'<img class="group hover-icon-cart" src="{{asset('public/img/peerposted/images/add_to_cart.svg')}}" alt="add to cart" />'+
          				'<div class="caption col-md-12"><div class="row"><div class="col-md-10"><a href="'+detailsUrl+'"><h5 class="group inner list-group-item-heading">'+product.title+
          				'</h5></a><h5 class="group inner list-group-item-heading">'+product.description+'</h5></div>'+
          				'</div><div class="row"><div class="col-md-6"><a href="#" data-id="'+product.id+'" class="btn btn-common pull-left collect add-to-tr-cart">Collect</a></div><div class="col-md-6"><a href="#" class="btn btn-common pull-right price">BDT '+product.price+'</a></div></div></div></div></div>';
                    });
                    
                    // Append all product
                    productContainer.html(productsDiv);
                    
                } else {
                	console.log('no data');
                    productContainer.html('<div class="alert alert-danger" role="alert">Products not found for particular route</div>');
                }
              });
        
       });
    }) 
</script>
<script >
    $(document).ready(function(){

        // Add to traveller Cart
        $(document).on('click', '.add-to-tr-cart',  function(e){
            var self = $(this);
            e.preventDefault();
            $.ajax({
                url: ROOT_URL + '/user/traveller-cart',
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    id: self.data('id'),
                },
                success:function(response) {
                    console.log(response);
                    if((response.status == 200) || (response.status == 204)){
                        // $.notify({message: response.message },{type: 'success'});
                        self.html('Delete Collect')
                            .addClass('del-from-tr-cart').removeClass('add-to-tr-cart')
                            .addClass('btn-danger').removeClass('btn-success')
                            .attr('data-cartid', response.data.id);

                    }
                    if(response.status == 204){
                        // $.notify({message: response.message  },{type: 'warning'});
                    }

                    if(response.data.quantity>0)
                        $('#traveller-cart-quantity').html(response.data.quantity);
                    // else
                        // $('#traveller-cart-quantity').html('');

                },
                error:function(data){
                    console.log(data);
                    // $.notify({message: 'Product can not be added.' },{type: 'warning'});
                }
            });
        });
        $(document).on('click', '.del-from-tr-cart', function(e){
            var id = $(this).data('cartid');
            console.log(id);
            e.preventDefault();
            $.ajax({
                url: ROOT_URL + '/user/traveller-cart/'+ id,
                type:'POST',
                data: {_method: 'delete'},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response) {
                    console.log(response);
                    if(response.status == 200){
                        $('.del-from-tr-cart').html('Collect')
                            .addClass('add-to-tr-cart').removeClass('del-from-tr-cart')
                            .removeClass('btn-danger');
                    }
                    if(response.status == 400){
                        console.log(response);
                    }
                    if(response.data.quantity>0)
                        $('#traveller-cart-quantity').html(response.data.quantity);
                    else
                        $('#traveller-cart-quantity').html('');

                },
                error:function(data){
                    console.log(data);
                }
            });
        });
    })
</script>
    <script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script> 
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
<style type="text/css">
	
	.input-group-btn>.btn {
	    font-size: 14px;
	}
	.btn-danger, .btn-common {
		color: white !important;
		font-size: 13px;
	}
	.price {
	  background-color : #8ce9e1 !important;
	}
	#travels {
		font-size: 17px;
	}
</style>
@endsection
