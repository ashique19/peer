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

            {!! Form::open(['role'=>'form', 'class'=>'form', 'url'=>action('MyProfile@update'), 'enctype'=>'multipart/form-data']) !!}
            <li class="list-group-item active"><center><strong>My Profile</strong></center></li>
            <li class="list-group-item"><span class="profile-details-heading">First Name:</span> {!! Form::text('firstname', auth()->user()->firstname, ['class'=>'form-control']) !!}</li>
            <li class="list-group-item"><span class="profile-details-heading">Last Name:</span> {!! Form::text('lastname', auth()->user()->lastname, ['class'=>'form-control']) !!}</li>
            <li class="list-group-item"><span class="profile-details-heading">Email:</span> {!! Form::text('email', auth()->user()->email, ['class'=> 'form-control']) !!} </li>                                
            <li class="list-group-item"><span class="profile-details-heading">Contact:</span> {!! Form::text('contact', auth()->user()->contact , ['class'=>'form-control']) !!} </li>
            <li class="list-group-item"><span class="profile-details-heading">Present Address:</span> {!! Form::text('address', auth()->user()->address , ['class'=>'form-control']) !!} </li>
            <li class="list-group-item"><span class="profile-details-heading">City:</span> {!! Form::text('city', auth()->user()->city , ['class'=>'form-control']) !!} </li>
            <li class="list-group-item"><span class="profile-details-heading">State:</span> {!! Form::text('state', auth()->user()->state , ['class'=>'form-control']) !!} </li>
            <li class="list-group-item"><span class="profile-details-heading">Postcode:</span> {!! Form::text('postcode', auth()->user()->postcode , ['class'=>'form-control']) !!} </li>
            <li class="list-group-item"><span class="profile-details-heading">Country:</span> {!! Form::select('country', \App\Country::lists('name', 'id'), auth()->user()->country_id , ['class'=>'form-control']) !!} </li>
            <li class="list-group-item"><span class="profile-details-heading">Parmanent Address:</span> {!! Form::text('parmanent_address', auth()->user()->parmanent_address , ['class'=>'form-control']) !!} </li>
            <li class="list-group-item"><span class="profile-details-heading">Photo:</span> {!! Form::file('picture', ['class'=>'form-control']) !!} </li>
            <li class="list-group-item"><center><strong>{!! Form::submit('Update', ['class'=>'btn btn-info']) !!}</strong></center></li>
            {!! Form::close() !!}
        </div>
    </div>
    
</div>

@stop

