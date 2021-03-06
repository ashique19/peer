
<!-- Sidebar Holder -->
    <nav id="sidebar" class="active">
            <div class="sidebar-header" id="sidebar-header">
            	<span class="glyphicon glyphicon-remove open"></span>
            	<span class="glyphicon glyphicon-menu-hamburger close"></span>
            </div>
            <div class="sidebar-body">
	            <ul class="list-unstyled components">
	                <li>
	                	<a href="#">
	                        <i class="glyphicon glyphicon-search hide-on-open-sidebar" id="hidden-search-icon"></i>
	                	</a>
						<form id="custom-search-form" class="CTAs">
							<div class="input-group input-group-sm search-input">
								<span class="input-group-addon" id="sizing-addon3"><i class="glyphicon glyphicon-search"></i></span>
								<input type="text" class="form-control " name="search" id="search-box" placeholder="Search" aria-describedby="sizing-addon3" value="monitor">
							</div>
							<div class="button-group">
								{{--<button type="submit" class="btn btn-common small"><i class="glyphicon glyphicon-retweet"></i></button>--}}
								<button type="button" class="btn btn-common large" id="search-btn-link">Search</button>

							</div>
							<div class="vendor">
								<p>Product Vendor</p>
								<div class="vendor-img">
									<img src="{{asset('public/img/peerposted/images/amazon.svg')}}" onclick="alert('Amazon product are coming soon. For now Add amazon product link at link option.');" data-source="amazon" style="width: 27%" />
									<img src="{{asset('public/img/peerposted/images/ebay.svg')}}" data-source="ebay" style="height: 33px;">
									<span class="link"><i class="fa fa-link " data-source="link"></i> Custom Link</span>
								</div>
							</div>
							{{--<div class="rating">--}}
								{{--<p>Rating</p>--}}
								{{--<div class="vendor-img">--}}
									{{--<i class="glyphicon glyphicon-star"></i>--}}
									{{--<i class="glyphicon glyphicon-star"></i>--}}
									{{--<i class="glyphicon glyphicon-star"></i>--}}
									{{--<i class="glyphicon glyphicon-star"></i>--}}
									{{--<i class="glyphicon glyphicon-star"></i>--}}
								{{--</div>--}}
								{{----}}
							{{--</div>--}}
						</form>
	            	</li>
	            </ul>
	            <ul class="social list-unstyled ">
	                <li><a href="#"><i class="fa fa-facebook"></i> </a></li>
	                <li><a href="#"><i class="fa fa-twitter"></i> </a></li>
	                <li><a href="#"><i class="fa fa-linkedin"></i> </a></li>
	            </ul>
            	
            </div>
        </nav>
<!-- Central Modal Medium Success -->
<div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-notify modal-success" role="document">
		<div class="modal-content">
			<form class="form-inline" id="link-form">
				<div class="modal-header" style="background-color: #F27F2C; color: white">
					Please Insert Link
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="white-text">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-success" role="alert" style="display: none;">

					</div>
					<div class="input-group mb-2 mr-sm-2" style="margin: 10px">
						<div class="form-group">
							<input type="url" required class="form-control" id="url" placeholder="Please insert link" style="width: 500px;"/>
						</div>
						<div class="form-group">
							<input type="textarea" name="custom_link_note" class="form-control" placeholder="Any instruction how we should process your link?" style="width: 500px;" />
						</div>
						<br /><small class="form-text text-muted">Post any product link then Admin will review it and add to your cart to proceed.</small>
					</div>
				</div>
				<div class="modal-footer justify-content-center">
					<a type="button" class="btn btn-outline-success waves-effect" data-dismiss="modal">Cancel</a>
					<button type="submit" id="link-submit" class="btn btn-info">Save </button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Central Modal Medium Success-->
<script type="application/javascript">
	source = '';
	$(".vendor-img").on('click', 'img', function (e) {
	    e.preventDefault();
		source = $(this).data('source');
    });
    $(".vendor-img").on('click', '.link', function (e) {
        e.preventDefault();
        source = $(this).data('source');
        $("#centralModalSuccess").modal('show');
    });
    USER_ROOT_URL = '{{url("/")}}' + '/user/';
    // Add to Cart
    $("#link-form").on('submit',  function(e){
        e.preventDefault();
        var self = $(this), link = $("#url").val();
		@if (Auth::check())
        //show logged in navbar
        @else
            $("#login-btn").trigger('click');
        return ;
        @endif
        if(!link) {
            return;
		}
    	$.ajax({
            url: USER_ROOT_URL + 'cart',
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                url: $("#url").val(),
                custom_link_note: $("[name=custom_link_note]").val()
            },
            success:function(response) {
                console.log(response);
                if(response.status == 200) {
                    $('.alert').html('Admin will review the product.').show('slow');
                }
                if(response.status == 204) {
                    $('.alert').html('Couldn\'t added link to cart.').show('slow');
                }
                if(response.data.quantity > 0)
                    $('#cart-quantity').html(response.data.quantity);
                else
                    $('#cart-quantity').html('');
            },
            error:function(data){
                console.log(data);
            }
        });
    });
</script>
