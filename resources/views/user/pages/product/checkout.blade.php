@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Products @stop
@section('main')

    <div class="wrapper">
		@include('user.pages.product.sidebar')

      <div id="content">
      	@include('user.pages.product.header')
			<div class="container-fluid">
				
				<h1>Buyer Cart</h1>
				@if(count($data['items']) > 0)
				    <table id="cart" class="table table-condensed">
				    <tbody>
				        @foreach($data['items'] as $key => $cart)
    						<tr>
    							<td class="col-md-1">{{++$key}}</td>
    							<td class="col-md-5">
    								<div class="row">
    									<div class="col-sm-2 hidden-xs">
    										<img src="{{$cart->image}}" alt="..." class="img-responsive"/>
    									</div>
    									<div class="col-sm-8">
    										<h4 class="nomargin">{{$cart->title}}</h4>
    										<p></p>
    									</div>
    								</div>
    							</td>
    							<td class="col-md-1">
    								<div class="input-group input-group-sm qnt-input">
    									
    									<input type="number" class="form-control" min="1" value="1" aria-describedby="sizing-addon3">
    									<span class="btn btn-common qnt-add input-group-addon" id="sizing-addon3"><i class="glyphicon glyphicon-plus"></i></span>
    								</div>
    							</td>
    							<td class="col-md-1"></td>
    							<td class="col-md-1"><strong>{{$cart->price}}</strong></td>
    							<td class="col-md-1">
    								<a class="del-from-cart" data-id="{{$cart->id}}"><i class="glyphicon glyphicon-remove"></i></a>								
    							</td>
    						</tr>

				        @endforeach
					</tbody>
					<tfoot>
						<tr class="visible-xs">
							<td class="text-center"><strong>$1.99</strong></td>
						</tr>
						<tr>
							<td><a href="{{route('product-lists')}}" class="btn color-text"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center"><strong></strong></td>
							<td class="hidden-xs text-center"><strong></strong></td>
							<td class="col-md-1"><a href="{{route('checkout-address')}}" class="btn btn-info btn-block"> Add Address</a></td>
						</tr>
					</tfoot>
				</table>
				
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
                
			</div>
        </div>
        
    </div>
    
@endsection
@section('js')
<script >
   $(document).ready(function(){
       
       $(document).on('click', '.del-from-cart', function(e){
       	e.preventDefault();
        var self = $(this), id = self.data('id');
        console.log(e);
		
        $.ajax({
            url: ROOT_URL + 'user/cart/'+ id,
            type:'POST',
            data: {_method: 'delete'},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response) {
                console.log(response);
                if(response.status == 200){
                    self.closest('tr').hide('slow');
                }
                if(response.status == 400){
                    console.log(response);
                }                
                if(response.data.quantity>0)
                   $('#cart-quantity').html(response.data.quantity);
                else 
                    $('#cart-quantity').html('');

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
	.select2-container--default .select2-selection--single {
		background-color:none !important;
		border:none !important;
	}
	.select2-container--default .select2-selection--single .select2-selection__rendered {
	    color: red;
	    font-size: 16px;
	}
</style>
@endsection
