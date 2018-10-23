$(function() {

    var formElements = function(){                
        // Bootstrap datepicker
        var feDatepicker = function(){                        
            if($(".datepicker").length > 0){
                $(".datepicker").datepicker({dateFormat: "yy-mm-dd"});                
                $("#dp-2,#dp-3,#dp-4").datepicker(); // Sample
            }           
            
        }// END Bootstrap datepicker
        
        //Bootstrap timepicker
        var feTimepicker = function(){
            // Default timepicker
            if($(".timepicker").length > 0)
                $('.timepicker').timepicker();
            
            // 24 hours mode timepicker
            if($(".timepicker24").length > 0)
                $(".timepicker24").timepicker({minuteStep: 5,showSeconds: true,showMeridian: false});
            
        }// END Bootstrap timepicker
        
        //Daterangepicker 
        var feDaterangepicker = function(){
            if($(".daterange").length > 0)
               $(".daterange").daterangepicker({format: 'YYYY-MM-DD',startDate: '2013-01-01',endDate: '2013-12-31'});
        }
        // END Daterangepicker
        
        //Bootstrap colopicker        
        var feColorpicker = function(){
            // Default colorpicker hex
            if($(".colorpicker").length > 0)
                $(".colorpicker").colorpicker({format: 'hex'});
            
            // RGBA mode
            if($(".colorpicker_rgba").length > 0)
                $(".colorpicker_rgba").colorpicker({format: 'rgba'});
            
            // Sample
            if($("#colorpicker").length > 0)
                $("#colorpicker").colorpicker();
            
        }// END Bootstrap colorpicker
        
        //Bootstrap select
        var feSelect = function(){
            if($(".select").length > 0){
                $(".select").selectpicker();
                
                $(".select").on("change", function(){
                    if($(this).val() == "" || null === $(this).val()){
                        if(!$(this).attr("multiple"))
                            $(this).val("").find("option").removeAttr("selected").prop("selected",false);
                    }else{
                        $(this).find("option[value="+$(this).val()+"]").attr("selected",true);
                    }
                });
            }
        }//END Bootstrap select
        
        
        //Validation Engine
        var feValidation = function(){
            if($("form[id^='validate']").length > 0){
                
                // Validation prefix for custom form elements
                var prefix = "valPref_";
                
                //Add prefix to Bootstrap select plugin
                $("form[id^='validate'] .select").each(function(){
                   $(this).next("div.bootstrap-select").attr("id", prefix + $(this).attr("id")).removeClass("validate[required]");
                });
                
                // Validation Engine init
                $("form[id^='validate']").validationEngine('attach', {promptPosition : "bottomLeft", scroll: false,
                                                                        onValidationComplete: function(form, status){
                                                                            form.validationEngine("updatePromptsPosition");
                                                                        },
                                                                        prettySelect : true,
                                                                        usePrefix: prefix 
                                                                     });              
            }
        }//END Validation Engine
        
        //Masked Inputs
        var feMasked = function(){            
            if($("input[class^='mask_']").length > 0){
                $("input.mask_tin").mask('99-9999999');
                $("input.mask_ssn").mask('999-99-9999');        
                $("input.mask_date").mask('9999-99-99');
                $("input.mask_product").mask('a*-999-a999');
                $("input.mask_phone").mask('99 (999) 999-99-99');
                $("input.mask_phone_ext").mask('99 (999) 999-9999? x99999');
                $("input.mask_credit").mask('9999-9999-9999-9999');        
                $("input.mask_percent").mask('99%');
            }            
        }//END Masked Inputs
        
        //Bootstrap tooltip
        var feTooltips = function(){            
            $("body").tooltip({selector:'[data-toggle="tooltip"]',container:"body"});
        }//END Bootstrap tooltip
       
        //Bootstrap Popover
        var fePopover = function(){            
            $("[data-toggle=popover]").popover({ html: true, container: 'body' });
            $(".popover-dismiss").popover({trigger: 'focus'});
        }//END Bootstrap Popover
        
        //Tagsinput
        var feTagsinput = function(){
            if($(".tagsinput").length > 0){
                
                $(".tagsinput").each(function(){
                    
                    if($(this).data("placeholder") != ''){
                        var dt = $(this).data("placeholder");
                    }else
                        var dt = 'add a tag';
                                                            
                    $(this).tagsInput({width: '100%',height:'auto',defaultText: dt});
                });

            }
        }// END Tagsinput
        
        //iCheckbox and iRadion - custom elements
        var feiCheckbox = function(){
            if($(".icheckbox").length > 0){
                 $(".icheckbox,.iradio").iCheck({checkboxClass: 'icheckbox_minimal-grey',radioClass: 'iradio_minimal-grey'});
            }
        }
        // END iCheckbox
        
        //Bootstrap file input
        var feBsFileInput = function(){
            
            if($("input.fileinput").length > 0)
                $("input.fileinput").bootstrapFileInput();
            
        }
        //END Bootstrap file input
        
        return {// Init all form element features
		init: function(){                    
                    feDatepicker();                    
                    feTimepicker();
                    feColorpicker();
                    feSelect();
                    feValidation();
                    feMasked();
                    feTooltips();
                    fePopover();
                    feTagsinput();
                    feiCheckbox();
                    feBsFileInput();
                    feDaterangepicker();
                }
        }
    }();

    var uiElements = function(){

        //Datatables
        var uiDatatable = function(){
            if($(".datatable").length > 0){                
                $(".datatable").dataTable();
                $(".datatable").on('page.dt',function () {
                    onresize(100);
                });
            }
            
            if($(".datatable_simple").length > 0){                
                $(".datatable_simple").dataTable({"ordering": false, "info": false, "lengthChange": false,"searching": false});
                $(".datatable_simple").on('page.dt',function () {
                    onresize(100);
                });                
            }            
        }//END Datatable        
        
        //RangeSlider // This function can be removed or cleared.
        var uiRangeSlider = function(){
            
            //Default Slider with start value
            if($(".defaultSlider").length > 0){                
                $(".defaultSlider").each(function(){                    
                    var rsMin = $(this).data("min");
                    var rsMax = $(this).data("max");

                    $(this).rangeSlider({                        
                        bounds: {min: 1, max: 200},
                        defaultValues: {min: rsMin, max: rsMax}
                    });                    
                });                                
            }//End Default
            
            //Date range slider
            if($(".dateSlider").length > 0){                
                $(".dateSlider").each(function(){
                    $(this).dateRangeSlider({
                        bounds: {min: new Date(2012, 1, 1), max: new Date(2015, 12, 31)},
                        defaultValues:{min: new Date(2012, 10, 15),max: new Date(2014, 12, 15)}
                    });
                });                                                
            }//End date range slider
            
            //Range slider with predefinde range            
            if($(".rangeSlider").length > 0){                
                $(".rangeSlider").each(function(){                    
                    var rsMin = $(this).data("min");
                    var rsMax = $(this).data("max");

                    $(this).rangeSlider({
                        bounds: {min: 1, max: 200},
                        range: {min: 20, max: 40},
                        defaultValues: {min: rsMin, max: rsMax}
                    });                    
                });                                
            }//End
            
            //Range Slider with custom step
            if($(".stepSlider").length > 0){                
                $(".stepSlider").each(function(){
                    var rsMin = $(this).data("min");
                    var rsMax = $(this).data("max");

                    $(this).rangeSlider({                        
                        bounds: {min: 1, max: 200},
                        defaultValues: {min: rsMin, max: rsMax},
                        step: 10
                    });    
                });                                                
            }//End
            
        }//END RangeSlider
        
        //Start Knob Plugin
        var uiKnob = function(){
            
            if($(".knob").length > 0){
                $(".knob").knob();
            }            
            
        }//End Knob
        
        // Start Smart Wizard
        var uiSmartWizard = function(){
            
            if($(".wizard").length > 0){
                
                //Check count of steps in each wizard
                $(".wizard > ul").each(function(){
                    $(this).addClass("steps_"+$(this).children("li").length);
                });//end
                
                // This par of code used for example
                if($("#wizard-validation").length > 0){
                    
                    var validator = $("#wizard-validation").validate({
                            rules: {
                                login: {
                                    required: true,
                                    minlength: 2,
                                    maxlength: 8
                                },
                                password: {
                                    required: true,
                                    minlength: 5,
                                    maxlength: 10
                                },
                                repassword: {
                                    required: true,
                                    minlength: 5,
                                    maxlength: 10,
                                    equalTo: "#password"
                                },
                                email: {
                                    required: true,
                                    email: true
                                },
                                name: {
                                    required: true,
                                    maxlength: 10
                                },
                                adress: {
                                    required: true
                                }
                            }
                        });
                        
                }// End of example
                
                $(".wizard").smartWizard({                        
                    // This part of code can be removed FROM
                    onLeaveStep: function(obj){
                        var wizard = obj.parents(".wizard");

                        if(wizard.hasClass("wizard-validation")){
                            
                            var valid = true;
                            
                            $('input,textarea',$(obj.attr("href"))).each(function(i,v){
                                valid = validator.element(v) && valid;
                            });
                                                        
                            if(!valid){
                                wizard.find(".stepContainer").removeAttr("style");
                                validator.focusInvalid();                                
                                return false;
                            }         
                            
                        }    
                        
                        return true;
                    },// <-- TO
                    
                    //This is important part of wizard init
                    onShowStep: function(obj){                        
                        var wizard = obj.parents(".wizard");

                        if(wizard.hasClass("show-submit")){
                        
                            var step_num = obj.attr('rel');
                            var step_max = obj.parents(".anchor").find("li").length;

                            if(step_num == step_max){                             
                                obj.parents(".wizard").find(".actionBar .btn-primary").css("display","block");
                            }                         
                        }
                        return true;                         
                    }//End
                });
            }            
            
        }// End Smart Wizard
        
        //OWL Carousel
        var uiOwlCarousel = function(){
            
            if($(".owl-carousel").length > 0){
                $(".owl-carousel").owlCarousel({mouseDrag: false, touchDrag: true, slideSpeed: 300, paginationSpeed: 400, singleItem: true, navigation: false,autoPlay: true});
            }
            
        }//End OWL Carousel
        
        // Summernote 
        var uiSummernote = function(){
            /* Extended summernote editor */
            if($(".summernote").length > 0){
                $(".summernote").summernote({height: 250,
                                             codemirror: {
                                                mode: 'text/html',
                                                htmlMode: true,
                                                lineNumbers: true,
                                                theme: 'default'
                                              }
                });
            }
            /* END Extended summernote editor */
            
            /* Lite summernote editor */
            if($(".summernote_lite").length > 0){
                
                $(".summernote_lite").on("focus",function(){
                    
                    $(".summernote_lite").summernote({height: 100, focus: true,
                                                      toolbar: [
                                                          ["style", ["bold", "italic", "underline", "clear"]],
                                                          ["insert",["link","picture","video"]]                                                          
                                                      ]
                                                     });
                });                
            }
            /* END Lite summernote editor */
            
            /* Email summernote editor */
            if($(".summernote_email").length > 0){
                                                    
                $(".summernote_email").summernote({height: 400, focus: true,
                                                  toolbar: [
                                                      ['style', ['bold', 'italic', 'underline', 'clear']],
                                                      ['font', ['strikethrough']],
                                                      ['fontsize', ['fontsize']],
                                                      ['color', ['color']],
                                                      ['para', ['ul', 'ol', 'paragraph']],
                                                      ['height', ['height']]                                                          
                                                  ]
                                                 });
                
            }
            /* END Email summernote editor */
            
        }// END Summernote 
        
        // Custom Content Scroller
        var uiScroller = function(){
            
            if($(".scroll").length > 0){
                $(".scroll").niceScroll();
            }
            
        }// END Custom Content Scroller
       
        // Sparkline
        var uiSparkline = function(){
            
            if($(".sparkline").length > 0)
               $(".sparkline").sparkline('html', { enableTagOptions: true,disableHiddenCheck: true});   
           
       }// End sparkline              
       
        $(window).resize(function(){
            if($(".owl-carousel").length > 0){
                $(".owl-carousel").data('owlCarousel').destroy();
                uiOwlCarousel();
            }
        });
       
        return {
            init: function(){
                uiDatatable();
                uiRangeSlider();
                uiKnob();
                uiSmartWizard();
                uiOwlCarousel();
                uiSummernote();
                uiScroller();
                uiSparkline();
            }
        }
        
    }();

    var templatePlugins = function(){
        
        var tp_clock = function(){
            
            function tp_clock_time(){
                var now     = new Date();
                var hour    = now.getHours();
                var minutes = now.getMinutes();                    
                
                hour = hour < 10 ? '0'+hour : hour;
                minutes = minutes < 10 ? '0'+minutes : minutes;
                
                $(".plugin-clock").html(hour+"<span>:</span>"+minutes);
            }
            if($(".plugin-clock").length > 0){
                
                tp_clock_time();
                
                window.setInterval(function(){
                    tp_clock_time();                    
                },10000);
                
            }
        }
        
        var tp_date = function(){
            
            if($(".plugin-date").length > 0){
                
                var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                        
                var now     = new Date();
                var day     = days[now.getDay()];
                var date    = now.getDate();
                var month   = months[now.getMonth()];
                var year    = now.getFullYear();
                
                $(".plugin-date").html(day+", "+month+" "+date+", "+year);
            }
            
        }
        
        return {
            init: function(){
                tp_clock();
                tp_date();
            }
        }
    }();
    
    var fullCalendar = function(){
            
        var calendar = function(){
            
            if($("#calendar").length > 0){
                
                function prepare_external_list(){
                    
                    $('#external-events .external-event').each(function() {
                            var eventObject = {title: $.trim($(this).text())};

                            $(this).data('eventObject', eventObject);
                            $(this).draggable({
                                    zIndex: 999,
                                    revert: true,
                                    revertDuration: 0
                            });
                    });                    
                    
                }
                
                
                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                prepare_external_list();

                var calendar = $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    editable: true,
                    eventSources: {url: "assets/ajax_fullcalendar.php"},
                    droppable: true,
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end, allDay) {
                        var title = prompt('Event Title:');
                        if (title) {
                            calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },
                            true
                            );
                        }
                        calendar.fullCalendar('unselect');
                    },
                    drop: function(date, allDay) {

                        var originalEventObject = $(this).data('eventObject');

                        var copiedEventObject = $.extend({}, originalEventObject);

                        copiedEventObject.start = date;
                        copiedEventObject.allDay = allDay;

                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);


                        if ($('#drop-remove').is(':checked')) {
                            $(this).remove();
                        }

                    }
                });
                
                $("#new-event").on("click",function(){
                    var et = $("#new-event-text").val();
                    if(et != ''){
                        $("#external-events").prepend('<a class="list-group-item external-event">'+et+'</a>');
                        prepare_external_list();
                    }
                });
                
            }            
        }
        
        return {
            init: function(){
                calendar();
            }
        }
    }();
    
    formElements.init();
    uiElements.init();
    templatePlugins.init();    
    
    fullCalendar.init();
    
    /* My Custom Progressbar */
    $.mpb = function(action,options){

        var settings = $.extend({
            state: '',            
            value: [0,0],
            position: '',
            speed: 20,
            complete: null
        },options);

        if(action == 'show' || action == 'update'){
            
            if(action == 'show'){
                $(".mpb").remove();
                var mpb = '<div class="mpb '+settings.position+'">\n\
                               <div class="mpb-progress'+(settings.state != '' ? ' mpb-'+settings.state: '')+'" style="width:'+settings.value[0]+'%;"></div>\n\
                           </div>';
                $('body').append(mpb);
            }
            
            var i  = $.isArray(settings.value) ? settings.value[0] : $(".mpb .mpb-progress").width();
            var to = $.isArray(settings.value) ? settings.value[1] : settings.value;            
            
            var timer = setInterval(function(){
                $(".mpb .mpb-progress").css('width',i+'%'); i++;
                
                if(i > to){
                    clearInterval(timer);
                    if($.isFunction(settings.complete)){
                        settings.complete.call(this);
                    }
                }
            }, settings.speed);

        }

        if(action == 'destroy'){
            $(".mpb").remove();
        }                
        
    }
    /* Eof My Custom Progressbar */
    
    
    // New selector case insensivity        
     $.expr[':'].containsi = function(a, i, m) {
         return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
     };              
});

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
$(document).ready(function(){        
    
    /* PROGGRESS START */
    $.mpb("show",{value: [0,50],speed: 5});        
    /* END PROGGRESS START */
    
    var html_click_avail = true;
    
    $("html").on("click", function(){
        if(html_click_avail)
            $(".x-navigation-horizontal li,.x-navigation-minimized li").removeClass('active');        
    });        
    
    $(".x-navigation-horizontal .panel").on("click",function(e){
        e.stopPropagation();
    });    
    
    /* WIDGETS (DEMO)*/
    $(".widget-remove").on("click",function(){
        $(this).parents(".widget").fadeOut(400,function(){
            $(this).remove();
            $("body > .tooltip").remove();
        });
        return false;
    });
    /* END WIDGETS */
    
    /* Gallery Items */
    $(".gallery-item .iCheck-helper").on("click",function(){
        var wr = $(this).parent("div");
        if(wr.hasClass("checked")){
            $(this).parents(".gallery-item").addClass("active");
        }else{            
            $(this).parents(".gallery-item").removeClass("active");
        }
    });
    $(".gallery-item-remove").on("click",function(){
        $(this).parents(".gallery-item").fadeOut(400,function(){
            $(this).remove();
        });
        return false;
    });
    $("#gallery-toggle-items").on("click",function(){
        
        $(".gallery-item").each(function(){
            
            var wr = $(this).find(".iCheck-helper").parent("div");
            
            if(wr.hasClass("checked")){
                $(this).removeClass("active");
                wr.removeClass("checked");
                wr.find("input").prop("checked",false);
            }else{            
                $(this).addClass("active");
                wr.addClass("checked");
                wr.find("input").prop("checked",true);
            }
            
        });
        
    });
    /* END Gallery Items */

    // XN PANEL DRAGGING
    $( ".xn-panel-dragging" ).draggable({
        containment: ".page-content", handle: ".panel-heading", scroll: false,
        start: function(event,ui){
            html_click_avail = false;
            $(this).addClass("dragged");
        },
        stop: function( event, ui ) {
            $(this).resizable({
                maxHeight: 400,
                maxWidth: 600,
                minHeight: 200,
                minWidth: 200,
                helper: "resizable-helper",
                start: function( event, ui ) {
                    html_click_avail = false;
                },
                stop: function( event, ui ) {
                    $(this).find(".panel-body").height(ui.size.height - 82);
                    $(this).find(".scroll").mCustomScrollbar("update");
                                            
                    setTimeout(function(){
                        html_click_avail = true; 
                    },1000);
                                            
                }
            })
            
            setTimeout(function(){
                html_click_avail = true; 
            },1000);            
        }
    });
    // END XN PANEL DRAGGING
    
    /* DROPDOWN TOGGLE */
    $(".dropdown-toggle").on("click",function(){
        onresize();
    });
    /* DROPDOWN TOGGLE */
    
    /* MESSAGE BOX */
    $(".mb-control").on("click",function(){
        var box = $($(this).data("box"));
        if(box.length > 0){
            box.toggleClass("open");
            
            var sound = box.data("sound");
            
            if(sound === 'alert')
                playAudio('alert');
            
            if(sound === 'fail')
                playAudio('fail');
            
        }        
        return false;
    });
    $(".mb-control-close").on("click",function(){
       $(this).parents(".message-box").removeClass("open");
       return false;
    });    
    /* END MESSAGE BOX */
    
    /* CONTENT FRAME */
    $(".content-frame-left-toggle").on("click",function(){
        $(".content-frame-left").is(":visible") 
        ? $(".content-frame-left").hide() 
        : $(".content-frame-left").show();
        page_content_onresize();
    });
    $(".content-frame-right-toggle").on("click",function(){
        $(".content-frame-right").is(":visible") 
        ? $(".content-frame-right").hide() 
        : $(".content-frame-right").show();
        page_content_onresize();
    });    
    /* END CONTENT FRAME */
    
    /* MAILBOX */
    $(".mail .mail-star").on("click",function(){
        $(this).toggleClass("starred");
    });
    
    $(".mail-checkall .iCheck-helper").on("click",function(){
        
        var prop = $(this).prev("input").prop("checked");
                    
        $(".mail .mail-item").each(function(){            
            var cl = $(this).find(".mail-checkbox > div");            
            cl.toggleClass("checked",prop).find("input").prop("checked",prop);                        
        }); 
        
    });
    /* END MAILBOX */
    
    /* PANELS */
    
    $(".panel-fullscreen").on("click",function(){
        panel_fullscreen($(this).parents(".panel"));
        return false;
    });
    
    $(".panel-collapse").on("click",function(){
        panel_collapse($(this).parents(".panel"));
        $(this).parents(".dropdown").removeClass("open");
        return false;
    });    
    $(".panel-remove").on("click",function(){
        panel_remove($(this).parents(".panel"));
        $(this).parents(".dropdown").removeClass("open");
        return false;
    });
    $(".panel-refresh").on("click",function(){
        var panel = $(this).parents(".panel");
        panel_refresh(panel);

        setTimeout(function(){
            panel_refresh(panel);
        },3000);
        
        $(this).parents(".dropdown").removeClass("open");
        return false;
    });
    /* EOF PANELS */
    
    /* ACCORDION */
    $(".accordion .panel-title a").on("click",function(){
        
        var blockOpen = $(this).attr("href");
        var accordion = $(this).parents(".accordion");        
        var noCollapse = accordion.hasClass("accordion-dc");
        
        
        if($(blockOpen).length > 0){            
            
            if($(blockOpen).hasClass("panel-body-open")){
                $(blockOpen).slideUp(200,function(){
                    $(this).removeClass("panel-body-open");
                });
            }else{
                $(blockOpen).slideDown(200,function(){
                    $(this).addClass("panel-body-open");
                });
            }
            
            if(!noCollapse){
                accordion.find(".panel-body-open").not(blockOpen).slideUp(200,function(){
                    $(this).removeClass("panel-body-open");
                });                                           
            }
            
            return false;
        }
        
    });
    /* EOF ACCORDION */
    
    /* DATATABLES/CONTENT HEIGHT FIX */
    $(".dataTables_length select").on("change",function(){
        onresize();
    });
    /* END DATATABLES/CONTENT HEIGHT FIX */
    
    /* TOGGLE FUNCTION */
    $(".toggle").on("click",function(){
        var elm = $("#"+$(this).data("toggle"));
        if(elm.is(":visible"))
            elm.addClass("hidden").removeClass("show");
        else
            elm.addClass("show").removeClass("hidden");
        
        return false;
    });
    /* END TOGGLE FUNCTION */
    
    /* MESSAGES LOADING */
    $(".messages .item").each(function(index){
        var elm = $(this);
        setInterval(function(){
            elm.addClass("item-visible");
        },index*300);              
    });
    /* END MESSAGES LOADING */
    
    x_navigation();
});

$(function(){            
    onload();

    /* PROGGRESS COMPLETE */
    $.mpb("update",{value: 100, speed: 5, complete: function(){            
        $(".mpb").fadeOut(200,function(){
            $(this).remove();
        });
    }});
    /* END PROGGRESS COMPLETE */
});

$(window).resize(function(){
    x_navigation_onresize();
    page_content_onresize();
});

function onload(){
    x_navigation_onresize();    
    page_content_onresize();
}

function page_content_onresize(){
    $(".page-content,.content-frame-body,.content-frame-right,.content-frame-left").css("width","").css("height","");
    
    var content_minus = 0;
    content_minus = ($(".page-container-boxed").length > 0) ? 40 : content_minus;
    content_minus += ($(".page-navigation-top-fixed").length > 0) ? 50 : 0;
    
    var content = $(".page-content");
    var sidebar = $(".page-sidebar");
    
    if(content.height() < $(document).height() - content_minus){        
        content.height($(document).height() - content_minus);
    }        
    
    if(sidebar.height() > content.height()){        
        content.height(sidebar.height());
    }
    
    if($(window).width() > 1024){
        
        if($(".page-sidebar").hasClass("scroll")){
            if($("body").hasClass("page-container-boxed")){
                var doc_height = $(document).height() - 40;
            }else{
                var doc_height = $(window).height();
            }
           $(".page-sidebar").height(doc_height);
           
       }
       
        if($(".content-frame-body").height() < $(document).height()-162){
            $(".content-frame-body,.content-frame-right,.content-frame-left").height($(document).height()-162);            
        }else{
            $(".content-frame-right,.content-frame-left").height($(".content-frame-body").height());
        }
        
        $(".content-frame-left").show();
        $(".content-frame-right").show();
    }else{
        $(".content-frame-body").height($(".content-frame").height()-80);
        
        if($(".page-sidebar").hasClass("scroll"))
           $(".page-sidebar").css("height","");
    }
    
    if($(window).width() < 1200){
        if($("body").hasClass("page-container-boxed")){
            $("body").removeClass("page-container-boxed").data("boxed","1");
        }
    }else{
        if($("body").data("boxed") === "1"){
            $("body").addClass("page-container-boxed").data("boxed","");
        }
    }
}

/* PANEL FUNCTIONS */
function panel_fullscreen(panel){    
    
    if(panel.hasClass("panel-fullscreened")){
        panel.removeClass("panel-fullscreened").unwrap();
        panel.find(".panel-body,.chart-holder").css("height","");
        panel.find(".panel-fullscreen .fa").removeClass("fa-compress").addClass("fa-expand");        
        
        $(window).resize();
    }else{
        var head    = panel.find(".panel-heading");
        var body    = panel.find(".panel-body");
        var footer  = panel.find(".panel-footer");
        var hplus   = 30;
        
        if(body.hasClass("panel-body-table") || body.hasClass("padding-0")){
            hplus = 0;
        }
        if(head.length > 0){
            hplus += head.height()+21;
        } 
        if(footer.length > 0){
            hplus += footer.height()+21;
        } 

        panel.find(".panel-body,.chart-holder").height($(window).height() - hplus);
        
        
        panel.addClass("panel-fullscreened").wrap('<div class="panel-fullscreen-wrap"></div>');        
        panel.find(".panel-fullscreen .fa").removeClass("fa-expand").addClass("fa-compress");
        
        $(window).resize();
    }
}

function panel_collapse(panel,action,callback){

    if(panel.hasClass("panel-toggled")){        
        panel.removeClass("panel-toggled");
        
        panel.find(".panel-collapse .fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");

        if(action && action === "shown" && typeof callback === "function")
            callback();            

        onload();
                
    }else{
        panel.addClass("panel-toggled");
                
        panel.find(".panel-collapse .fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");

        if(action && action === "hidden" && typeof callback === "function")
            callback();

        onload();        
        
    }
}
function panel_refresh(panel,action,callback){        
    if(!panel.hasClass("panel-refreshing")){
        panel.append('<div class="panel-refresh-layer"><img src="img/loaders/default.gif"/></div>');
        panel.find(".panel-refresh-layer").width(panel.width()).height(panel.height());
        panel.addClass("panel-refreshing");
        
        if(action && action === "shown" && typeof callback === "function") 
            callback();
    }else{
        panel.find(".panel-refresh-layer").remove();
        panel.removeClass("panel-refreshing");
        
        if(action && action === "hidden" && typeof callback === "function") 
            callback();        
    }       
    onload();
}
function panel_remove(panel,action,callback){    
    if(action && action === "before" && typeof callback === "function") 
        callback();
    
    panel.animate({'opacity':0},200,function(){
        panel.parent(".panel-fullscreen-wrap").remove();
        $(this).remove();        
        if(action && action === "after" && typeof callback === "function") 
            callback();
        
        
        onload();
    });    
}
/* EOF PANEL FUNCTIONS */

/* X-NAVIGATION CONTROL FUNCTIONS */
function x_navigation_onresize(){    
    
    var inner_port = window.innerWidth || $(document).width();
    
    if(inner_port < 1025){               
        $(".page-sidebar .x-navigation").removeClass("x-navigation-minimized");
        $(".page-container").removeClass("page-container-wide");
        $(".page-sidebar .x-navigation li.active").removeClass("active");
        
                
        $(".x-navigation-horizontal").each(function(){            
            if(!$(this).hasClass("x-navigation-panel")){                
                $(".x-navigation-horizontal").addClass("x-navigation-h-holder").removeClass("x-navigation-horizontal");
            }
        });
        
        
    }else{        
        if($(".page-navigation-toggled").length > 0){
            x_navigation_minimize("close");
        }       
        
        $(".x-navigation-h-holder").addClass("x-navigation-horizontal").removeClass("x-navigation-h-holder");                
    }
    
}

function x_navigation_minimize(action){
    
    if(action == 'open'){
        $(".page-container").removeClass("page-container-wide");
        $(".page-sidebar .x-navigation").removeClass("x-navigation-minimized");
        $(".x-navigation-minimize").find(".fa").removeClass("fa-indent").addClass("fa-dedent");
        $(".page-sidebar.scroll").mCustomScrollbar("update");
    }
    
    if(action == 'close'){
        $(".page-container").addClass("page-container-wide");
        $(".page-sidebar .x-navigation").addClass("x-navigation-minimized");
        $(".x-navigation-minimize").find(".fa").removeClass("fa-dedent").addClass("fa-indent");
        $(".page-sidebar.scroll").mCustomScrollbar("disable",true);
    }
    
    $(".x-navigation li.active").removeClass("active");
    
}

function x_navigation(){
    
    $(".x-navigation-control").click(function(){
        $(this).parents(".x-navigation").toggleClass("x-navigation-open");
        
        onresize();
        
        return false;
    });

    if($(".page-navigation-toggled").length > 0){
        x_navigation_minimize("close");
    }    
    
    $(".x-navigation-minimize").click(function(){
                
        if($(".page-sidebar .x-navigation").hasClass("x-navigation-minimized")){
            $(".page-container").removeClass("page-navigation-toggled");
            x_navigation_minimize("open");
        }else{            
            $(".page-container").addClass("page-navigation-toggled");
            x_navigation_minimize("close");            
        }
        
        onresize();
        
        return false;        
    });
       
    $(".x-navigation  li > a").click(function(){
        
        var li = $(this).parent('li');        
        var ul = li.parent("ul");
        
        ul.find(" > li").not(li).removeClass("active");    
        
    });
    
    $(".x-navigation li").click(function(event){
        event.stopPropagation();
        
        var li = $(this);
                
            if(li.children("ul").length > 0 || li.children(".panel").length > 0 || $(this).hasClass("xn-profile") > 0){
                if(li.hasClass("active")){
                    li.removeClass("active");
                    li.find("li.active").removeClass("active");
                }else
                    li.addClass("active");
                    
                onresize();
                
                if($(this).hasClass("xn-profile") > 0)
                    return true;
                else
                    return false;
            }                                     
    });
    
    /* XN-SEARCH */
    $(".xn-search").on("click",function(){
        $(this).find("input").focus();
    })
    /* END XN-SEARCH */
    
}
/* EOF X-NAVIGATION CONTROL FUNCTIONS */

/* PAGE ON RESIZE WITH TIMEOUT */
function onresize(timeout){    
    timeout = timeout ? timeout : 200;

    setTimeout(function(){
        page_content_onresize();
    },timeout);
}
/* EOF PAGE ON RESIZE WITH TIMEOUT */

/* PLAY SOUND FUNCTION */
function playAudio(file){
    if(file === 'alert')
        document.getElementById('audio-alert').play();

    if(file === 'fail')
        document.getElementById('audio-fail').play();    
}
/* END PLAY SOUND FUNCTION */

/* NEW OBJECT(GET SIZE OF ARRAY) */
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
/* EOF NEW OBJECT(GET SIZE OF ARRAY) */
var cart = {
  products:   [],
  travellers: [],
  buyers:     []
};

var chat = {
  contact: {},
  message: {},
  offer: {}
};

var amazon_form = "", elsewhere_form = "";

var shipping_label_product = "";

var Calculator = function(price, traveler_commission) {

  var full_price = price * 1 + traveler_commission * 1;

  var charges = $.parseJSON($('.charges').attr('charges'));

  var commission_charge = parseFloat(parseFloat(full_price).toFixed(2) * charges.commission_rate / 100).toFixed(2),
    transaction_charge = parseFloat(parseFloat(full_price).toFixed(2) * charges.transaction_charge_rate / 100).toFixed(2);

  return {
    'price': price,
    'traveler_commission': traveler_commission,
    'price_with_traveler_commission': full_price,

    'commission_rate': charges.commission_rate,
    'commission_charge': commission_charge,
    'price_with_commission': parseFloat(full_price * 1 + commission_charge * 1).toFixed(2),

    'transaction_rate': charges.transaction_charge_rate,
    'transaction_charge': transaction_charge,
    'fixed_transaction_charge': charges.fixed_transaction_charge,
    'price_with_transaction_charge': parseFloat(full_price * 1 + charges.fixed_transaction_charge * 1 + transaction_charge * 1).toFixed(2),

    'total': parseFloat(full_price * 1 + commission_charge * 1 + transaction_charge * 1 + charges.fixed_transaction_charge * 1).toFixed(2)
  };

};

function add_to_cart(item) {

  var products = cart.products;

  if (item) {

    var product = {
      link: $(item).attr('p_link'),
      name: $(item).attr('p_name'),
      image: $(item).attr('p_image'),
      price: $(item).attr('p_price'),
    };

    var is_product_in_cart = _.findLastIndex(products, {
      'link': product.link
    });

    if (is_product_in_cart < 0) {
      products.push(product);

      $.get('/user/wishlist/products/store', product);

      // $.get('/user/add-to-my-buy', product);

    }

    $('[p_link="' + product.link + '"]').html('<i class="fa fa-star fa-2x green-text"></i> Added to list');

  }

  cart.products = products;
  // $.jStorage.set('cart', cart);

}

function remove_from_cart(item_id) {

  if (cart.products[item_id]) {

    var item = cart.products[item_id];

    // cart.products[item_id] = null;

  }

}

function mark_products_added() {
  if (cart.products.length > 0) {
    $.each(cart.products, function(i, v) {
      $('.self-add-to-cart[p_link="' + v.link + '"]').html('<i class="fa fa-star fa-2x green-text"></i> Added to list');
    });
  }

}

function add_traveller_to_cart(item) {

  var travellers = cart.travellers;

  var traveller = {
    'id': $(item).attr('t_id'),
    'name': $(item).attr('t_name')
  };

  var is_traveller_in_cart = _.findLastIndex(travellers, {
    'id': traveller.id
  });

  if (is_traveller_in_cart < 0) {
    travellers.push(traveller);

    $.get('/user/wishlist/travellers/store', traveller);
  }

  $('[t_id="' + traveller.id + '"]').html('<i class="fa fa-star fa-2x green-text"></i> Added to list');

  cart.travellers = travellers;

  // $.jStorage.set('cart', cart);

}

function mark_traveller_added() {

  if (cart.travellers.length > 0) {
    $.each(cart.travellers, function(i, v) {
      $('.add-traveller-to-list[t_id="' + v.id + '"]').html('<i class="fa fa-star fa-2x green-text"></i> Added to list');
    });
  }

}

function add_buyer_to_cart(item) {

  var buyers = cart.buyers;

  var buyer = {
    'id': $(item).attr('b_id'),
    'name': $(item).attr('b_name')
  };

  var is_buyer_in_cart = _.findLastIndex(buyers, {
    'id': buyer.id
  });

  if (is_buyer_in_cart < 0) {
    buyers.push(buyer);

    $.get('/user/wishlist/buyers/store', buyer);
  }

  $('[b_id="' + buyer.id + '"]').html('<i class="fa fa-star fa-2x green-text"></i> Added to list');

  cart.buyers = buyers;
  $.jStorage.set('cart', cart);

}

function mark_buyer_added() {

  if (cart.buyers.length > 0) {
    $.each(cart.buyers, function(i, v) {
      $('.add-buyer-to-list[b_id="' + v.id + '"]').html('<i class="fa fa-star fa-2x green-text"></i> Added to list');
    });
  }

}

function populate_travellers_at_product_page() {

  if ($('.favorite-traveller-list').length > 0 && cart.travellers.length > 0) {

    $('.favorite-traveller-list').html("");
    
    // $.each(cart.travellers, function(i, v) {
    //     $('.favorite-traveller-list').append('<p><input name="traveller[]" type="checkbox" value="' + v.traveler_id + '"> ' + v.name + '</p>');
    // });
    
    $.each(cart.travellers, function (i, v) {
      if ($('.favorite-traveller-list input[type=checkbox][value="' + v.traveler_id + '"]').length == 0) {
      
      $('.favorite-traveller-list').append('<p><input name="traveller[]" type="checkbox" value="' + v.traveler_id + '"> ' + v.name + '</p>');
        
      }
    });
    
  }

}

function populate_products_at_traveller_page() {

  if ($('.favorite-product-list').length > 0 && cart.products.length > 0) {

    $('.favorite-product-list').html("");

    var commission_rate = $('.search-result-area').attr('commission_rate'),
      transaction_rate = $('.search-result-area').attr('transaction_rate');

    $.each(cart.products, function(i, v) {

      var c = new Calculator(v.price, 0);

      $('.favorite-product-list').append('<div class="col-xs-12 col-sm-6 push-down-10"><p class="text-left"><input type="checkbox" class="favorite_product" value="' + v.link + '"> <a href="' + v.link + '" target="_blank" >' + v.name + '</a></p></div> <div class="col-xs-12 col-sm-6 push-down-10"><p class="white-text text-right">Price: <b>USD ' + v.price + '</b> <br> Airposted Commission: <b>USD ' + c.commission_charge + '</b> <br> Transaction Charge: <b>USD ' + parseFloat(c.transaction_charge * 1 + c.fixed_transaction_charge * 1).toFixed(2) + '</b> <br> Total: <b>USD ' + c.total + ' </b></p></div>');
    });
  }

}

function calculate_charge_at_buyer_search_page(subject) {

  var price = parseFloat($(subject).find('.buyer_price_offer').val()).toFixed(2),
    traveller_commission = parseFloat($(subject).find('.buyer_commission_offer').val()).toFixed(2),
    c = new Calculator(price, traveller_commission);

  $(subject).find('.get_offer_price').text(c.price_with_traveler_commission);
  $(subject).find('.get_transaction_charge').text( parseFloat(c.transaction_charge * 1 + c.fixed_transaction_charge * 1).toFixed(2) );
  $(subject).find('.get_commission').text(c.commission_charge);
  $(subject).find('.get_total').text(c.total);

}

function level_search_items(){
  var a = 0;
  $('.search-result-area .search-item').each(function(){
  a = $(this).height() > a ? $(this).height() : a;
  });
  $('.search-result-area .search-item').height(a);
}

// function getWishlist(){
  
//   if( $('.client-nav-area').length > 0 ){
    
//     $.getJSON('/user/wishlist/products').success(function(data) {
//       cart.products = data;
//       mark_products_added();
//     });
//     $.getJSON('/user/wishlist/buyers').success(function(data) {
//       cart.buyers = data;
//       mark_buyer_added();
//     });
//     $.getJSON('/user/wishlist/travellers').success(function(data) {
//       cart.travellers = data;
//       mark_traveller_added();
//     });
    
//   }
  
// }

function autoDismissableMessage(){
  
  setTimeout(function(){
    $('.auto-dismissable').hide().remove();
  }, 3000);
  
}

File.prototype.convertToBase64 = function(callback){
        var reader = new FileReader();
        reader.onload = function(e) {
             callback(e.target.result)
        };
        reader.onerror = function(e) {
             callback(null);
        };        
        reader.readAsDataURL(this);
};

function selected_image_to_base64(){
  
  if( $("#img_for_amazon").length > 0 ){
    $("#img_for_amazon").on('change',function(){
      
      var holder = $(this).parents('form');
      
      holder.find('#amazon_img_preview').attr('src', '');
      holder.find('#non_amazon_img_preview').attr('src', '');
      holder.find('[name=image_url]').val('');
        
      var selectedFile = this.files[0];
      selectedFile.convertToBase64(function(data){
          
          holder.find('.amazon_preview .message').text('');
          holder.find('#amazon_img_preview').attr('src', data);
          holder.find('[name=image_url]').val(data);
          
      });
      
    });
  }
  
  if( $("#img_for_non_amazon").length > 0 ){
    $("#img_for_non_amazon").on('change',function(){
      
      var holder = $(this).parents('form');
      
      holder.find('#non_amazon_img_preview').attr('src', '');
      holder.find('#amazon_img_preview').attr('src', '');
      holder.find('[name=image_url]').val('');
        
      var selectedFile = this.files[0];
      selectedFile.convertToBase64(function(data){
          
          holder.find('.amazon_preview .message').text('');
          holder.find('#non_amazon_img_preview').attr('src', data);
          holder.find('[name=image_url]').val(data);
          
      });
      
    });
  }
  
  if( $("#chat_image").length > 0 ){
    $("#chat_image").on('change',function(){
      
      $('#chat_image_preview').attr('src', '');
      var selectedFile = this.files[0];
      selectedFile.convertToBase64(function(data){
          
          $('#chat_image_preview').attr('src', data);
          
      });
      
    });
  }
  
}

function selected_image_to_base64_2(){
  
  $(document).on({
    
    change: function(){
      
      var holder = $(this).parents('.product-picker');
      
      holder.find('.amazon_img_preview').attr('src', '');
      holder.find('[name="amazon_image_url[]"]').val('');
        
      var selectedFile = this.files[0];
      selectedFile.convertToBase64(function(data){
          
          holder.find('.amazon_preview .message').text('');
          holder.find('.amazon_img_preview').attr('src', data);
          holder.find('[name="amazon_image_url[]"]').val(data);
          
      });
      
    }
    
  }, '.img_for_amazon');
  
  
  $(document).on({
    
    change: function(){
      
      
      var holder = $(this).parents('.product-picker');
      
      holder.find('.non_amazon_img_preview').attr('src', '');
      holder.find('[name="non_amazon_image_url[]"]').val('');
        
      var selectedFile = this.files[0];
      selectedFile.convertToBase64(function(data){
          
          holder.find('.amazon_preview .message').text('');
          holder.find('.non_amazon_img_preview').attr('src', data);
          holder.find('[name="non_amazon_image_url[]"]').val(data);
          
      });
      
    }
    
  }, '.img_for_non_amazon');
  
  
}

// For single product
function get_img_from_amazon(){
  
  if( $('#fetch_from_amazon').length > 0 ){
    
    $('#fetch_from_amazon, [name=amazon_url]').on('click keyup',function(){
    
      var holder  = $(this).parents('.product-picker');
          
          /** For AWS US **/
      var input_url = holder.find('[name=amazon_url]').val();
      
      if( input_url.length > 5 ){
        
            /** For AWS US **/
        var url = ( input_url.length > 5 ) ? input_url.split('/dp/') : [];
            
            url = ( url.length > 1 ) ? url[1].split('/')[0] : [];
            /** END : For AWS US **/
    
            /** For AWS UK (if pattern does not match AWS US product link) **/
            url = ( url.length > 0 ) ? url : input_url.split('/gp/product/');
    
            url = ( url.length > 1 && typeof(url) == 'object' ) ? url[1].split('/')[0] : url;
            /** For AWS UK **/
        
        if( url.length > 0 ){
          holder.find('.amazon_preview .message').text('Fetching image from Amazon');
          holder.find('#amazon_img_preview').attr('src', '');
          holder.find('#non_amazon_img_preview').attr('src', '');
          holder.find('[name=image_url]').val('');
          
          $.get('/user/fetch-image-from-url/' + url, function (data) {
                
              holder.find('.amazon_preview .message').text('');
              holder.find('#amazon_img_preview').attr('src', data.thumb);
              holder.find('[name=image_url]').val(data.thumb);
              holder.find('[name=p_length]').val(data.Length);
              holder.find('[name=p_width]').val(data.Width);
              holder.find('[name=p_height]').val(data.Height);
              holder.find('[name=p_weight]').val(data.Weight * 1 / 1000);
              holder.find('[name=price]').val(data.price * 1 / 100);
        
          });
          
        } else{
          holder.find('.amazon_preview .message').text('Enter product url');
        }
        
      }
      
    });
  
  }
  
}

// For multiple products
function get_img_from_amazon2(){
  
  $(document).on({
    
    'click keyup': function(){
      
      var holder  = $(this).parents('.product-picker');
          
          /** For AWS US **/
      var input_url = holder.find('[name="amazon_url[]"]').val();
      
      if( input_url.length > 5 ){
        
            /** For AWS US **/
        var url = ( input_url.length > 5 ) ? input_url.split('/dp/') : [];
            
            url = ( url.length > 1 ) ? url[1].split('/')[0] : [];
            /** END : For AWS US **/
    
            /** For AWS UK (if pattern does not match AWS US product link) **/
            url = ( url.length > 0 ) ? url : input_url.split('/gp/product/');
    
            url = ( url.length > 1 && typeof(url) == 'object' ) ? url[1].split('/')[0] : url;
            /** For AWS UK **/
        
        if( url.length > 0 ){
          holder.find('.amazon_preview .message').text('Fetching image from Amazon');
          holder.find('.amazon_img_preview').attr('src', '');
          holder.find('[name="amazon_image_url[]"]').val('');
          
          $.get('/user/fetch-image-from-url/' + url, function (data) {
              
              holder.find('.amazon_preview .message').text('');
              holder.find('.amazon_img_preview').attr('src', data.thumb);
              holder.find('[name="amazon_name[]"]').val(data.title);
              holder.find('[name="amazon_url[]"]').val(data.link.length > 10 ? data.link : holder.find('[name="amazon_url[]"]').val() );
              holder.find('[name="amazon_image_url[]"]').val(data.thumb);
              holder.find('[name="amazon_price[]"]').val(data.price*1/100);
              
              holder.find('[name="amazon_height[]"]').val(data.Height);
              holder.find('[name="amazon_width[]"]').val(data.Width);
              holder.find('[name="amazon_length[]"]').val(data.Length);
              holder.find('[name="amazon_weight[]"]').val(data.Weight);
              
              holder.find('[name="amazon_height[]"], [name="amazon_width[]"], [name="amazon_length[]"], [name="amazon_height[]"]').attr({'class': 'form-control select2'}).next('span').remove();
              holder.find('[name="amazon_height[]"], [name="amazon_width[]"], [name="amazon_length[]"], [name="amazon_weight[]"]').select2();
              
          });
          
        } else{
          holder.find('.amazon_preview .message').text('Enter product url');
        }
        
      }
      
    }
    
  }, '.fetch_from_amazon, [name="amazon_url[]"]');
    
}

function get_cities_on_country_select(){
  
  if( $('.get_cities').length > 0 ){
    
    $('.get_cities').on('click keyup change', function(e){

      $('[name=city_id]').html('<option>Select the city where you want to receive the product</option>');
      
      $.getJSON('/user/fetch-cities-for-country/'+ $('.get_cities option:selected').val(), function(data){
        
          $.each( data , function(k,v){
            
            $('[name=city_id]').append('<option value="'+k+'">'+v+'</option>');
            
          });
        
      });
      
    });
    
  }
  
  if( $('[get_cities]').length > 0 ){
    
    $('[get_cities]').on('click keyup change', function(e){
      
      var country = $(this).find('option:selected').val();
      
      var city_list_holder = $('[city_list="'+$(this).attr('get_cities')+'"]');
      
      city_list_holder.html('<option>Select the city</option>');
      
      $.getJSON('/user/fetch-cities-for-country/'+ country, function(data){
        
          $.each( data , function(k,v){
            
            city_list_holder.append('<option value="'+k+'">'+v+'</option>');
            
          });
        
      });
      
    });
    
  }
  
}

function lazyload(){
    
    if( $('[data-src]').length > 0 ){
      
      setTimeout(function(){
        
        $('[data-src]').each(function(){
            
            $(this).attr('src', $(this).attr('data-src') ).removeAttr('data-src');
            
        });
        
      }, 5000);
        
    }
    
}

/* CHAT */

function contact_display_order(){
  
  var list = [];
  
  $('.users .contact').each(function(i,v){
    
    var contact = $(this),
        chat    = $('#'+contact.attr('message')).find('[at]:last-child').attr('at'),
        offer   = $('#'+contact.attr('offer')).find('[at]:first-child').attr('at'),
        chat    = ( chat == undefined ) ? '2015-01-01 10:00:00' : chat,
        offer   = ( offer == undefined ) ? '2015-01-01 10:00:00' : offer,
        latest  = ( new Date(chat.replace(' ', 'T')) > new Date(offer.replace(' ', 'T')) ) ? chat : offer;
        contact.attr('at', latest);
        list.push(latest);
    
  });
  
  list = list.sort().reverse();
  
  var data = '';
  
  list.forEach(function(v){
    
    var a = $('.users .contact[at="'+v+'"]').parent().html();
    
    if( a != undefined ) data += '<li>'+a+'</li>';
  });
  
  $('.users ul').html(data);
  
}

function reset_chat(){
  chat = {
    contact: {},
    message: {},
    offer: {}
  };
}

function chat_init(){
    
  
  $(document).on({
    
    click: function(e){
      
      e.preventDefault();
      reset_chat();
      
      var subject = $(this);
      
      chat.contact.id = subject.attr('id');
      chat.message.id = subject.attr('message');
      chat.offer.id = subject.attr('offer');
          
      $('.msg-list, .offer-list, .users li').removeClass('active');
      
      subject.parent().addClass('active');
      $('#'+chat.message.id+ ', #'+chat.offer.id).addClass('active');
      
      setTimeout(function(){

        $('#'+chat.message.id).animate({
          scrollTop: $('#'+chat.message.id)[0].scrollHeight
        }, 100); // -1 is the animation duration

      }, 500);
      
      /**
       * Mark Chat as read
      */
      
      if( subject.hasClass('unread') ){
        
        $.get('/user/chat-with/'+ chat.contact.id.split('-')[2] +'/is-read');
        
        subject.removeClass('unread');
        
      }
      
      setTimeout(function() { 
          
        $('.xs-maximize-inbox .counter').text(0); 
        subject.find('.count-chat').text(0);
        
      }, 5000);
      
      /**
       * END : Mark Chat as read
      */
      
      /**
       * @small screen, toggle inbox/offer window
      */
      
      if( $(window).width() < 600 ){
        $('.users ul').removeClass('maximized').addClass('minimized');
        $('.inbox').removeClass('minimized').addClass('maximized');
        $('.offers').removeClass('maximized').addClass('minimized');
        
        $('.xs-maximize-inbox').addClass('active').find('.counter').text( subject.find('.count-chat').text() );
        $('.xs-user-toggler, .xs-maximize-offers').removeClass('active');
        $('.xs-maximize-offers .counter').text( subject.find('.count-offer').text() );
        
        subject.parent().parent().removeClass('maximized').addClass('minimized').animate({
          scrollTop : subject.parent().position().top + 50
        }, 400, function(){
          
          $('html, body').animate({
            scrollTop: $('.xs-offer-inbox-toggler').offset().top
          }, 1000);
          
        });

      }
    
    }
      
  }, '.offer-inbox .contact');
  
  
  $('#msg').keypress(function(e){
    
    var keycode = (e.keyCode ? e.keyCode : e.which);
  	if(keycode == '13' && $('#send-on-enter').is(':checked') && $(this).val().length > 0 && chat.message.id != undefined){
  		
  		e.preventDefault();
  		
  		chat_store();
  		
  	}
    
  });
  
  
  $('#post-message').click(function(e){
    
    e.preventDefault();
    
    chat_store();
    
  });
  
  
}

function chat_refresh(){
  
  var chat_refresh_in_progress = 0, offer_refresh_in_progress = 0, contact_refresh_in_progress = 0;
  
  // update chats
  setInterval(function(){
      
    if( $('.msg-list.active').length > 0 && $.active < 5 && chat_refresh_in_progress == 0){
      
      chat_refresh_in_progress = 1;
    
      $('.msg-list.active').each(function(i,v){
              
        var list    = $(this),
            at      = $(this).find('[at]:last-child'),
            time    = at.length > 0 ? at.attr('at') : '2016-11-30 23:59:59',
            contact = $(this).attr('id').split('-')[2],
            user    = '#contact-id-'+contact;
          
          $.get('/user/chats/inbox/update/'+contact+'/'+encodeURI(time), function(data){
            
            if(data.length > 10){
              
              var unreads = $(data).find('.time').length;

              list.find('.no-message, .loading').remove();
              
              list.append(data);
              
              setTimeout(function(){
                
                $(list).animate({
                  scrollTop: $(list)[0].scrollHeight
                }, 100); // -1 is the animation duration
                
              },700);
              
              if( ! $('.xs-maximize-inbox').hasClass('active') && unreads > 0 && $(window).width() < 800 ){
                
                var total_unreads = $(user).addClass('unread').find('.count-chat').text() * 1 + unreads * 1;
                
                $(user).addClass('unread').find('.count-chat').text( total_unreads );
                $('.xs-maximize-inbox .counter').text( total_unreads );
                
              }
              
            }
            
            if(list.children('li').length == 0){
              
              list.html('\
              <span class="no-message text-center">\
                  <img src="/public/img/settings/no-message.png" alt="No Messages yet">\
                  <h3>You haven\'t said Hi yet!</h3>\
                  <p>Start a conversation below.</p>\
              </span>\
              ');
              
            }
            
            chat_refresh_in_progress = 0;
            
          });
      
      });
    
    }
    
  }, 1500);
  
  // update offers
  setInterval(function(){
      
    if( $('.offer-list.active').length > 0 && $.active < 5 && offer_refresh_in_progress == 0){
      
      offer_refresh_in_progress = 1;
    
      $('.offer-list.active').each(function(i,v){
              
        var list    = $(this),
            at      = $(this).find('[at]:first-child'),
            time    = at.length > 0 ? at.attr('at') : '2016-11-30 23:59:59',
            contact = $(this).attr('id').split('-')[2],
            user    = '#contact-id-'+contact;
            
          $.get('/user/chats/offer/update/'+contact+'/'+encodeURI(time), function(data){
            
            list.find('.loading').remove();
            
            if( data.length > 10 && time != $(_.first($(data)).outerHTML).attr('at') ){
              
              var pending_offers = $(data).find('.btn:contains("Counter")').length;
              
              list.html(data)
                  .find('[data-toggle="popover"]').popover({'html': true})
                  .find('[tooltip]').tooltip();
                  
              if( ! list.hasClass('active') ){
                
                $(user).addClass('unread').find('.count-offer').text( pending_offers );
                $('.xs-maximize-offers .counter').text( pending_offers );
                
              }
              
            }
            
            offer_refresh_in_progress = 0;
            
          });
      
      });
    
    }
    
  }, 6000);
  
  // update user list and counter
  setInterval(function(){
    
    if( $('.offer-inbox .users').length > 0 && $.active < 5 && contact_refresh_in_progress == 0 ){
    
      contact_refresh_in_progress = 1;
      var total_unread_chats = 0, total_pending_offers = 0;
      
      $.get('/user/chats/contact-update', function(data){
        
        if(data.length > 0){
          
          $(data).find('.contact').each(function(){
            
            var old = $('#'+$(this).attr('id')),
                cur = $(this);
                
            total_unread_chats = total_unread_chats * 1 + cur.find('.count-chat').text() * 1;
            total_pending_offers = total_pending_offers * 1 + cur.find('.count-offer').text() * 1;
            
            if( old.length > 0 ){
              
              old.find('.count-chat').text( cur.find('.count-chat').text() );
              old.find('.count-offer').text( cur.find('.count-offer').text() );
              
            } else{
              
              $('.users ul.maximized').append('<li>'+cur.parent().html()+'</li>').find('[data-src]').each(function(){
                $(this).attr({ 'src' : $(this).attr('data-src') });
              });
              
              $('.inbox .list').append('\
              <ul class="msg-list" id="'+cur.attr("message")+'" >\
                  <p class="loading push-20"><i class="fa fa-spinner fa-spin"></i></p>\
              </ul>\
              ');
              
              $('.offers .list').append('\
              <ul class="offer-list" id="'+cur.attr("offer")+'">\
                  <p class="loading push-20"><i class="fa fa-spinner fa-spin"></i></p>\
              </ul>\
              ');
              
            }
            
          });
          
        }
        
        $('.counter-icon').text(total_unread_chats +'/'+ total_pending_offers);
        contact_refresh_in_progress = 0;
        
      });
    
    }
    
  }, 12000);
  
}

function chat_store(){
  
  var msg_data = $('#msg_form').serialize();
          	
	var id = chat.contact.id.split('-')[2];
	
	$('#msg').val('');
	
	$.post( '/user/chats/store/'+id, msg_data, function(data){});
  
  
}

function chat_store_image(){
  
  $('#msg_img_form').submit(function(e){
    
    e.preventDefault();
    
    $('.image-container .message').text('');
    
    if(chat.contact.id != undefined){
      
      var msg_data  = $('#msg_img_form').serialize();
      var id        = chat.contact.id.split('-')[2];
      var formdata  = new FormData(this);
      $('.image-container .message').text('Uploading image to conversation...');
  
      $.ajax({
          url: '/user/chats/store/'+id,
          type: "POST",
          data: formdata,
          mimeTypes:"multipart/form-data",
          contentType: false,
          cache: false,
          processData: false,
          success: function(data){
              if(data * 1 == 1){
                $('.image-container .message').text('Image has been uploaded to your conversation.');
                $('#msg_img_form').parents('.modal').modal('hide');
                $('.image-container .message').text(' ');
              }
          },
          error: function(){
              if(data * 1 == 1){
                $('.image-container .message').text('Failed! Please retry.');
              }
          }
       });
      
    } else{
      
      $('.image-container .message').text('Please select a contact to start conversation.');
      
    }
    
  });
  
}

function toggle_inbox_offers(){
  
  $('.toggle-inbox').click(function(e){
    
    e.preventDefault();
    
    $('.toggle-inbox').toggleClass('active');
    $('.inbox').toggleClass('minimize');
    
  });
  
  $('.toggle-offers').click(function(e){
    
    e.preventDefault();
    
    $('.toggle-offers').toggleClass('active');
    $('.offers').toggleClass('minimize');
    
  });
  
}

function mark_user_chat_read(){
  
  var a = $('.users li.active a');
  
  if(a.length > 0){
    
    var count  = $('.counter-icon').first().text(),
        deduct = a.find('.count-chat').text() * 1;
    
    a.find('.count-chat').text(0);
    
    $('.xs-maximize-inbox .counter').text(0);
    
    $('.counter-icon').text( (count.split('/')[0] * 1 - deduct) +'/'+ count.split('/')[1] * 1 );
    
    $.get('/user/chat-with/'+a.attr('id').split('-')[2]+'/is-read');
    
  }
  
}

function maximize_inbox(e) {
  e.preventDefault();
  
  $(this).find('.counter').text(0);
  $('.users li.active .count-chat').text(0);
  
  $('.inbox').removeClass('minimized').addClass('maximized');
  $('.offers').removeClass('maximized').addClass('minimized');
  
  
  $('.xs-maximize-inbox').addClass('active');
  $('.xs-user-toggler, .xs-maximize-offers').removeClass('active');
  
}

function maximize_offer(e) {
  e.preventDefault();
  
  $('.offers').removeClass('minimized').addClass('maximized');
  $('.inbox').removeClass('maximized').addClass('minimized');
  
  $('.xs-maximize-offers').addClass('active');
  $('.xs-user-toggler, .xs-maximize-inbox').removeClass('active');
  
}

/* END : CHAT */

function update_profile_img(){
  
  $('#update-profile-image').submit(function(e){
    
    e.preventDefault();
    
    $('.image-container .message').text('Uploading...');
    
    var url       = $(this).attr('action');
    var formdata  = new FormData(this);

    $.ajax({
        url: url,
        type: "POST",
        data: formdata,
        mimeTypes:"multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        success: function(data){
            if(data * 1 == 1){
              
              $('.image-container .message').text('Success !. Reloading the page.');
              
              window.location.href = window.location.href;
              window.location.reload();
              
            }
        },
        error: function(){
            if(data * 1 == 1){
              $('.image-container .message').text('Failed! Please retry.');
            }
        }
     });
    
  
  });
  
}

function send_message_from_search(){
  
  if( $('.send-message').length > 0 ){
    
    $('.send-message').submit(function(e){
      
      e.preventDefault();
      
      var form  = $(this),
          url   = form.attr('action'),
          data  = form.serialize();
          
      form.find('.message').text('Sending...');
      
      $.post(url, data, function(returned_data){
        
        if( returned_data * 1 == 1 ){
          
          form.find('.message').text('');
          
          form.find('.send-message-heading, .send-message-details').addClass('hidden');
          
          form.find('.message-success').removeClass('hidden');
          
          setTimeout(function(){
            
            form.find('.send-message-heading, .send-message-details').removeClass('hidden');
            
            form.find('.message-success').addClass('hidden');
            
          }, 10000);
          
        } else{
          
          form.find('.message').text('Please type in something and send again.');
          
        }
        
      });
      
    });
    
  }
  
}

function make_price_calculation_visible_on_post(){
  
  if( $('.price_area .price').length > 0 ){
  
    $('.price_area .price').on('keyup', function(){
    
    if($(this).val().length > 0){
    
      $('.price_summary').css({
        'opacity': 1,
        'height': 'auto',
        'display': 'block',
      });
      
    } else{
      
      $('.price_summary').css({
        'opacity': 0,
        'height': 0,
        'display': 'none',
      });
      
    }
      
  });
  
  }
  
}

function tourguide_balance(s){
  
  var t = $( $(s).attr('target'));
  
  $('html, body').animate({ scrollTop: t.offset().top - ( $(s).height() + 70 ) }, 700, function(){
    
    $('.tour-focus').css({
      'border-left-width' : ( t.offset().left * 1 - 10 ) + 'px',
      'border-top-width' : (t.offset().top * 1 - 10 ) + 'px',
      'border-bottom-width' : $(document).height() - ( t.offset().top + t.height() ) + 'px',
      'border-right-width' : $(window).width() + 'px',
      'padding-top' : t.height() + 20 + 'px',
      'padding-right': t.width() + 30 + 'px'
    });
    
    $(s).css({
      'top': t.offset().top - ( $(s).height() + 40 ) + 'px',
      'left': t.offset().left + 'px',
      'max-width': ( $(window).width() < 400 ) ? 275 + 'px' : 400 + 'px',
    });
    
    $( '.tour-focus, '+s ).show();
    
  });
  
}

function tourguide_init(){
  
  if( ($('.buyer-tour').length > 0 && $.jStorage.get('buyer_search_tour') != 1) || ($('.traveler-tour').length > 0 && $.jStorage.get('traveler_search_tour') != 1) ){
    
    tourguide_balance( '#guide-1' );
    
    $('.guide .next-slide, .guide .prev-slide').click(function(e){
    
      e.preventDefault();
      
      $(this).parents('.guide').hide();
      
      if( $(this).attr('href').length > 1 ){
      
        tourguide_balance( $(this).attr('href') );
      
      } else{
        
        $('.tour-focus').hide();
        
      }
      
    });
    
    if( $('.buyer-tour').length > 0 ){
      $.jStorage.set('buyer_search_tour', 1);
    } else if( $('.traveler-tour').length > 0 ){
      $.jStorage.set('traveler_search_tour', 1);
    }
    
  }
  
}

function select_box(e){
  
  $('.box-option').removeClass('active');
  
  $(this).addClass('active');
  
}

function calculate_order_cost(){
  

  $('.summary-products').empty();
  
  var product_total = 0, shipping_total = 0, transaction_charge = 0, invoice_total = 0, box_height = 0, box_width = 0, box_length = 0, box_capacity = 0;
  
  $('.product-picker').each(function(i,v){
    
    var item = $(this),
        name = item.find('[name$="_name[]"]').val() ,
        price_per_unit = item.find('[name$="_price[]"]').val() * 1,
        quantity = item.find('[name$="_quantity[]"] option:selected').val() * 1,
        total = Math.round( price_per_unit * quantity ),
        weight = item.find('[name$="_weight[]"] option:selected').val() * 1,
        height = item.find('[name$="_height[]"] option:selected').val() * 1,
        width = item.find('[name$="_width[]"] option:selected').val() * 1,
        length = item.find('[name$="_length[]"] option:selected').val() * 1,
        img = item.find('[name$="_image_url[]"]').val();
        
        product_total += (price_per_unit * quantity);
        invoice_total += product_total + shipping_total;
        box_height += Math.round( height * quantity );
        box_width += Math.round( width * quantity );
        box_length += Math.round( length * quantity );
        box_capacity += Math.round( weight * quantity );
    
    $('.summary-products').append('\
        \
        <li>\
            <span class="cart-summary-img">\
                <img src="'+img+'" class="img-responsive"></img>\
            </span>\
            \
            <span class="row">\
                <div class="no-margin">'+name+': <span class="pull-right">$'+ price_per_unit +' * '+ quantity +' = $'+ total +'</span></div>\
                <div class="no-margin">Size: <span class="pull-right">'+length+' * '+width+' * '+height+' Inches * '+quantity+'</span></div>\
                <div class="no-margin">Weight: <span class="pull-right">'+weight/1000+' KG * '+quantity+'</span></div>\
            </span>\
        </li>\
        \
    ');
    
  });
  
  
  
  $('[name=box_height]').val( Math.round( box_height ) );
  $('[name=box_width]').val( Math.round( box_width ) );
  $('[name=box_length]').val( Math.round( box_length ) );
  $('[name=box_weight]').val( Math.round( box_capacity ) );
  
  $('.box-height').text( Math.round( box_height ) + ' Inches');
  $('.box-width').text( Math.round( box_width ) + ' Inches');
  $('.box-length').text( Math.round( box_length ) + ' Inches');
  $('.box-capacity').text( Math.round( box_capacity )/1000 + ' KG');
  
  $('.total-product-cost').text('$'+ Math.round( product_total ));
  $('.total-shipping').text('$'+ Math.round( shipping_total ));
  $('.total-invoice').text('$'+ Math.round( invoice_total ));
  
  $.post('/user/pitneybowes-rates', $('.product-picker').parents('form').serializeArray(), function(data){
    
    if( ! isNaN(data * 1)){

      $total_charge = Math.round( data * 1 );
      invoice_total  = Math.round( product_total * 1 + $total_charge * 1 );
      
    }
    
    $('.total-product-cost').text('$'+ Math.round( product_total ) ); 
    $('.total-shipping').text('$'+$total_charge);
    $('.total-invoice').text('$'+invoice_total);
    
  } );
  
}

function order_form_toggler(){
  
  // Next to Billing
  $('.next-to-shipping').click(function(e){
    e.preventDefault();
    
    var required_fields_filled = true;
    
    $('.order-holder [required]').each(function(i,v){
      if( $(this).val().length == 0 ) required_fields_filled = false;
    });
    
    if( required_fields_filled ){
      
      $('.message.alert').text('');
      $('.order-holder').addClass('hidden');
      $('.shipping-holder').removeClass('hidden');
      $('.breads span:eq(0)').removeClass('boldest');
      $('.breads span:eq(1)').addClass('boldest');
      
    } else{
      
      $('.message.alert').text('Please fill all required fields to continue.');
      
    }
    
    
  });
  
  // Back to Shopping
  $('.back-to-shopping').click(function(e){
    e.preventDefault();
    $('.order-holder').removeClass('hidden');
    $('.shipping-holder').addClass('hidden');
    $('.breads span:eq(1)').removeClass('boldest');
    $('.breads span:eq(0)').addClass('boldest');
  });
  
  
  // Next to summary
  $('.next-to-summary').click(function(e){
    e.preventDefault();
    
    var required_fields_filled = true;
    
    $('.shipping-holder [required]').each(function(i,v){
      if( $(this).val().length == 0 ) required_fields_filled = false;
    });
    
    if( required_fields_filled ){
      
      calculate_order_cost();
      
      $('.message.alert').text('');
      $('.shipping-holder').addClass('hidden');
      $('.rate-holder').removeClass('hidden');
      $('.breads span:eq(1)').removeClass('boldest');
      $('.breads span:eq(2)').addClass('boldest');
      
    } else{
      
      $('.message.alert').text('Please fill all required fields to continue.');
      
    }
    
  });
  
  // Back to Shipping
  $('.back-to-shipping').click(function(e){
    e.preventDefault();
    $('.shipping-holder').removeClass('hidden');
    $('.rate-holder').addClass('hidden');
    $('.breads span:eq(2)').removeClass('boldest');
    $('.breads span:eq(1)').addClass('boldest');
  });
  
}

function increment_shipping_label_product(){
  
  if( $('.shipping-label-item').length > 0 ){
    
    shipping_label_product = '<div class="row shipping-label-item">'+ $('.shipping-label-item').first().html() +'</div>';
  
    $('.increment-shipping-label-item').click(function(e){
      e.preventDefault();
      $('.shipping-label-item:last-child').after(shipping_label_product);
      $('.shipping-label-item:gt(0) .del-label-item').removeClass('hidden');
    });
    
    $(document).on({
      click: function(e){
        e.preventDefault();
        $(this).parents('.shipping-label-item').remove();
      }
    }, '.del-label-item');
    
  }
  
}

function copycat(){
  
  $('.shipping-holder input, .shipping-holder select').on('click keyup change', function(e){
    
    if($('#copycat').is(':checked')){
      
      $('input[name="receiver_name"]').val( $('input[name="sender_name"]').val() );
      $('input[name="receiver_phone"]').val( $('input[name="sender_phone"]').val() );
      $('input[name="receiver_email"]').val( $('input[name="sender_email"]').val() );
      $('input[name="receiver_address"]').val( $('input[name="sender_address"]').val() );
      $('input[name="receiver_state"]').val( $('input[name="sender_state"]').val() );
      $('input[name="receiver_postcode"]').val( $('input[name="sender_postcode"]').val() );
      
      $('select[name="receiver_country_id"], select[name="receiver_city_id"]').removeClass('select2-hidden-accessible').next('span').remove();
      $('select[name="receiver_country_id"] option, select[name="receiver_city_id"] option').removeAttr('selected');
      
      $('select[name="receiver_country_id"]').val( $('select[name="sender_country_id"]').val() );
      
      $('select[name="receiver_city_id"]').html('<option selected value="'+$('select[name="sender_city_id"]').val()+'" >'+$('select[name="sender_city_id"] option:selected').text()+'</option>');
      
      $('select[name="receiver_country_id"], select[name="receiver_city_id"]').select2();
      
    }
    
  });
  
}

function toggle_collapse_icon(){
  
  $('.btn').click(function(e){ 
    $(this).find('.fa-plus, .fa-minus').toggleClass('fa-plus').toggleClass('fa-minus') 
    $(this).find('.fa-angle-right, .fa-angle-down').toggleClass('fa-angle-right').toggleClass('fa-angle-down') 
  });
  
}

function balance_height(){
  
  $('[balance-height]').each(function(i,v){ 
    
    var attr = $(this).attr('balance-height'),
        height = $(this).height();
    
    $('[balance-height="'+attr+'"]').each(function(){ height = $(this).height() > height ? $(this).height() : height; })
  
    $('[balance-height="'+attr+'"]').height(height);
  
  });
  
}

function min_value_constraint(){
  
  $('input[min]').on('change focusout', function(){
    
    $(this).val( $(this).val() * 1 < $(this).attr('min') * 1 || isNaN( $(this).val() * 1 ) ? $(this).attr('min') : $(this).val());
    
  })
  
}

// function load_message(e) {
//   e.preventDefault();
//   var subject = $(this);

//   $('.message-details').html('Loading message...').load($(this).attr('get-message'), function() {
//     subject.parents('ul').children('li').removeClass('active');
//     subject.parent().addClass('active');
//     subject.removeClass('unread');
//   });
// }


$(document).ready(function() {
  
  level_search_items();

  // getWishlist();
  
  autoDismissableMessage();
  
  get_img_from_amazon();
  
  get_img_from_amazon2();
  
  selected_image_to_base64();
  
  selected_image_to_base64_2();
  
  get_cities_on_country_select();
  
  lazyload();
  
  chat_init();
  
  chat_store_image();
  
  toggle_inbox_offers();
  
  update_profile_img();
  
  send_message_from_search();
  
  make_price_calculation_visible_on_post();
  
  order_form_toggler();
  
  increment_shipping_label_product();
  
  copycat();
  
  toggle_collapse_icon();
  
  min_value_constraint();
  
  $('.nicescroll, .scrollable').each(function(){ $(this).niceScroll({ cursorwidth: '10px' }); });
  
  if( $(window).width() > 600 ){
    
    $('.users ul').niceScroll();
    
  } else{
    
    $('.xs-window-height').height( $(window).height() );
    
    $('.inbox').height( $(window).height() - 30 );
    $('.offers').height( $(window).height() - 40 );
    
  }
  
  $('.xs-user-toggler').click(function(e){
    e.preventDefault();
    $('.users .minimized, .users .maximized').toggleClass('minimized maximized');
    
    
    $('.xs-user-toggler').addClass('active');
    $('.xs-maximize-offers, .xs-maximize-inbox').removeClass('active');
    
  });
  
  $('.users [traveler-href]').click(function(){ window.location.href = $(this).attr('traveler-href'); });

  $('.client-nav-area li:has(\'a[href="' + window.location.href + '"]\')').addClass('active');
  
  $(".slick").each(function(i){ $(this).slick(JSON.parse($(this).attr('slick-options'))); });

  if ($('.select2').length > 0) { $('.select2').select2(); }

  if ($('.airport-search').length > 0) {
    $('.airport-search').select2({
      ajax: {
        url: function(params) {
          return '/airport-search/' + params.term;
        },
        dataType: 'json',
        delay: 250,
        processResults: function(data) {
          return {
            results: data
          };
        }
      }
    });
  }
  
  $('#amazon_url').focusin(function(){ $('#other_url').css({'opacity': 0.3}) })
                  .focusout(function(){ $('#other_url').css({'opacity': 1}) });
  
  $('#other_url').focusin(function(){ $('#amazon_url').css({'opacity': 0.3}) })
                  .focusout(function(){ $('#amazon_url').css({'opacity': 1}) });
  
  if( $('.amazon-holder').length > 0 )
  {
    
    amazon_form = '<section class="row amazon-holder product-picker">' +$('.amazon-holder').html() +'</section>';
    elsewhere_form = '<section class="row other-source-holder product-picker">'+ $('.other-source-holder').html() +'</section>';
    
    $('.amazon-holder, .other-source-holder').remove();
    
  }
  
  // $('[get-message]').click(load_message);

  if ($('.buyer_commission_offer').length > 0) {

    $('.buyer_commission_offer').each(function() {

      calculate_charge_at_buyer_search_page($(this).parent());

    });

  }
  
  $('.box-option').click(select_box);
  
  $('.gateway-option').click(function(){
    
    $('.gateway-option').removeClass('active');
    $(this).addClass('active');
    
  });
  
  $('.xs-maximize-inbox').click(maximize_inbox);
  
  $('.xs-maximize-offers').click(maximize_offer);

  $(document).on({
    click: function(e) {
      $('#reply_modal').modal();
    }
  }, '[data-target="#reply_modal"]');

  // $(document).on({

  //   click: function(e) {

  //     e.preventDefault();

  //     add_to_cart($(this));

  //   }

  // }, '.self-add-to-cart');

  // $(document).on({

  //   click: function(e) {

  //     e.preventDefault();

  //     remove_from_cart($(this).parents('[p_id]').attr('p_id'));

  //   }

  // }, '.remove-from-cart');

  // $(document).on({
  //   click: function(e) {
  //     e.preventDefault();

  //     add_traveller_to_cart($(this));
  //   }
  // }, '.add-traveller-to-list');

  // $(document).on({
  //   click: function(e) {
  //     e.preventDefault();

  //     add_buyer_to_cart($(this));
  //   }
  // }, '.add-buyer-to-list');

  // $(document).on({
  //   click: function(e) {
  //     e.preventDefault();
  //     var subject = $(this).parents('.travel-item');
  //     $.get('/user/wishlist/travellers/' + $(this).attr('t_id') + '/remove').success(function(data) {
  //       if (data * 1 == 1) {
  //         $(subject).remove();
  //       }
  //     });
  //   }
  // }, '.remove-traveller-from-list');

  // $(document).on({
  //   click: function(e) {
  //     e.preventDefault();
  //     var subject = $(this).parents('.product-item');
  //     $.get('/user/wishlist/products/' + $(this).attr('p_id') + '/remove').success(function(data) {
  //       if (data * 1 == 1) {
  //         $(subject).remove();
  //       }
  //     });
  //   }
  // }, '.remove-product-from-list');

  // $(document).on({
  //   click: function(e) {
  //     e.preventDefault();
  //     var subject = $(this).parents('.buyer-item');
  //     $.get('/user/wishlist/buyers/' + $(this).attr('b_id') + '/remove').success(function(data) {
  //       if (data * 1 == 1) {
  //         $(subject).remove();
  //       }
  //     });
  //   }
  // }, '.remove-buyer-from-list');

  $(document).on({
    'keyup change': function(e) {
      var holder = $(this).parent(),
        calculation = new Calculator($(this).val(), 0);

      $(holder).find('.total_transaction_charge').text( parseFloat(calculation.transaction_charge * 1 + calculation.fixed_transaction_charge).toFixed(2) );
      $(holder).find('.total_commission').text(calculation.commission_charge);
      $(holder).find('.total_price').text(calculation.total);

    }
  }, '.price');

  $(document).on({
    'keyup change': function(e) {
      var holder = $(this).parent();

      var product_price = $(holder).find('.reply_price').val() * 1,
          traveller_commission = $(holder).find('.reply_traveller_commission').val() * 1,
          calc = new Calculator(product_price , traveller_commission);

      $(holder).find('.reply_transaction_charge').text( parseFloat(calc.transaction_charge * 1 + calc.fixed_transaction_charge * 1).toFixed(2));
      $(holder).find('.reply_airposted_commission').text(calc.commission_charge);
      $(holder).find('.reply_total').text(calc.total);

    }
  }, '.reply_price, .reply_traveller_commission');

  $(document).on({
    'keyup change': function() {

      calculate_charge_at_buyer_search_page($(this).parent());

    }
  }, '.buyer_commission_offer, .buyer_price_offer');

  $('.offer-from-traveller-page').on('submit', function(e) {
    e.preventDefault();

    var form = $(this);

    var choosenProducts = form.find('.favorite_product:checked');
    
    if ( choosenProducts.length * 1 == 0 ) {
      
      $(form).find('.message').text('please choose from products you posted to buy.');
      
    } else {
      
      $(form).find('.message').text(" ");

      $(choosenProducts).each(function(i, v) {

        $(this).after(' <input class="hidden" name="name[]" value="' + $(this).attr('p_name') + '" />\
                        <input class="hidden" name="link[]" value="' + $(this).attr('p_link') + '" />\
                        <input class="hidden" name="buypost_id[]" value="' + $(this).attr('p_buypost_id') + '" />\
                        <input class="hidden" name="image_url[]" value="' + $(this).attr('p_image') + '" />\
                        <input class="hidden" name="product_price[]" value="' + $(this).attr('p_price') + '" />\
                        <input class="hidden" name="offer_price[]" value="' + ( $(this).attr('p_price') * 1 + $(this).attr('c_price') * 1 ) + '" />\
                        <input class="hidden" name="is_offer_from_buyer[]" value="1" />\
                        <input class="hidden" name="is_offer_from_traveller[]" value="0" />\
        ');
        
      });


    }
    
    if( choosenProducts.length > 0 ){

      $(form).find('.message').text('Sending request to the Traveler...');
      
      var data = $(this).serializeArray();
      $('[name="name[]"],[name="link[]"],[name="image_url[]"],[name="product_price[]"],[name="offer_price[]"],[name="is_offer_from_buyer[]"],[name="is_offer_from_traveller[]"],[name="p_buypost_id[]"]').remove();
      
      $.ajax({
        method: 'POST',
        data: data,
        url: $(this).attr('action'),
        success: function(data) {
          $(form).find('.message').html(data);
        }
      });
    
    }

  });

  $('.offer-from-product-search').on('submit', function(e) {
    e.preventDefault();

    var form = $(this),
      choosenProducts = $('[name="traveller[]"]:checked');

    if ($('[name="traveller[]"]:checked').length == 0) {
      $(form).find('.message').text('please choose atleast one Traveler from your favorite list.');
    }

    $(form).find('.message').text('Sending request to the Travelers...');

    $.ajax({
      method: 'POST',
      data: $(this).serializeArray(),
      url: $(this).attr('action'),
      success: function(data) {
        $(form).find('.message').text(data);
      }
    });

  });

  $('.post-offer-from-buyer-search').on('submit', function(e) {
    e.preventDefault();

    var form = $(this);

    if ($(form).find('.offer-price').val().length == 0) {
      $(form).find('.message').html('please offer a price to the buyer.');
    }

    $(form).find('.message').html('Sending request to the Buyer...');

    $.ajax({
      method: 'POST',
      data: $(this).serializeArray(),
      url: $(this).attr('action'),
      success: function(data) {
        $(form).find('.message').html(data);
      }
    });

  });

  $(document).on({
    submit: function(e) {
      e.preventDefault();
      var form = $(this);
      var message = $(form).find('.message');
      if ($(form).find('.reply_price').val().length == 0 || $(form).find('.reply_traveller_commission').val().length == 0) {
        $(message).text('Please enter Product price and Traveler commission.');
      }
      else {
        $(message).text('Sending');
        $.ajax({
          method: 'POST',
          url: $(form).attr('action'),
          data: $(form).serializeArray(),
          success: function(data) {
            if (data * 1 == 1) {
              $(message).text('Sent. Reloading the page.');
              setTimeout(function() {
                window.location.reload()
              }, 3000);
            }
            else {
              $(message).text(data);
            }
          }
        });
      }
    }
  }, '.offer_made_by_user');

  $(document).on({
    'keyup change': function() {
      var price = $(this).parents('.offer-from-traveller-page').find('.manual_price').val(),
        commission = $(this).parents('.offer-from-traveller-page').find('.manual_traveller_commission').val();

      var c = new Calculator(price, commission);

      $(this).parents('.offer-from-traveller-page').find('.manual_transaction_charge').text( parseFloat(c.transaction_charge * 1 + c.fixed_transaction_charge * 1).toFixed(2) );
      $(this).parents('.offer-from-traveller-page').find('.manual_airposted_commission').text(c.commission_charge);
      $(this).parents('.offer-from-traveller-page').find('.manual_total').text(c.total);

    }
  }, '.offer-from-traveller-page .manual_price, .offer-from-traveller-page .manual_traveller_commission');

  $('.message-to-traveller-buyer').on('submit', function(e) {

    e.preventDefault();

    var form = $(this);

    $(form).find('.message').text('Sending message...');

    $.post($(form).attr('action'), $(form).serializeArray(), function(data) {
      $(form).find('.message').text(data);
    });

  });
  
  $('.advert .close').click(function(e){
    e.preventDefault();
    $(this).parents('.advert').fadeOut(1500, function(){ $(this).remove(); });
  });
  
  $('.floating-contact h4').click(function(e){
    e.preventDefault();
    $('.floating-contact form').toggle();
  });
  
  $(document).on({
    
    submit: function(e){
      
      e.preventDefault();
      
      var form  = $(this),
          url   = form.attr('action'),
          data  = form.serialize(),
          attr  = form.attr('offer'),
          li    = $('[offer-id="'+attr+'"]');
          
      form.find('input[type=submit]').val('processing..');
          
      $.post(url, data, function(data){
        
        li.replaceWith(data);
        
        form.find('input[type=submit]').val('Done');
        
        form.parents('.popover').remove();
        
        $('[data-toggle="popover"]').popover({ 'html' : true, 'viewport' : 'body' });
        
      });
      
    }
    
  }, '.counter-offer-popover, .reject-offer-popover');
  
  $(document).on({
    
    click: function(e){
      
      e.preventDefault();
      
      var source = $(this),
          url   = source.attr('href'),
          attr  = source.attr('offer'),
          li    = $('[offer-id="'+attr+'"]');
          
      source.text('processing..');
          
      $.get(url, function(data){
        
        li.replaceWith(data);
        
        $('[data-toggle="popover"]').popover({ 'html' : true, 'viewport' : 'body' });
        
      });
      
    }
    
  }, '.accept-offer');
  
  $('.login-signup').click(function(e){ e.preventDefault(); $( $(this).attr('data-target') ).modal('show'); });
  
  $('.toggle-profile').click(function(e){
    e.preventDefault();
    $('.profile-form').toggleClass('edit');
  });
  
  $('.inbox').click( mark_user_chat_read );
  
  $('.add-item-to-order').click(function(e){ e.preventDefault(); });
  
  $(document).on({ 
    
    click: function(e){
      e.preventDefault();
      $('.order-more').before( amazon_form );
      
      setTimeout(function(){
        $('.order-more').prev().find('select').select2();
      }, 1000);
      
      $('.order-more h2, .next-to-shipping').removeClass('hidden');
    }
    
    
  }, '.trigger-buy-from-amazon');
  
  $(document).on({ 
    
    click: function(e){
      e.preventDefault();
      $('.order-more').before( elsewhere_form );
      
      setTimeout(function(){
        $('.order-more').prev().find('select').select2();
      }, 1000);
      
      $('.order-more h2, .next-to-shipping').removeClass('hidden');
    }
    
  }, '.trigger-buy-from-elsewhere');
  
  
  $(document).on({
    click: function(e){
      e.preventDefault();
      $(this).parents('.product-picker').remove();
      if( $('.product-picker').length == 0 ) $('.order-more h2, .next-to-shipping').addClass('hidden');
    }
  }, '.del');
  
  
  $('.ajax-login').submit(function(e){
    
    e.preventDefault();
    
    var form = $(this),
        button = form.find('.login-button'),
        message = form.find('.login-message'),
        action = form.attr('login-url');
        
    message.text("");
    
    button.html(`<i class="fa fa-spin fa-spinner"></i> LOGGIN IN...`);
    
    $.post( action, form.serialize() ).success(function(data){
      
      message.text( data.message );
      
      if( data.result == 'success' ){
        
        button.html(`LOGGED IN`);
        
        window.location.href = data.url;
        
      } else if( data.result == 'failed' ){
        
        button.html(`LOG IN`);
        
      }
      
    }).error(function(data){
      
      message.text('Failed to authenticate. Cotact admin if the issue persists.');
      
      button.html(`RETRY LOG IN`);
      
    });
    
  });
  
  $('.ajax-signup').submit(function(e){
    
    e.preventDefault();
    
    var form = $(this),
        button = form.find('.signup-button'),
        message = form.find('.signup-message'),
        action = form.attr('sign-url');
        
    message.html("");
    
    button.html(`<i class="fa fa-spin fa-spinner"></i> Signing up...`);
    
    $.post( action, form.serialize() ).success(function(data){
      
      
      
      if( data.status == 'success' ){
        
        message.html( data.message );
        
        button.html(`SIGN UP SUCCESS.`);
        
        window.location.href = data.url;
        
      } else if( data.status == 'failed' ){
        
        button.html(`SIGN UP`);
        
        message.html( `<br /> <span class="blue-text">FAILED TO SIGN UP!</span> <br />` );
        
        data.message.forEach(function(v){
          
          message.append( "- " + v + "<br />" );
          
        });
        
      }
      
    }).error(function(data){
      
      message.html('Failed to Sign you up. Please check data and retry.');
      
      button.html(`SIGN UP`);
      
    });
        
    
  });
  
  $('.notification').click(function(){
    
    $.get('/user/notifications/mark-read');
    
    $(this).find('sup').html('0');
    
  });
  
});


$(window).load(function() {

  setTimeout(function() {

    populate_travellers_at_product_page();

    populate_products_at_traveller_page();
    
    chat_refresh();
    
    balance_height();

  }, 2000);

  tourguide_init();

});
//# sourceMappingURL=app.js.map
