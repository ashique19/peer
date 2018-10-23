
<?php
    $leftnav_parents    = session('leftnav_parent');
    $leftnav_children   = json_decode(json_encode(session('leftnav_child')), true);
?>

<!-- START PAGE SIDEBAR -->
<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="{{route('dashboard')}}">Home</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-title">Navigation</li>
        <li class="active">
            <a href="{{route('dashboard')}}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
        </li>
        @if($leftnav_parents)
            @foreach($leftnav_parents as $nav)
                @if(array_search($nav->id, array_column($leftnav_children,'parent')) > -1)
                    <li class="xn-openable">
                        <a href="#"><span class="{{$nav->icon}}"></span> <span class="xn-text">{{$nav->name}}</span></a>
                        <ul>
                            @foreach($leftnav_children as $child)
                                @if($child['parent'] == $nav->id)
                                    <li><a href="{{url($child['route'])}}"><span class="{{$child['icon']}}"></span>{{$child['name']}}</a></li>
                                @endif
                            @endforeach                        
                        </ul>
                    </li>
                @else
                
                    <li class="active">
                        <a href="{{$nav->route}}"><span class="{{$nav->icon}}"></span> <span class="xn-text">{{$nav->name}}</span></a>                        
                    </li>
                
                @endif
            @endforeach
        @endif
        
        
    </ul>
    <!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->
