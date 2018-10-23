@extends('admin.layout')

@section('main')


<div class="col-md-3">
                            
    <div class="panel panel-default">
        <div class="panel-body profile profile-bg" >
            <div class="profile-image">
                <img src="{{auth()->user()->photo}}" alt="{{auth()->user()->name}}">
            </div>
            <div class="profile-data">
                <div class="profile-data-name">{{auth()->user()->name}}</div>
                <div class="profile-data-title" style="color: #FFF;">{{auth()->user()->roles->name}}</div>
            </div>
        </div>        
        <div class="panel-body list-group border-bottom">
            <a href="{{action('MyProfile@show')}}" class="list-group-item active"><span class="fa fa-bar-chart-o"></span> My Profile</a>
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

            {!! Form::open(['role'=>'form', 'class'=>'form', 'url'=>action('MyProfile@updatePassword'), 'enctype'=>'multipart/form-data']) !!}
            <li class="list-group-item active"><center><strong>Change Password</strong></center></li>
            <li class="list-group-item"><span class="profile-details-heading">Old Password:</span> {!! Form::password('oldpass', ['class'=>'form-control']) !!}</li>
            <li class="list-group-item"><span class="profile-details-heading">New Password:</span> {!! Form::password('newpass', ['class'=>'form-control']) !!}</li>
            <li class="list-group-item"><span class="profile-details-heading">Repeat Password:</span> {!! Form::password('repeatpass', ['class'=> 'form-control']) !!} </li>                                
            <li class="list-group-item"><center><strong>{!! Form::submit('Update', ['class'=>'btn btn-info']) !!}</strong></center></li>
            {!! Form::close() !!}
        </div>
    </div>
    
</div>

@stop

