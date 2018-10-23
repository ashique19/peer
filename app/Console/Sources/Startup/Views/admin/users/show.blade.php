@extends('admin.layout')

@section('main')

<div class="col-md-12">
    <div class="panel panel-default">
        
        @if($user)
            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title">User details: {{$user->firstname}} {{$user->lastname}}</h3>
                @if($user->user_photo)
                <img src="{{$user->user_photo}}" alt="{{$user->firstname}} {{$user->lastname}}" class="img-responsive thumb-xs">
                @endif
            </div>
    
            <div class="panel-body panel-body-table">
    
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-actions">
                        <tdead>
                            <tr>
                                <td width="200">title</td>
                                <td width="">Details</td>
                            </tr>
                        </tdead>
                        <tbody>
                            <tr>
                                <td>Serial</td>
                                <td>{{$user->id}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>@if($user->roles){{$user->roles->name}} @endif</td>
                            </tr>
                            <tr>
                                <td>First name</td>
                                <td>{{$user->firstname}}</td>
                            </tr>
                            <tr>
                                <td>Last name</td>
                                <td>{{$user->lastname}}</td>
                            </tr>
                            <tr>
                                <td>Contact</td>
                                <td>{{$user->contact}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$user->address}}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$user->city}}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td>{{$user->state}}</td>
                            </tr>
                            <tr>
                                <td>Postcode</td>
                                <td>{{$user->postcode}}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>{{$user->country}}</td>
                            </tr>
                            <tr>
                                <td>Permanent address</td>
                                <td>{{$user->parmanent_address}}</td>
                            </tr>
                            <tr>
                                <td>Expiry date</td>
                                <td>{{$user->expiry_date}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($user->active == 1)<span class="badge badge-success">Active</span>
                                    @elseif($user->active == 2) <span class="badge badge-danger">Inactive</span>
                                    @elseif($user->active == 3) <span class="badge badge-warning">Unverified</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Balance</td>
                                <td>{{$user->balance}}</td>
                            </tr>
                            <tr>
                                <td>Refferer</td>
                                <td>@if($user->referrer_id) <a href="{{action('Users@show',\App\User::find($user->referrer_id)->pluck('id'))}}" class="btn btn-info">{{\App\User::find($user->referrer_id)->pluck('name')}}</a> @endif</td>
                            </tr>
                            <tr>
                                <td>Created at</td>
                                <td>{{$user->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Updated at</td>
                                <td>{{$user->updated_at}}</td>
                            </tr>
                            <tr>
                                <td><a href="{{action('Users@edit', $user->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    {!! Form::open(['url'=>action('Users@destroy', $user->id), 'method'=>'DELETE']) !!}
                                    {!! Form::hidden('id',$user->id) !!}
                                    <button class="btn btn-info btn-sm"> <i class="fa fa-trash-o"></i> </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>                                
    
            </div>
        
        @endif
    </div>                                                

</div>


@stop