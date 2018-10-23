<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Helpers extends Controller
{
    
    public $public_page_settings = [
        
        'css'   => [
            
                    '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css',
                    '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css',
                    '/public/css/app.css'
            
        ],
        'js'    => [
                    
                    '//code.jquery.com/jquery-1.11.3.min.js',
                    '//code.jquery.com/ui/1.11.3/jquery-ui.min.js',
                    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.0/jquery.nicescroll.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js',
                    '/public/js/all.js',
                    
        ]
    ];
    
    public $admin_page_settings = [
        
        'css'   => [
            
                    '/public/css/theme-default.css',
                    '/public/css/base.css',
                    '/public/css/custom.css',
            
        ],
        'js'    => [
                    
                    '//code.jquery.com/jquery-1.11.3.min.js',
                    '//code.jquery.com/ui/1.11.3/jquery-ui.min.js',
                    '//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
                    '//cdn.jsdelivr.net/icheck/1.0.2/icheck.min.js',
                    '//cdn.jsdelivr.net/jquery.mcustomscrollbar/3.1.0/jquery.mCustomScrollbar.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.4/raphael-min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js',
                    '/public/js/plugins/rickshaw/d3.v3.js',
                    '//cdnjs.cloudflare.com/ajax/libs/rickshaw/1.5.1/rickshaw.min.js',
                    '/public/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
                    '/public/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
                    '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.12/daterangepicker.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js',
                    '//cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/js/bootstrap-timepicker.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.4/js/bootstrap-select.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/javascript-canvas-to-blob/2.2.4/js/canvas-to-blob.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.2.8/js/fileinput.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js',
                    '/public/js/plugins/scrolltotop/scrolltopcontrol.js',
                    '//cdnjs.cloudflare.com/ajax/libs/summernote/0.7.3/summernote.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.9.0/validator.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/jquery.lazyloadxt/1.1.0/jquery.lazyloadxt.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/jStorage/0.4.12/jstorage.min.js',
                    '//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js',
                    '/public/js/plugins.js',
                    '/public/js/actions.js',
                    '/public/js/custom.js'
                    
        ]
    ];
    
    
    
}
