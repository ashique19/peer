@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Products @stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
<style>
.lead{
	font-size: 16px !important;
}
</style>
@endsection


@section('main')
    <div class="wrapper">
		@include('user.pages.product.sidebar')

        <!-- Page Content Holder -->
        <div id="content">
        	@include('user.pages.product.header')
			<div class="container">
				<br>
			    <div class="well well-sm">
			        <strong>Display</strong>
			        {{--<div class="btn-group">--}}
			            {{--<a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">--}}
			            {{--</span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span--}}
			                {{--class="glyphicon glyphicon-th"></span>Grid</a>--}}
			        {{--</div>--}}
			        <div class="pull-right">
			        	<p>More than <span id="no-of-product"></span> products found.</p>
			        </div>
			    </div>
			    <div id="products">
			    	
			    </div>
				<span id="loader" style="display: none;margin-left:45%"><img src="{{asset('public/product/loading.gif')}}" alt="loader"></span>
			</div>
        </div>
    </div>
@stop

@section('bodyScope')

<div class="modal fade" tabindex="-1" role="dialog" id="for-buyer-modal">
	<div class="modal-dialog for-buyer-traveler-modal" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<figure>
					<img width="100%" src="/public/img/settings/for-buyer.jpg" alt="For Buyer" class="img img-responsive">
				</figure>
				<p class="detail">
					Find your product on Amazon, eBay or a website of your choice and paste the order to custom link. Remember, it’s completely free to create an order.
				</p>
				<p class="text-center">
					<button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
				</p>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('footer-js')
<script type="text/javascript" src="{{ asset('public/preview/common.js') }}"></script>

<script type="text/javascript">

	if( localStorage.getItem('buyer-modal-displayed') != "true" && localStorage.getItem('buyer-modal-displayed') != true ){
		
		$('#for-buyer-modal').modal('show');
		
		localStorage.setItem('buyer-modal-displayed', true )
		
	}
	
	
	
	var detailsRoute = '{{route("product-details")}}';
	@if(\Route::current()->getName() === 'login')
		$(document).ready(function() {
			$("#login-btn").trigger('click');
		})
	@endif
	// Variable to maintain onscroll
	pageNumber = 1;
	inProgress = false;
	
	const win_h = $(window).height();

	$(window).on("scroll", function() {
        var scrollHeight = $(document).height(),
			scrollPosition = $(window).height() + $(window).scrollTop(),
			more = true;
			
		var doc_h = $(document).height() - ( win_h / 2 ) - 100,
			scr_h = $(window).scrollTop() + ( win_h / 2 );
		
		console.table({ win_h, doc_h, scr_h, more, inProgress })
		
        // if (((scrollHeight - scrollPosition) / scrollHeight === 0) && more && !inProgress) {
        if ( scr_h > doc_h && more && !inProgress && $.active < 2) {
            // when scroll to bottom of the page
            $.ajax({
                url: ROOT_URL + "products/search/ebay",
                data:{q:$("#search-box").val(), page: pageNumber},
                beforeSend: function() {
                    $('#loader').show();
                    inProgress = true;
                },
            }).done(function( data ) {
				var products = JSON.parse(data), productsDiv = '',
					rating = '<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>',
					img, productContainer = $('#products'), column = 0, discount;

				console.log(products.data);
				if(products.status == 200) {
                    pageNumber++;
					$.each(products.data, function(key, product) {
						img = (product.image) ? product.image : '{{asset('public/product/photo_not_available.png')}}';

						detailsUrl = detailsRoute + '?id='+product.id+'&title='+product.title + '&price='+' ' +product.price+'&currency='+product.currency+'&image=' + img + '&url='+product.url+'&category=' + product.category;
						detailsUrl = encodeURI(detailsUrl);

						if(column == 0)  {
							productsDiv += '<div class="row">';
						}
						discount = Math.floor((Math.random() * 10) + 1);
						productsDiv += `
						<div class="item col-xs-3 col-lg-3">
							<div class="thumbnail">
								<a href="#" class="btn btn-danger discount">-${discount}%</a>
								<img class="group list-group-image" src="${ img }" alt="" />
								<a href="'+product.url+'" target="_blank">
									<img class="group hover-icon-eye" src="${ ROOT_URL + ASSET_DIR }details.svg" alt="" />
								</a>
								<div class="caption">
									<h4 class="group inner list-group-item-heading"><a class="product-link" href="${ detailsUrl }" >${ product.title }</a></h4>
									<p class="group inner list-group-item-text">${ product.category }</p>
									<div class="row">
										<div class="col-xs-12 col-md-10">
											<p class="lead amount">${ product.currency } <b>${ product.price }</b></p>
										</div>
									</div>
								</div>
							</div>
						</div>
							`;
						if(column === 3) {
							productsDiv += '</div>';
							column = 0;
						}else {
							column++;
						}
					});
					// Append all product
					productContainer.append(productsDiv);
					var totalNoOfProduct = parseInt($("#no-of-product").html());
					if(totalNoOfProduct) {
						totalNoOfProduct += products.data.length;
					} else {
					    totalNoOfProduct = products.data.length;
					}
                    $("#no-of-product").html(totalNoOfProduct);
				} else {
				    more = false;
					console.log('Products not found');
				}
			}).error(function(e){
			    console.log(e);
			}).always(function() {
                $('#loader').hide();
                inProgress = false;
            });
        }
    });
</script>

<script type="text/javascript" src="{{ asset('public/product/sidebar.js') }}"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js"></script>-->

@endsection
