@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        
        <div class="col-xs-12 push-up-50 no-padding">
            
            <div class="col-sm-3 search-area push-up-50">
                
            </div>
            <div class="col-sm-9 search-result-area">
                <h1 class="section-heading black-text">Product Search</h1>
                <h3>Search Product by link</h3>
                    <div class="span12">
                        <form id="custom-search-form" class="form-search form-inline">
                            <div class="input-append span12">
                                <input type="text" name="search" id="search-box" class="form-control input-lg" placeholder="Search" value="monitor" style="min-width:500px" />
                                 <button type="button" class="btn btn-primary btn-sm" id="search-btn" style="display:none">Search</button>
                                 <button type="button" class="btn btn-primary btn-sm" id="search-btn-link">Search</button>
                            </div>
                            <div id="searchEngineSelector" class="">
                                <div class="searchEngineradioCont row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-left ">
                                        <div class="row">
                                            <label for="radio-default" class="active radio-inline">
                                                <input id="radio-default" type="radio" name="searchOption" value="link">URL Link 
                                            </label>
                                            <label for="radio-ebay" class="radio-inline">
                                                <input id="radio-ebay" type="radio" name="searchOption" value="ebay" checked="">eBay
                                            </label>
                                            <label for="radio-amz"  class="radio-inline">
                                                <input id="radio-amz" type="radio" name="searchOption" value="amz">Amazon
                                            </label>
                                            <label for="radio-sem"  class="radio-inline">
                                                <input id="radio-sem" type="radio" name="searchOption" value="sem">Others
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </form>        
                        <br/><br/>
                        <div id="preview-container"></div>
                    </div>
                
                <div class="col-sm-12 panel-body text-center push-up-20 push-down-20 search-item" >
       
                </div>
                    
            </div>
            
        </div>
        
    </div>
    
     <div class="row products" id="products-container">
    	<!-- BEGIN PRODUCTS -->
  		<!--<div class="col-md-3 col-sm-6">-->
    <!--		<span class="thumbnail">-->
    <!--  			<img src="http://placehold.it/500x400" alt="...">-->
    <!--  			<h4>Product Tittle</h4>-->
    <!--  			<div class="ratings">-->
    <!--                <span class="glyphicon glyphicon-star"></span>-->
    <!--                <span class="glyphicon glyphicon-star"></span>-->
    <!--                <span class="glyphicon glyphicon-star"></span>-->
    <!--                <span class="glyphicon glyphicon-star"></span>-->
    <!--                <span class="glyphicon glyphicon-star-empty"></span>-->
    <!--            </div>-->
    <!--  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>-->
    <!--  			<hr class="line">-->
    <!--  			<div class="row">-->
    <!--  				<div class="col-md-6 col-sm-6">-->
    <!--  					<p class="price">$29,90</p>-->
    <!--  				</div>-->
    <!--  				<div class="col-md-6 col-sm-6">-->
    <!--  					<button class="btn btn-success right" > BUY ITEM</button>-->
    <!--  				</div>-->
      				
    <!--  			</div>-->
    <!--		</span>-->
  		<!--</div>-->
  		
  		<!-- END PRODUCTS -->
	</div>
</section>


@stop

@section('footer-js')
<script type="text/javascript" src="{{ asset('public/preview/common.js') }}"></script>
<!--<script type="text/javascript" src="{{ asset('public/preview/proxy-ajax.js') }}"></script>-->
<script type="text/javascript" src="{{ asset('public/preview/bootstrap-linkpreview.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/preview/main.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#custom-search-form").on('click', '#search-btn-link', function(e){
           e.preventDefault();
           var searchKey = $("#search-box").val();
           if (! searchKey) {
               console.log('Please insert search key');
               return false;
           }
           $.ajax({
              url: "http://air-ashique19.c9users.io/user/products/search/ebay",
              data:{q:searchKey},
              beforeSend: function( xhr ) {
                // xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
              }
            })
              .done(function( data ) {
                var products = JSON.parse(data), productsDiv = '',
                    rating = '<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>',
                    img, productDiv = $('#products-container');
                    
                console.log(products.data);
                if(products.status == 200) {
                    
                    productDiv.html('');
                    $.each(products.data, function(key, product) {
                       console.log(product); 
                       img = (product.image) ? product.image : 'http://placehold.it/500x400';
                       
                       productsDiv += '<div class="col-md-3 col-sm-6"><span class="thumbnail"><img src="'+img+'" alt="..."><a href="'+product.url+'" target="_blank"><h3>'+product.title+'</h3></a><div class="ratings">' + rating +
                    '</div><p>'+product.category+'</p><hr class="line">' +
          			'<div class="row"><div class="col-md-6 col-sm-6"><p class="price">'+product.currency+' '+product.price+'</p></div><div class="col-md-6 col-sm-6"><button class="btn btn-success right" > BUY ITEM</button></div></div></span></div>';
                    });
                    
                    // Append all product
                    productDiv.append(productsDiv);
                    
                } else {
                    console.log('Products not found');                    
                }
              });
        });
        
        // Search option choose
        $('input[type=radio][name=searchOption]').change(function() {
            console.log(this.value);
        if (this.value == 'link') {
            loadFileByType('http://air-ashique19.c9users.io/public/preview/proxy-ajax.js', 'js');
            $("#search-box").val('https://walmart.com/ip/AT-T-PREPAID-Samsung-Galaxy-Express-Prime-2-16GB-Prepaid-Smartphone-Black/150807922')
            $("#search-btn-link").hide();
            $("#search-btn").show();
        } else {
            $("#search-box").val('monitor')
            $("#search-btn").hide();
            $("#search-btn-link").show();
        }
    });
    });
</script>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('public/preview/linkpreview.css') }}">
<style>
.products img{
    max-width: 300px !important;
    max-height: 400px !important;
}
 h4{
    	font-weight: 600;
	}
	p{
		font-size: 12px;
		margin-top: 5px;
	}
	.price{
		font-size: 30px;
    	margin: 0 auto;
    	color: #333;
	}
	.right{
		float:right;
		border-bottom: 2px solid #4B8E4B;
	}
	.thumbnail{
		opacity:0.70;
		-webkit-transition: all 0.5s; 
		transition: all 0.5s;
	}
	.thumbnail:hover{
		opacity:1.00;
		box-shadow: 0px 0px 10px #4bc6ff;
	}
	.line{
		margin-bottom: 5px;
	}
	@media screen and (max-width: 770px) {
		.right{
			float:left;
			width: 100%;
		}
	}
</style>
@endsection