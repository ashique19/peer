@extends('public.layouts.layout')
@section('title')Airposted - Shipping Simplified @stop
@section('main')
@include('user.partials.nav')

<section class="row user-panel">
    <div class="col-sm-10 col-sm-offset-1 xs-no-padding">
        
        <h1 class="section-heading black-text">Inbox | Offers</h1>
        
        {!! errors($errors) !!}
        
        <section class="row offer-inbox push-down-50">
            
            <div class="col-xs-4 col-sm-3 no-padding users">
                <ul class="maximized">
                    @include('user.partials.chat-offer-contact')
                </ul>
                <div class="btn-group row hidden-sm hidden-md hidden-lg xs-offer-inbox-toggler">
                    <button type="button" class="xs-user-toggler btn square-border" data-toggle="tooltip" data-placement="top" title="view list">
                        <i class="fa fa-navicon"></i>
                        <i class="fa fa-user"></i>
                    </button>
                    <button class="btn square-border xs-maximize-inbox">Inbox <span class="counter">0</span></button>
                    <button class="btn square-border xs-maximize-offers">Offers <span class="counter">0</span></button>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 no-padding inbox minimized">
                <h3>
                    <span>Messages</span> 
                    <img src="/public/img/settings/inbox.png" />
                </h3>
                <div class="list">

                    @if( count($contacts) > 0)
                    @foreach($contacts as $contact)

                    <ul class="msg-list" id="chat-list-{{$contact['id']}}" >
                        <p class="loading push-20"><i class="fa fa-spinner fa-spin"></i></p>
                    </ul>

                    @endforeach
                    @endif
                    
                    
                </div>
                <div class="type">
                    {!! Form::open([ 'id'=> 'msg_form']) !!}
                    <textarea name="name" id="msg" type="text" placeholder="Write a message..." ></textarea>
                    <p class="text-right send">
                        <span class="send-on-enter">
                            <input type="checkbox" id="send-on-enter" checked /> send on press "Enter"
                        </span>
                        <span class="img-upload" data-toggle="tooltip" data-placement="top" title="Send image">
                            <a href="#" type="button" class="btn btn-xs black-bg white-text" data-toggle="modal" data-target=".bs-example-modal-sm">
                                <i class="fa fa-camera"></i>
                            </a>
                            @section('bodyScope')
                            <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                              <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  </div>
                                  <div class="modal-body">
                                    {!! Form::open([ 'id'=> 'msg_img_form', 'enctype'=> "multipart/form-data" ]) !!}
                                    {!! Form::hidden('name', ' ') !!}
                                    <h2>Upload an image to your conversation</h2>
                                    <div class="image-container">
                                        <span class="preview">
                                            <img src="" id="chat_image_preview" alt="No File Choosen">
                                        </span>
                                        <input type="file" name="chat_image" id="chat_image" />
                                        <button type="submit" id="upload-chat-image" class="btn gray-border white-bg">Upload</button>
                                        <p class="small message"></p>
                                    </div>
                                    {!! Form::close() !!}
                                  </div>
                                </div>
                              </div>
                            </div>
                            @stop
                        </span>
                        <a href="#" id="post-message" class="btn btn-xs black-bg white-text">Send</a>
                    </p>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-5 no-padding offers minimized">
                <h3>
                    <span>Offers</span> 
                    <img src="/public/img/settings/offers.png">
                </h3>
                
                <div class="list">
                    
                    @if( count($contacts) > 0)
                    @foreach($contacts as $contact)
                    
                    <ul class="offer-list" id="offer-list-{{$contact['id']}}">
                        <p class="loading push-20"><i class="fa fa-spinner fa-spin"></i></p>
                    </ul>
                    
                    @endforeach
                    @endif
                    
                </div>
                
                <a href="#" class="toggle-inbox">
                    <i class="fa fa-angle-left"></i>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a href="#" class="toggle-offers">
                    <i class="fa fa-angle-left"></i>
                    <i class="fa fa-angle-right"></i>
                </a>
                
            </div>
            
        </section>
        
    </div>
</section>


@stop