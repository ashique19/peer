function notify(body,title){
  $('#alert-message .mb-title').text(title);
  $('#alert-message .mb-content').text(body);
  $('#alert-message').addClass('open');
}


function initiate_search(){
  
  if($('.airport-search').length > 0){
	  $('.airport-search').select2({
	    ajax: {
        url: function (params) {
          return '/airport-search/' + params.term;
        },
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results: data
          };
        }
      }
	  });
	}
  
  if($('.user-search').length > 0){
	  $('.user-search').select2({
	    ajax: {
        url: function (params) {
          return '/admin/user-search/' + params.term;
        },
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results: data
          };
        }
      }
	  });
	}
  
}


function initiate_graphs(){
  
  	
	/* Signup Line chart */
	
	if( $('#user-signup-week-graph').length > 0 ){
	  
  	$.getJSON('/admin/user-signup-last-week').success(function(data){
      
      Morris.Bar({
        element: 'user-signup-week-graph',
        data: data,
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Sign up'],
        barColors: ['#3FBAE4'],
        gridTextSize: '10px',
        hideHover: true,
        resize: true,
        gridLineColor: '#E5E5E5'
      });
      /* END Bar dashboard chart */
      
  	});
	}
	
	if( $('#user-signup-month-graph').length > 0 ){
	  
  	$.getJSON('/admin/user-signup-last-month').success(function(data){
      
      Morris.Bar({
        element: 'user-signup-month-graph',
        data: data,
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Sign up'],
        barColors: ['#3FBAE4'],
        gridTextSize: '10px',
        hideHover: true,
        resize: true,
        gridLineColor: '#E5E5E5'
      });
      /* END Bar dashboard chart */
      
  	});
	}
	
	if( $('#user-signup-year-graph').length > 0 ){
	  
  	$.getJSON('/admin/user-signup-last-year').success(function(data){
      
      Morris.Bar({
        element: 'user-signup-year-graph',
        data: data,
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Sign up'],
        barColors: ['#3FBAE4'],
        gridTextSize: '10px',
        hideHover: true,
        resize: true,
        gridLineColor: '#E5E5E5'
      });
      /* END Bar dashboard chart */
      
  	});
	}
	
	
	
	if( $('#buys-year-graph').length > 0 ){
	  
  	$.getJSON('/admin/buys-year-graph').success(function(data){
      
      Morris.Bar({
        element: 'buys-year-graph',
        data: data,
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Buy Posts'],
        barColors: ['#3FBAE4'],
        gridTextSize: '10px',
        hideHover: true,
        resize: true,
        gridLineColor: '#E5E5E5'
      });
      /* END Bar dashboard chart */
      
  	});
	}
	
	
	
	if( $('#travel-year-graph').length > 0 ){
	  
  	$.getJSON('/admin/travel-year-graph').success(function(data){
      
      Morris.Bar({
        element: 'travel-year-graph',
        data: data,
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Buy Posts'],
        barColors: ['#3FBAE4'],
        gridTextSize: '10px',
        hideHover: true,
        resize: true,
        gridLineColor: '#E5E5E5'
      });
      /* END Bar dashboard chart */
      
  	});
	}
	
	
	/* Orders bar chart */
	
	if( $('#offers-week-graph').length > 0 ){
	  
  	$.getJSON('/admin/offers-last-week').success(function(data){
  	  
  	  Morris.Line({
        element: 'offers-week-graph',
        data: data,
          xkey: 'y',
          ykeys: ['a'],
          labels: ['Offers'],
          resize: true,
          hideHover: true,
          xLabels: 'day',
          gridTextSize: '10px',
          lineColors: ['#3FBAE4'],
          gridLineColor: '#E5E5E5'
      });  
      
      
  	});
  	
	}
	
	if( $('#offers-month-graph').length > 0 ){
	  
  	$.getJSON('/admin/offers-last-month').success(function(data){
  	  
  	  Morris.Line({
        element: 'offers-month-graph',
        data: data,
          xkey: 'y',
          ykeys: ['a'],
          labels: ['Offers'],
          resize: true,
          hideHover: true,
          xLabels: 'day',
          gridTextSize: '10px',
          lineColors: ['#3FBAE4'],
          gridLineColor: '#E5E5E5'
      });  
      
      
  	});
  	
	}
	
	if( $('#chat-month-graph').length > 0 ){
	  
  	$.getJSON('/admin/chat-last-month').success(function(data){
  	  
  	  Morris.Line({
        element: 'chat-month-graph',
        data: data,
          xkey: 'y',
          ykeys: ['a'],
          labels: ['Chats'],
          resize: true,
          hideHover: true,
          xLabels: 'day',
          gridTextSize: '10px',
          lineColors: ['#3FBAE4'],
          gridLineColor: '#E5E5E5'
      });  
      
      
  	});
  	
	}
	
	
	if( $('#users-by-country').length > 0 ){
	  
	  $.getJSON('/admin/user-by-country').success(function(data){
	  
  	  Morris.Line({
        element: 'users-by-country',
        data: data.data,
        xkey: 'y',
        ykeys: data.countries,
        labels: data.countries,
        resize: true,
        hideHover: true,
        xLabels: 'day',
        gridTextSize: '10px',
        lineColors: data.colors,
        gridLineColor: '#E5E5E5'
      });
      
	  });
	  
	}
	
	
	if( $('#travel-by-country').length > 0 ){
	  
	  $.getJSON('/admin/travel-by-country').success(function(data){
	  
  	  Morris.Line({
        element: 'travel-by-country',
        data: data.data,
        xkey: 'y',
        ykeys: data.countries,
        labels: data.countries,
        resize: true,
        hideHover: true,
        xLabels: 'day',
        gridTextSize: '10px',
        lineColors: data.colors,
        gridLineColor: '#E5E5E5'
      });
      
	  });
	  
	}
	
	
	if( $('#buy-by-country').length > 0 ){
	  
	  $.getJSON('/admin/buy-by-country').success(function(data){
	  
  	  Morris.Line({
        element: 'buy-by-country',
        data: data.data,
        xkey: 'y',
        ykeys: data.countries,
        labels: data.countries,
        resize: true,
        hideHover: true,
        xLabels: 'day',
        gridTextSize: '10px',
        lineColors: data.colors,
        gridLineColor: '#E5E5E5'
      });
      
	  });
	  
	}
	
  
}


function get_shipping_rate_for_admin(e){
  
  e.preventDefault();
  
  var form = $(this).parents('form');
  
  $('.shipping-rate-list').html('Fetching rates...');
  
  $.post('/admin/get-shipping-rate', form.serializeArray(), function(data){
    
    $('.shipping-rate-list').empty();
    
    if(data.rates){
      
      $('.shipping-rate-list').html('Click on a rate to apply.');
      
      data.rates.forEach(function(v){
        $('.shipping-rate-list').append('<a href="#" class="btn btn-info btn-block push-up-10 shipping-rate-item" shipping-value="'+v.totalCarrierCharge+'">'+v.totalCarrierCharge+' ('+v.serviceId+')</a>');
      });
      
    } else{
      
      $('.shipping-rate-list').text('No rate was found. Please check parameters.');
      
    }
    
  });
  
}

$(document).ready(function()
{
  
  $('li:has(a[href="'+window.location.href+'"]), a[href="'+window.location.href+'"]').addClass('active');
  
  if($("#vector_world_map").length > 0){
    var jvm_wm = new jvm.WorldMap({container: $('#vector_world_map'),
                                  map: 'world_mill_en', 
                                  backgroundColor: '#B3D1FF',                                      
                                  regionsSelectable: true,
                                  regionStyle: {selected: {fill: '#33414E'},
                                                  initial: {fill: '#FFFFFF'}},
                                  onRegionSelected: function(){
                                      $("#vector_world_map_value").val(jvm_wm.getSelectedRegions().toString());                                          
                                  }
                                  });
  }
  
  $('.summernote').summernote({
    height: 300,                 // set editor height
  
    minHeight: 200,             // set minimum height of editor
    maxHeight: null,             // set maximum height of editor
  
    focus: true,                 // set focus to editable area after initializing summernote
  });
  
  Dropzone.options.productImageEdit = {
    paramName: "product_photos", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
  };
  
  Dropzone.options.categoryImageEdit = {
    paramName: "category_photos", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
  };
  
  $('form').validator();
  
  $('.datepicker').datepicker();
  
  $(".file").fileinput();
  
  $('.selectpicker, .select2').prepend('<option value="">-Select-</option>').select2({allowClear: true});
  
  initiate_search();
	
	initiate_graphs();
	
	
	$('.save-order-log').submit(function(e){
	  e.preventDefault();
	  
	  var form = $(this);
	  form.find('.message').text('saving...');
	  
	  $.post( form.attr('action'), form.serializeArray(), function(data){
	    if(data*1 != 2){
	      form.find('.message').text('Data has been saved.');
	      
	      $('.order-logs').append('\
	        <div class="col-xs-12 no-padding push-up-10">\
            <p>\
                <span class="pull-right small darkGray-text">'+data.created_by+' | '+data.created_at+'</span>\
                <span class="blue-text">'+data.name+'</span>\
            </p>\
            <p>'+data.detail+'</p>\
          </div>\
	      ');
	      
	    } else{
	      form.find('.message').text('Failed to save data. Please retry..');
	    }
	  });
	  
	});
	
	$('.get-shipping-rates').click(get_shipping_rate_for_admin);

  $(document).on({
    click: function(e){
      e.preventDefault();
      $('[name=rates_totalCarrierCharge]').val( $(this).attr('shipping-value') );
    }
  },'.shipping-rate-item');
  
  
  $(document).on({
    submit: function(e){
      e.preventDefault();
      
      var form = $(this);
      
      form.find('.message').text('Updating status...');
      
      $.post(form.attr('action'), form.serializeArray(), function(data){
        
        if( data * 1 == 1 ){
          form.find('.message').text('Status has been changed successfully.');
        } else{
          form.find('.message').text('Failed to modify status.');
        }
        
      });
      
    }
  }, '.change-order-log');
	
});