@extends('public.layouts.layout')
@section('title')Peerposted - Shipping Simplified - Products @stop
@section('main')
    <div class="wrapper">
		@include('user.pages.product.sidebar')
        <div id="content">
            @include('user.pages.product.header')
            <div class="container">
            	<div class="well well-sm row" style="margin-top:5%">
                   <div class="col-xs-4 item-photo">
                        <img class="" style="max-width:100%;" src="{{$image or 'http://placehold.it/300x140/ffffff/000000?text=product image'}}" />
                    </div>
                    <div class="col-xs-5" style="border:0px solid gray">
                        
                        <h2>{{$title or 'Title not found'}}</h2>    
                        <h5 style="color:#337ab7">Review for <a href="#">{{$category}}</a> · <small style="color:#337ab7">(5 review)</small></h5>
            
                        <h6 class="title-price"><small>PRICE</small></h6>
                        <h3 style="margin-top:0px;">BDT {{round($price, 2)}}</h3>
            
                        <div class="section">
                            <h6 class="title-attr" style="margin-top:15px;" ><small>COLOR</small></h6>                    
                            <div>
                                <div class="attr" style="width:25px;background:#5a5a5a;"></div>
                                <div class="attr" style="width:25px;background:white;"></div>
                            </div>
                        </div>
                        {{--<div class="section" style="padding-bottom:5px;">--}}
                            {{--<h6 class="title-attr"><small>Options</small></h6>                    --}}
                            {{--<div>--}}
                                {{--<div class="attr2">16 GB</div>--}}
                                {{--<div class="attr2">32 GB</div>--}}
                            {{--</div>--}}
                        {{--</div>   --}}
                        <div class="section" style="padding-bottom:20px;">
                            <h6 class="title-attr"><small>Quantity</small></h6>
                            <div>
                                <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
                                <input value="1" name="quantity" id="quantity" />
                                <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                            </div>
                        </div>                
            
                        <div class="section" style="padding-bottom:20px;">
                            <button class="btn btn-common add-to-cart" data-id="{{$id or '1111'}}" data-title="{{$title or 'N/A'}}" data-price="{{$price or '0'}}" data-price="{{$currency or '$'}}" data-image="{{$image or 'http://placehold.it/300x140/ffffff/000000?text=product image'}}" data-url="{{$url}}">
                                <span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Cart</button>
                            <button class="btn btn-info hidden" id="checkout-link-btn"><a href="{{route('checkout')}}">Go to checkout page</a></button>
                        </div>                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer-js')
<script >
   $(document).ready(function(){
       USER_ROOT_URL = '{{url("/")}}' + '/user/';
        //-- Click on detail
        $("ul.menu-items > li").on("click",function(){
            $("ul.menu-items > li").removeClass("active");
            $(this).addClass("active");
        })

        $(".attr,.attr2").on("click",function(){
            var clase = $(this).attr("class");

            $("." + clase).removeClass("active");
            $(this).addClass("active");
        })

        //-- Click on QUANTITY
        $(".btn-minus").on("click",function(){
            var now = $(".section > div > input").val();
            if ($.isNumeric(now)){
                if (parseInt(now) -1 > 0){ now--;}
                $(".section > div > input").val(now);
            }else{
                $(".section > div > input").val("1");
            }
        })            
        $(".btn-plus").on("click",function(){
            var now = $(".section > div > input").val();
            if ($.isNumeric(now)){
                $(".section > div > input").val(parseInt(now)+1);
            }else{
                $(".section > div > input").val("1");
            }
        })                  
        
        // Add to Cart
        $(document).on('click', '.add-to-cart',  function(e){
            var self = $(this);
            @if (Auth::check())
            //show logged in navbar
            @else
                $("#login-btn").trigger('click');
                return ;
            @endif
            $.ajax({
                url: USER_ROOT_URL + 'cart',
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    id: self.data('id'),
                    title: self.data('title'),
                    price: self.data('price'),
                    url: self.data('url'),
                    image: self.data('image'),
                    quantity: $('#quantity').val()
                },
                success:function(response) {
                    console.log(response);
                    if(response.status == 200){
                        // $.notify({message: response.message },{type: 'success'});
                        $('.add-to-cart').html('Delete Cart')
                        .addClass('del-from-cart').removeClass('add-to-cart')
                        .addClass('btn-danger').removeClass('btn-success')
                        .attr('data-cartid', response.data.id);
                        $("#checkout-link-btn").removeClass('hidden');
                    }
                    if(response.status == 204){
                        // $.notify({message: response.message  },{type: 'warning'});
                    }

                    if(response.data.quantity>0)
                      $('#cart-quantity').html(response.data.quantity);
                    else
                        $('#cart-quantity').html('');

                },
                error:function(data){
                    console.log(data);
                    // $.notify({message: 'Product can not be added.' },{type: 'warning'});
                }
            });
    });
    $(document).on('click', '.del-from-cart', function(e){
        var id = $(this).data('cartid');
        console.log(id);

        $.ajax({
            url: USER_ROOT_URL + 'cart/'+ id,
            type:'POST',
            data: {_method: 'delete'},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(response) {
                console.log(response);
                if(response.status == 200){
                    $('.del-from-cart').html('Add to Cart')
                    .addClass('add-to-cart').removeClass('del-from-cart')
                    .addClass('btn-success').removeClass('btn-danger')
                    .removeAttr('data-cartid');
                    $("#checkout-link-btn").addClass('hidden');
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
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css">--}}
<link rel="stylesheet" type="text/css" href="{{ asset('public/product/style.css') }}">
<style type="text/css">
/*ul > li{margin-right:25px;font-weight:lighter;cursor:pointer}*/
li.active{border-bottom:3px solid silver;}

.item-photo{display:flex;justify-content:center;align-items:center;border-right:1px solid #f6f6f6;}
.menu-items{list-style-type:none;font-size:11px;display:inline-flex;margin-bottom:0;margin-top:20px}
.btn-success{width:100%;border-radius:0;}
.section{width:100%;margin-left:-15px;padding:2px;padding-left:15px;padding-right:15px;background:#f8f9f9}
.title-price{margin-top:30px;margin-bottom:0;color:black}
.title-attr{margin-top:0;margin-bottom:0;color:black;}
.btn-minus{cursor:pointer;font-size:7px;display:flex;align-items:center;padding:5px;padding-left:10px;padding-right:10px;border:1px solid gray;border-radius:2px;border-right:0;}
.btn-plus{cursor:pointer;font-size:7px;display:flex;align-items:center;padding:5px;padding-left:10px;padding-right:10px;border:1px solid gray;border-radius:2px;border-left:0;}
div.section > div {width:100%;display:inline-flex;}
div.section > div > input {margin:0;padding-left:5px;font-size:10px;padding-right:5px;max-width:18%;text-align:center;}
.attr,.attr2{cursor:pointer;margin-right:5px;height:20px;font-size:10px;padding:2px;border:1px solid gray;border-radius:2px;}
.attr.active,.attr2.active{ border:1px solid orange;}

</style>
@endsection
