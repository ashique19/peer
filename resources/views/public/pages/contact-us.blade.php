@extends('public.layouts.layout')
@section('title')@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif- Contact us. @stop

@section('meta')
    <meta name="title" content="Airposted - Contact us">
    <meta name="description" content="Contact Airposted over mail, phone or in person.">
    <meta name="keywords" content="Airposted, contact">
@stop

@section('main')

<section class="row contact-page">
    <div class="col-sm-10 col-sm-offset-1 no-padding">
        
    <h1>Contact Us</h1>
    
    <section class="col-xs-12 push-down-50">
        <section class="col-xs-12">
            
            <p class="text-center">
                Hi there! If you have any thoughts, questions or concerns, please send us a message - we'd love to hear from you.
            </p>
            
            {!! Form::open(['url'=> action('StaticPageController@postContact'), 'class'=> 'col-sm-6 col-sm-offset-3']) !!}
            
            @if($errors->any())
            @foreach($errors->all() as $error)
            <p class="alert blue-bg white-text">{{$error}}</p>
            @endforeach
            @endif
            
            <div class="col-xs-6 form-group">
                <input name="name" required type="text" class="form-control white-bg blue-text" placeholder="Name" value="{!! old('name') !!}" required="required" >
            </div>
            <div class="col-xs-6 form-group">
                <input name="email" required type="text" class="form-control white-bg blue-text" placeholder="Email" value="{!! old('email') !!}" required="required" >
            </div>
            <div class="col-xs-12 form-group">
                <input name="subject" required type="text" class="form-control white-bg blue-text" placeholder="Subject" value="{!! old('subject') !!}" required="required" >
            </div>
            <div class="col-xs-12 form-group">
                <textarea name="detail" required row="20" type="text" class="form-control white-bg blue-text" placeholder="Message" value="{!! old('message') !!}" required="required" ></textarea>
            </div>
            <div class="col-xs-12 form-group">
                <button type="submit" class="btn btn-lg orange-bg white-text white-text pull-right">Send</button>
            </div>
            
            {!! Form::close() !!}
        </section>
        
        
    </section>
    
    </div>
</section>

@stop