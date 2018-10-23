$(document).ready(function () {
    $('#sidebar-header, #hidden-search-icon').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    // Slider range for price
    // $("#ex16b").slider({ min: 0, max: 1000, value: [0, 1000], focus: true });


    // Grid system view
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});

// if( typeof detailsRoute !== 'undefined') {
    // Product search
    $("#custom-search-form").on('click', '#search-btn-link', function(e) {
       e.preventDefault();
       var searchKey = $("#search-box").val();
       if (! searchKey) {
           console.log('Please insert search key');
           return false;
       }
       if( typeof detailsRoute === 'undefined') {
           window.location.href = ROOT_URL + "products?q=" + searchKey;
       }

       $.ajax({
          url: ROOT_URL + "products/search/ebay",
          data:{q:searchKey},
          beforeSend: function( xhr ) {
            // xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
          }
        })
          .done(function( data ) {
            var products = JSON.parse(data), productsDiv = '',
                rating = '<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star-empty"></span>',
                img, productContainer = $('#products'), column = 0, discount;

            console.log(products.data);
            if(products.status == 200) {

                productContainer.html('');
                $.each(products.data, function(key, product) {

                   img = (product.image) ? product.image : DEFAULT_IMAGE;

                    detailsUrl = detailsRoute + '?id='+product.id+'&title='+product.title + '&price='+' ' +product.price+'&currency='+product.currency+'&image=' + img + '&url='+product.url+'&category=' + product.category;
                    detailsUrl = encodeURI(detailsUrl);

                    if(column == 0)  {
                        productsDiv += '<div class="row">';

                    }
                    discount = Math.floor((Math.random() * 10) + 1);
                    productsDiv += '<div class="item col-xs-3 col-lg-3"><div class="thumbnail"><a href="#" class="btn btn-danger discount">-'+discount+'%</a><img class="group list-group-image" src="'+img+'" alt="" /><a href="'+product.url+'" target="_blank"><img class="group hover-icon-eye" src="'+ROOT_URL + ASSET_DIR+'details.svg" alt="" /></a><img class="group hover-icon-cart hidden" src="'+ROOT_URL + ASSET_DIR+'add_to_cart.svg" alt="" />' +
                        '<div class="caption"><h4 class="group inner list-group-item-heading"><a class="product-link" href="'+detailsUrl+'" >'+product.title+'</a></h4>' +
                        '<p class="group inner list-group-item-text">'+product.category+'</p>' +
                        '<div class="row"><div class="col-xs-12 col-md-10"><p class="lead amount">'+product.currency+' <b>' +product.price+'</b></p></div>' +
                        '<div class="col-xs-12 col-md-2"></div></div></div></div></div>';


                    if(column === 3) {
                        productsDiv += '</div>';
                        column = 0;
                    }else {
                        column++;
                    }
                });

                // Append all product
                productContainer.html(productsDiv);
                $("#no-of-product").html(products.data.length);
            } else {
                console.log('Products not found');
            }
          });
    });
    if( typeof detailsRoute !== 'undefined') {
        $("#search-btn-link").trigger('click');

    }

// }


    // $("#content").on('click', '.product-link', function(e){
    // 	e.preventDefault();
    // 	console.log(e)
    // });
});
