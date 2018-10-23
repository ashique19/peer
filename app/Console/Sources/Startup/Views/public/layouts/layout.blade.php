
<!DOCTYPE html>
<html lang="en" class="nicescroll">
    <head>        
        <!-- META SECTION -->
        <title>@yield('title')</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="Md Ashiqul Islam; Email: ashique19@gmail.com; Phone: +880-178-563-6359">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="dns-prefetch" href="//code.jquery.com" />
        <link rel="dns-prefetch" href="//maxcdn.bootstrapcdn.com">
        <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
        <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
        <link rel="dns-prefetch" href="//googleads.g.doubleclick.net">
        <link rel="dns-prefetch" href="//www.google.com">
        <link rel="dns-prefetch" href="//d2ny3614h1j67q.cloudfront.net">
        <link rel="dns-prefetch" href="//connect.facebook.net">
        <link rel="dns-prefetch" href="//www.googletagmanager.com">
        <link rel="dns-prefetch" href="//static.ak.facebook.com">
        <link rel="dns-prefetch" href="//s-static.ak.facebook.com">
        <link rel="dns-prefetch" href="//www.google-analytics.com">
        <link rel="dns-prefetch" href="//www.facebook.com">
        <link rel="dns-prefetch" href="//www.googleadservices.com">
        <link rel="dns-prefetch" href="//cm.g.doubleclick.net">
        <link rel="dns-prefetch" href="//googleads.g.doubleclick.net">
        <link rel="dns-prefetch" href="//www.google.com">
        <link rel="canonical" 	 href="{{$_SERVER['SERVER_NAME']}}"/>
        @yield('meta')
        
        <?php
        
            $helper     = new \App\Http\Controllers\Helpers;
            $settings   = $helper->public_page_settings;
            $app        = \App\Setting::first();
            
        ?>

        <link rel="shortcut icon" type="image/png" href="{{$app->icon_photo}}"/>

    <!-- END META SECTION -->
        
    <!-- CSS INCLUDE -->
        
        @if(count($settings['css']) > 0)
            @foreach($settings['css'] as $css)
                <link rel="stylesheet" type="text/css" id="theme" href="{{ $css }}"/>
            @endforeach
        @endif
        
        @yield('css')
    <!-- EOF CSS INCLUDE -->                               


    <!-- START SCRIPTS -->
        
        @if(count($settings['js']) > 0)
            @foreach($settings['js'] as $js)
                <script type="text/javascript" src="{{ $js }}"></script>
            @endforeach
        @endif
        
        
        @yield('js')
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS --> 


    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <section class="page-container page-navigation-top">            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <!-- END X-NAVIGATION VERTICAL -->                     
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                    
                    <main class="row">
                        @include('public.navs.topbar')
                        @yield('main')
                        @include('public.footers.footer')
                    </main>
                
                </div>
                <!-- PAGE CONTENT WRAPPER -->                
            </div>            
            <!-- END PAGE CONTENT -->
        </section>
        <!-- END PAGE CONTAINER -->




    </body>
</html>

        