function notify(body,title){
  $('#alert-message .mb-title').text(title);
  $('#alert-message .mb-content').text(body);
  $('#alert-message').addClass('open');
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
	
});