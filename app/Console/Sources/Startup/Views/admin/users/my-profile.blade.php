@extends('admin.layout')

@section('main')


<div class="col-md-3">
                            
    <div class="panel panel-default">
        <div class="panel-body profile profile-bg" >
            <div class="profile-image">
                <img src="{{auth()->user()->user_photo}}" alt="{{auth()->user()->name}}">
            </div>
            <div class="profile-data">
                <div class="profile-data-name">{{auth()->user()->name}}</div>
                <div class="profile-data-title" style="color: #FFF;">{{auth()->user()->roles->name}}</div>
            </div>
        </div>        
        <div class="panel-body list-group border-bottom">
            <a href="{{action('MyProfile@show')}}" class="list-group-item"><span class="fa fa-bar-chart-o"></span> My Profile</a>
            <a href="{{action('MyProfile@changePassword')}}" class="list-group-item"><span class="fa fa-coffee"></span> Change Password</a>                                
            <a href="#" class="list-group-item mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Logout</a>
        </div>
    </div>                            
    
</div>

<div class="col-md-9">
    
    <div class="panel panel-default">
        <div class="panel-body list-group border-bottom">
            
            @if($errors->any())
    
                <ul>
                    @foreach($errors->all() as $error)
                    
                        <li>{{$error}}</li>
                    
                    @endforeach
                </ul>
            
            @endif
            
            <li class="list-group-item active"><center><strong>My Profile</strong></center></li>
            <li class="list-group-item"><span class="profile-details-heading">Name:</span> {{auth()->user()->name}}</li>
            <li class="list-group-item"><span class="profile-details-heading">Email:</span> {{auth()->user()->email}}</li>                                
            <li class="list-group-item"><span class="profile-details-heading">Role/Designation:</span> {{auth()->user()->roles->name}}</li>
            <li class="list-group-item"><span class="profile-details-heading">Contact:</span> {{auth()->user()->contact}}</li>
            <li class="list-group-item"><span class="profile-details-heading">Present Address:</span> {{auth()->user()->address}}</li>
            <li class="list-group-item"><span class="profile-details-heading">City:</span> {{auth()->user()->city}}</li>
            <li class="list-group-item"><span class="profile-details-heading">State:</span> {{auth()->user()->state}}</li>
            <li class="list-group-item"><span class="profile-details-heading">Postcode:</span> {{auth()->user()->postcode}}</li>
            <li class="list-group-item"><span class="profile-details-heading">Country:</span> {{auth()->user()->country}}</li>
            <li class="list-group-item"><span class="profile-details-heading">Parmanent Address:</span> {{auth()->user()->parmanent_address}}</li>
            <li class="list-group-item"><center><strong><a href="{{action('MyProfile@edit')}}" class="btn btn-primary">Edit</a> <a href="{{action('MyProfile@changePassword')}}" class="btn btn-primary">Change Password</a></strong></center></li>
        </div>
    </div>
    
</div>

@stop

