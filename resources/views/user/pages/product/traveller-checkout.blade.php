@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Traveller @stop
@section('main')

    <div class="wrapper">
		@include('user.pages.product.sidebar')

      <div id="content">
      	@include('user.pages.product.header')
			<div class="container-fluid">
				
				<h2 class="title push-up-20">Traveler Bag</h3>
				@if(count($data['items']) > 0)
				    <table id="cart" class="table table-condensed">
					<thead style="background-color: lightgrey">
						<th class="col-md-4">Products Name</th>
						<th>Category</th>
						<th>Weight</th>
						<th>Box size</th>
						<th>Remuneration</th>
						<th>Action</th>
					</thead>
				    <tbody>
				        @foreach($data['items'] as $key => $cart)
    						<tr>
    							<td class="col-md-7">
    								<div class="row">
    									<div class="col-sm-4">
    										<img src="{{$cart->products->image}}" alt="..." class="img-responsive"/>
    									</div>
    									<div class="col-sm-8">
    										<h4 class="nomargin">{{$cart->products->title}}</h4>
    										<p></p>
    									</div>
    								</div>
    							</td>
    							<td class="col-md-1">
									{{$cart->products->category}}
    							</td>
    							<td class="col-md-1">500gm</td>
    							<td class="col-md-1">120x145cm</td>
    							<td class="col-md-1"><strong>{{$cart->products->price}}</strong></td>
    							<td class="col-md-1">
    								<a class="del-from-tr-cart" data-id="{{$cart->id}}"><i class="glyphicon glyphicon-remove"></i></a>
    							</td>
    						</tr>

				        @endforeach
					</tbody>
					<tfoot>
						<tr>
							<td><a href="{{route('product-lists')}}" class="btn color-text"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center"><strong></strong></td>
							<td class="hidden-xs text-center"><strong></strong></td>
							<td class="col-md-1"><a href="{{route('traveller-checkout-address')}}" class="btn btn-info btn-block btn-common"> Confirm Collection</a></td>
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
       
       $('body').on('click', '.del-from-tr-cart', function(e){
       	e.preventDefault();
        var self = $(this), id = self.data('id');
        console.log(e);
		
        $.ajax({
            url: ROOT_URL + 'user/traveller-cart/'+ id,
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
	.select2-container--default .select2-selection--single {
		background-color:none !important;
		border:none !important;
	}
	.select2-container--default .select2-selection--single .select2-selection__rendered {
	    color: red;
	    font-size: 16px;
	}
	#cart thead th {
		padding: 12px;
		color: grey;
	}
</style>
@endsection
