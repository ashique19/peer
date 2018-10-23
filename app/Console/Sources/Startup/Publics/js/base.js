
function notify(body,title){
  $('#alert-message .mb-title').text(title);
  $('#alert-message .mb-content').text(body);
  $('#alert-message').addClass('open');
}


$(document).ready(function()
{
  
  //$('li:has(a[href="'+window.location.href+'"]), a[href="'+window.location.href+'"]').addClass('active');
  
  // Nice Scroll Area
  
  $('.nicescroll').niceScroll({cursorwidth: "10px", cursorcolor: "#ed217c", cursoropacitymin: 0.5, cursoropacitymax: 1, horizrailenabled: false,});
  $('.nicescroll-x').niceScroll({cursorwidth: "10px", cursorcolor: "#ed217c", cursoropacitymin: 0.5, cursoropacitymax: 1, horizrailenabled: true,});
  //$('.nicescroll, .nicescroll-x').getNiceScroll().resize();
  

  
});