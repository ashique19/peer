var cart = ($.jStorage.get('cart') == null) ? {products:[], calculation:{}} : $.jStorage.get('cart');

function cart_display_on_pageload()
{
  
  if($('.no-cart').length > 0)
  {
    cart.products = [];
    cart.calculation = {};
  }
  
  var products = _.filter(cart.products, function(v){ return (v != null) ? v : false ; });

  if(products){
    
    $.each(products, function(index,item){
        
        $('.shadow[p_id='+item.id+']').find('.product-cart-amount').removeClass('hidden');
        
        $('.cart-list-group').append('\
          <li class="list-group-item cart-list" p_id="'+item.id+'">\
              <div class="quantity-holder">\
                  <a href="#"><i class="fa fa-sort-asc increase"></i></a>\
                  <br>\
                  <center class="quantity">'+item.cart_quantity+'</center>\
                  <a href="#"><i class="fa fa-sort-desc decrease"></i></a>\
              </div>\
              <div class="details">\
                  <a href="'+item.link+'">\
                      <img src="'+item.image+'" alt="'+item.name+'" class="img-responsive">\
                      <p>'+item.name+' <br> <small><span class="amount">'+item.price*1+'</span> Tk</small></p>\
                  </a>\
                  <center><span class="amount">'+item.cart_amount+'</span> Tk</center>\
              </div>\
              <a href="#" class="remove remove-from-cart"><i class="fa fa-close"></i></a>\
          </li>\
        ');
    });
  
  }
  
  $('.total-quantity').text(cart.calculation.quantity);
  $('.amount-total').text(cart.calculation.amount);
  
}

function update_cart(item)
{
  
  $.jStorage.set('cart', cart);
  
  display_cart(item);
  
}

function display_cart(item)
{
  
  /**
  *
  * 1. Update the product itself
  *   1.1 On product shadow - Make the quantity and Amount visible if more than zero of this item is in cart
  *                         - Make the quantity and Amount hidden if less than one of this item is in cart
  *                         - Update product quantity and amount at shadow during increase/decrease
  * 
  * 2. Update the cart on cart bar
  *   2.1 Add the product to cart-bar if it does not already exist
  *   2.2 Remove the product from cart-bar if the item has been removed from cart
  *   2.3 Update product quantity and amount at cart-bar during increase/decrease
  *   2.4 Product quantity cannot increase more than available stock
  * 
  * 3. Update the quantity and amount at cart floating button
  * 
  */
  
  if(cart.products[item.id]){
    if(cart.products[item.id].cart_quantity > 0)
    {
      
      $('.shadow[p_id='+item.id+']').find('.product-cart-amount').removeClass('hidden');
      
      if($('.cart-list[p_id='+item.id+']').length > 0)
      {
        
        $('[p_id='+item.id+']').find('.quantity').text(item.cart_quantity);
        $('[p_id='+item.id+']').find('.amount').text(item.cart_amount);
        
      } else{
        
        $('.cart-list-group').append('\
        <li class="list-group-item cart-list" p_id="'+item.id+'">\
            <div class="quantity-holder">\
                <a href="#"><i class="fa fa-sort-asc increase"></i></a>\
                <br>\
                <center class="quantity">'+item.cart_quantity+'</center>\
                <a href="#"><i class="fa fa-sort-desc decrease"></i></a>\
            </div>\
            <div class="details">\
                <a href="'+item.link+'">\
                    <img src="'+item.image+'" alt="'+item.name+'" class="img-responsive">\
                    <p>'+item.name+' <br> <small><span class="amount">'+item.price_per_unit*1+'</span> Tk</small></p>\
                </a>\
                <center><span class="amount">'+item.cart_amount+'</span> Tk</center>\
            </div>\
            <a href="#" class="remove remove-from-cart"><i class="fa fa-close"></i></a>\
        </li>\
        ');
        
      }
      
    } else{
      
      $('.shadow[p_id='+item.id+']').find('.product-cart-amount').addClass('hidden');
      
    }
  } else{
    
    $('.shadow[p_id='+item.id+']').find('.product-cart-amount').addClass('hidden');
    $('.cart-list[p_id='+item.id+']').remove();
    
  }
  
  
  $('.total-quantity').text(cart.calculation.quantity);
  $('.amount-total').text(cart.calculation.amount);
  
}

function calculate_cart(item)
{
  
  var quantity = 0;
  var amount = 0;
  
  if(cart.products.length > 0){
    var products = _.filter(cart.products, function(v){ return (v != null && v != undefined) ? v : false; });
    _.map(products, function(v){ amount += v.cart_amount * 1; });
    quantity = products.length;
  }
  
  cart.calculation.quantity = quantity;
  cart.calculation.amount = amount;
  
  update_cart(item);
  
}

function add_to_cart(item)
{

  var products = cart.products;

  if(item)
  {
  
    var product = {
      id: $(item).attr('p_id'),
      name: $(item).attr('p_name'),
      name_in_bangla : $(item).attr('p_name_in_bangla'),
      short_desc : $(item).attr('p_short_desc'),
      short_desc_in_bangla : $(item).attr('p_short_desc_in_bangla'),
      description : $(item).attr('p_description'),
      description_in_bangla : $(item).attr('p_description_in_bangla'),
      price : $(item).attr('p_price'),
      available_quantity : $(item).attr('p_available_quantity'),
      unit : $(item).attr('p_unit'),
      unit_in_bangla : $(item).attr('p_unit_in_bangla'),
      is_discounted : $(item).attr('p_is_discounted'),
      discount_rate : $(item).attr('p_discount_rate'),
      discounted_price : $(item).attr('p_discounted_price'),
      price_per_unit : $(item).attr('p_price_per_unit'),
      image : $(item).next('center').find('a img').attr('src'),
      link : $(item).find('.product-link').attr('href'),
      cart_quantity : 1,
      cart_amount : $(item).attr('p_price_per_unit'),
    };
    
    products[product.id] = (products[product.id]) ? products[product.id] : product;
  
  }

  cart.products = products;
  $.jStorage.set('cart', cart);

  calculate_cart(product);

}

function increment_cart(item_id)
{
  
  if(cart.products[item_id])
  {
    
    var item = cart.products[item_id];
    
    if(item.cart_quantity*1 < item.available_quantity*1)
    {
      
      item.cart_quantity  = item.cart_quantity*1 + 1;
      item.cart_amount    = item.cart_amount*1 + item.price_per_unit*1;
      
      cart.products[item_id] = item;
      
      calculate_cart(item);
      
    }
    
  }
  
}

function decrement_cart(item_id)
{
  
  if(cart.products[item_id])
  {
    
    var item = cart.products[item_id];
    
        item.cart_quantity  = item.cart_quantity*1 - 1;
        item.cart_amount    = item.cart_amount*1 - item.price_per_unit*1;
    
    if(item.cart_quantity > 0)
    {
      
      cart.products[item_id] = item;
      calculate_cart(item);
      
    } else{
      
      cart.products[item_id] = null;
      calculate_cart(item);
      
    }
    
  }
  
}

function remove_from_cart(item_id)
{
  
  if(cart.products[item_id])
  {
    
    var item = cart.products[item_id];
    
    cart.products[item_id] = null;
    calculate_cart(item);
    
  }
  
}

function cart_preview()
{
  
  var products = _.filter(cart.products, function(item){ return (item != null && item != undefined) ? item : false ; });
  if($('.cart-preview').length > 0 && products.length > 0)
  {
    
    $.each(products, function(i,v){
      $('.cart-preview').append('\
          <div class="col-xs-6 col-sm-4 col-md-3 products">\
            <div class="row item">\
                <div class="shadow" p_id="'+v.id+'" p_name="'+v.name+'" p_name_in_bangla="'+v.name_in_bangla+'" p_short_desc="'+v.short_desc+'" p_short_desc_in_bangla="'+v.short_desc_in_bangla+'" p_description="'+v.description+'" p_description_in_bangla="'+v.description_in_bangla+'" p_price="'+v.price+'" p_available_quantity="'+v.available_quantity+'" p_unit="'+v.unit+'" p_unit_in_bangla="'+v.unit_in_bangla+'" p_is_discounted="'+v.is_discounted+'" p_discount_rate="'+v.discount_rate+'" p_discounted_price="'+v.discounted_price+'" p_price_per_unit="'+v.price_per_unit+'" >\
                    <div class="col-xs-12">\
                        <p class="panel-body white-text summary nicescroll">\
                            '+v.short_desc+'\
                        </p>\
                        <p class="panel-body white-text product-cart-amount hidden">\
                            <span class="btn pull-left quantity-holder">\
                                <a class="increase"><i class="fa fa-sort-asc"></i></a><br>\
                                <span class="btn btn-xs quantity">'+v.cart_quantity+'</span><br>\
                                <a class="decrease"><i class="fa fa-sort-desc"></i></a>\
                            </span>\
                            <span class="btn pull-right amount-holder"><span class="amount">'+v.cart_amount+'</span> TK</span>\
                        </p>\
                    </div>\
                    <div class="col-xs-12 cart">\
                        <a href="" class="btn btn-info btn-sm product-link"><span class="fa fa-expand"></span> Details</a>\
                        <a class="btn btn-info btn-sm add-to-cart"><span class="fa fa-cart-plus"></span> Cart</a>\
                    </div>\
                </div>\
                <center>\
                    <a>\
                        <img data-src="'+v.image+'" alt="" class="img-responsive">\
                    </a>\
                </center>\
            </div>\
            <p class="details"><strong><a href="'+v.link+'">'+v.name+'</a></strong> <span class="pull-right">TK <br> <span class="price">'+v.price_per_unit+'</span></span></p>\
        </div>\
      ');
    });
    
  }
  
}


$(document).ready(function()
{
  
  cart_preview();
  
  /**
   * 
   * jQuery UI Range Slider
   * 
   */ 
  $( "#slider-range" ).slider({
    range: true,
    min: 30,
    max: 5000,
    values: [ 50, 4000 ],
    slide: function( event, ui ) {
      $( "#amount" ).val( "Tk " + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      $('[name=min]').val(ui.values[ 0 ]);
      $('[name=max]').val(ui.values[ 1 ]);
    }
  });
  
  $( "#amount" ).val( "Tk " + $( "#slider-range" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values", 1 ) );
  
  /**
   * 
   * jQuery UI Range Slider ends here
   * 
   */ 


  // Shadow on product thumbnails
  $('.shadow').parent().mouseenter(function(){
    $(this).find('.shadow').animate({'height': '97%'});
  }).mouseleave(function(){
    $(this).find('.shadow').animate({'height': '0'});
  });
  
  
  /** Cart area starts here **/
  
  $('.cart-list-group').height($(window).height() - $('.x-navigation.fixed.active').height() - $('.cart-right-sidebar > .btn').height() - 130);
  
  $(document).on({
    'click': function(e){
      e.preventDefault();
      $('.cart-right-sidebar, .cart-float').toggleClass('hidden');
    }
  }, '.cart-float, .cart-handle');
  
  cart_display_on_pageload();
  
  
  $(document).on({
    
    click: function(e){
      
      e.preventDefault();
      
      add_to_cart($(this).parents('.shadow'));
      
    }
    
  },'.add-to-cart');
  
  $(document).on({
    
    click: function(e){
      
      e.preventDefault();
      
      add_to_cart($(this));
      
    }
    
  },'.self-add-to-cart');
  
  
  $(document).on({
    
    click: function(e){
      
      e.preventDefault();
      
      increment_cart($(this).parents('[p_id]').attr('p_id'));
      
    }
    
  },'.increase');
  
  
  $(document).on({
    
    click: function(e){
      
      e.preventDefault();
      
      decrement_cart($(this).parents('[p_id]').attr('p_id'));
      
    }
    
  },'.decrease');
  
  
  $(document).on({
    
    click: function(e){
      
      e.preventDefault();
      
      remove_from_cart($(this).parents('[p_id]').attr('p_id'));
      
    }
    
  },'.remove-from-cart');
  
  
  if($('.products_at_checkout_page').length > 0)
  {
    $('.products_at_checkout_page').html("");
    
    if(cart.products.length > 0){
      var products = _.filter(cart.products, function(v){ return (v != null && v != undefined) ? v : false; });
      _.map(products, function(v){ amount += v.cart_amount * 1; });
      quantity = products.length;
      
      $.each(products, function(i,v){
        $('.products_at_checkout_page').append("\
        <input name='id[]' value='"+v.id+"' />\
        <input name='quantity[]' value='"+v.cart_quantity+"' />\
        ");
      });
      
      $('.products_at_checkout_page').append("\
        <input name='total_quantity' value='"+cart.calculation.quantity+"' />\
        <input name='total_amount' value='"+cart.calculation.amount+"' />\
      ");
    }
  }
  
  
  /**
   * 
   * Cart area ends here
   * 
   */

  
});