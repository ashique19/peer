@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        {!! errors($errors) !!}
        
        <div class="col-xs-12 no-padding">
            
            <div class="col-sm-3 no-padding">
                <ul class="user-action-ul profile-nav">
                    <li class="user-actions">
                        <img src="{{auth()->user()->user_photo}}" alt="Profile Photo" class="img-responsive profile-img">
                        <p>
                            <small>
                                <a href="{{action('UserAccounts@modify')}}">Edit Account</a>
                                <a href="#" data-toggle="modal" data-target=".modify-profile-image">Add/Edit Photo</a>
                                
                                @section('bodyScope')
                                <div class="modal fade modify-profile-image" tabindex="-1" role="dialog" aria-labelledby="modify-profile-image">
                                  <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      </div>
                                      <div class="modal-body">
                                        {!! Form::open([ 'url'=> action('UserAccounts@replaceProfileImage'), 'id'=> 'update-profile-image', 'enctype'=> "multipart/form-data" ]) !!}
                                        {!! Form::hidden('name', ' ') !!}
                                        <h2>Upload an image to your conversation</h2>
                                        <div class="image-container">
                                            <span class="preview">
                                                <img src="" id="chat_image_preview" alt="No File Choosen">
                                            </span>
                                            <input type="file" name="user_photo" id="chat_image" />
                                            <button type="submit" class="btn gray-border white-bg">Upload</button>
                                            <p class="small message"></p>
                                        </div>
                                        {!! Form::close() !!}
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                @stop
                                
                            </small>
                        </p>
                    </li>
                    <li class="user-actions">
                        <a href="{{action('UserAccounts@modify')}}">{{auth()->user()->city}}, {{auth()->user()->state}} @if(auth()->user()->country){{auth()->user()->country->name}} @endif <i class="fa fa-pencil gray-text"></i></a>
                    </li>
                </ul>
            </div>
            
            <div class="col-sm-9 push-up-80 form-theme-1">
                <section class="row white-bg">
            
                    <h1>Hey, I'm {{auth()->user()->name}} !</h1>
                    <h4 class=" pull-5">Member since {{auth()->user()->created_at->format('F Y')}}</h4>
                    
                    {!! Form::open(['class'=> 'form-horizontal profile-form', 'url'=> action('MyProfile@update'), 'enctype'=> 'multipart/form-data' ]) !!}
                    
                    <h2 class=" push-up-30">
                        About me 
                        <a href="#" class="toggle-profile"><i class="fa fa-pencil gray-text"></i></a>
                    </h2>
                    <div class="form-group">
                        <div class="col-sm-10">
                        {!! Form::hidden('firstname', auth()->user()->firstname) !!}
                        {!! Form::hidden('lastname', auth()->user()->lastname) !!}
                        {!! Form::hidden('country_code', '+') !!}
                        {!! Form::hidden('phone_no', auth()->user()->contact ? substr( auth()->user()->contact, 1 ) : ' ' ) !!}
                        {!! Form::hidden('country_id', auth()->user()->country_id) !!}
                        {!! Form::textarea('note', auth()->user()->note, ['class'=> 'form-control', 'placeholder'=> 'Here you can add a quick description of yourself so airposted users can get to interact and know you!' ]) !!}
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-8 col-sm-offset-4 profile-submit">
                        {!! Form::submit('Update', ['class'=> 'btn btn-lg orange-bg white-text']) !!}
                    </div>
                    
                    {!! Form::close() !!}
                    
                </section>
                
                @if( session('user_type') == 'buyer' )
                    
                    @include('user.partials.my-buys')
                    
                @elseif(session('user_type') == 'traveller')
                    
                    @include('user.partials.my-trips')
                    
                @endif
                
            </div>
            
        </div>
        
        
        
    </div>
</section>


@stop