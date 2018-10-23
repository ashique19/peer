<!DOCTYPE html>
<html lang="en" class=" theme2">
    <head>        
        <!-- META SECTION -->
        <title>@yield('title')</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="made-with-love-by" content="Md Emranul Hadi; Email: emranulhadi@gmail.com ;">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="google-site-verification" content="K0P1SYNMmerq8I26kzHUi_Xv3vM-v59o46rwDJkoxv0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="dns-prefetch" href="//code.jquery.com" />
        <link rel="dns-prefetch" href="//maxcdn.bootstrapcdn.com">
        <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
        <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
        <link rel="dns-prefetch" href="//connect.facebook.net">
        <link rel="dns-prefetch" href="//www.googletagmanager.com">
        <link rel="dns-prefetch" href="//static.ak.facebook.com">
        <link rel="dns-prefetch" href="//s-static.ak.facebook.com">
        <link rel="dns-prefetch" href="//www.google-analytics.com">
        <link rel="dns-prefetch" href="//www.facebook.com">
        <link rel="canonical" 	 href="{{route('home')}}"/>
        @yield('meta')
        
        <link rel="shortcut icon" type="image/png" href="{{settings()->icon_photo}}"/>
        <!-- END META SECTION -->
        
    <!-- CSS INCLUDE -->
        
        <?php
        
            $settings   = ( new \App\Http\Controllers\Helpers )->public_page_settings;
            
        ?>
        
        @if(count($settings['css']) > 0)
            @foreach($settings['css'] as $css)
                <link rel="stylesheet" type="text/css" href="{!! $css !!}"/>
            @endforeach
        @endif
        
        <style type="text/css">
            #sidebar .vendor .vendor-img .link{
                width: auto !important;
            }
            
            .for-buyer-traveler-modal{
                max-width: 380px;
                margin: 5% auto;
            }
            
            .for-buyer-traveler-modal .modal-content{
                border: 0px transparent;
            }
            
            .for-buyer-traveler-modal button{
                padding: 7px 30px;
                font-size: 16px;
                background-color: #F27F2C;
                border-color: #F27F2C;
            }
            
            .for-buyer-traveler-modal .modal-content .modal-body{
                padding: 0px;
            }
            
            .for-buyer-traveler-modal .modal-content .modal-body .detail{
                padding: 20px;
                text-align: center;
                font-size: 16px;
                color: #8f8f95;
            }
            
            .for-buyer-traveler-modal .modal-content img{
                width: 100%;
            }
            
            .thumbnail:hover .hover-icon-eye{
                right: calc( 50% - 20px ) !important;
                top: 25% !important;
            }
            
            .white-text{
                color: white !important;
            }
            
            .margin-0{
                margin: 0px;
            }
            
            .margin-left-0{
                margin-left: 0px;
            }
            
            .margin-right-0{
                margin-right: 0px;
            }
            
            .padding-0{
                padding: 0px;
            }
            
            .red-text{
                color: red !important;
            }
            
            .black-text{
                color: black !important;
            }
            
        </style>
        
        @yield('css')
    <!-- EOF CSS INCLUDE -->                               


    <!-- START SCRIPTS -->
        
        @if(count($settings['js']) > 0)
            @foreach($settings['js'] as $js)
                <script type="text/javascript" src="{!! $js !!}"></script>
            @endforeach
        @endif
        
        
        @yield('js')
        
        <script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "Organization",
          "url": "https://airposted.com",
          "contactPoint": [{
            "@type": "ContactPoint",
            "email": "{{\App\Setting::first()->helpmail}}",
            "url": "{{action('StaticPageController@contact')}}",
            "contactType": "customer service"
          }]
        }
        </script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126397691-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-126397691-1');
    </script>
    <script>
        ROOT_URL = '{{url('/')}}' + '/';
        ASSET_DIR = 'public/img/peerposted/images/';
        DEFAULT_IMAGE = '{{asset('public/product/photo_not_available.png')}}';
        
//        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
//
//        ga('create', 'UA-83032242-1', 'auto');
//        ga('send', 'pageview');
        
        
//        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
//        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
//        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
//        $.src="https://v2.zopim.com/?4U5PhJSIRJyhuAhnXe8xxOAlbYJoa85J";z.t=+new Date;$.
//        type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");

        
    </script>

    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top">
            <span class="charges hidden" charges='{ "commission_rate": {{settings()->commission}}, "transaction_charge_rate": {{settings()->transaction_charge}}, "fixed_transaction_charge": 0.30  }' ></span>
            <!-- PAGE CONTENT -->
            <div class="page-content">

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                @yield('main')
                @include('public.footers.footer')
        
                </div>
                <!-- PAGE CONTENT WRAPPER -->                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        @yield('bodyScope')
        
        @if( ! auth()->user() )
        
            @include('public.partials.login_modal')
            
            @include('public.partials.signup_modal')
        
        @endif
        
        @yield('footer-js')
        
    </body>
</html>

