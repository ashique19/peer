@extends('public.layouts.layout')
@section('title')@if(\App\Setting::find(1)){{\App\Setting::find(1)->application_name}}@else Application name @endif- Contact us. @stop
@section('js')
    <script type="text/javascript" src="/public/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="/public/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
@stop
@section('main')

<section class="col-xs-12 col-sm-8 main-body">
    <h1><br><center>Contact us</center><br></h1>
    
    <section class="col-sm-6">
        <section class="col-xs-12">
            <h2><center>Write to us</center></h2>
            {!! Form::open(['class'=>'form-horizontal','role'=>'form']) !!}
            
            <div class="form-group">
                <label class="col-md-2 control-label">Details</label>
                <div class="col-md-10">
                    <textarea type="text" class="form-control" row="10" placeholder="All that you want to say..."></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Your name</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Enter your full name">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Your email</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Enter your email">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label">Your phone</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Enter your contact number">
                </div>
            </div>
            
            <div class="form-group">
                <center>{!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}</center>
            </div>
            
            {!! Form::close() !!}
        </section>
        
        
    </section>
    <section class="col-sm-6">
        <h2><center>Find us here</center></h2>
        
        <div class="panel-body contact-info">
            @if(\App\Setting::first())
            <div class="panel-body contact-info">
                <h6>Address: {{\App\Setting::first()->address}}</h6>
                <h6>City: {{\App\Setting::first()->city}}</h6>
                <h6>Country: {{\App\Setting::first()->country}}</h6>
                <h6>Postcode: {{\App\Setting::first()->postcode}}</h6>
                <br>
                <br>
                <h6>Phone: {{\App\Setting::first()->helpline}}</h6>
                <h6>Email: {{\App\Setting::first()->helpmail}}</h6>
            </div>
            @endif
        </div>
    </section>
    
    <section class="col-xs-12">
        <h1><br><br><center>Visit us sometime. We hangout here-</center></h1>                    
        <div class="panel panel-default">
            <div class="panel-body panel-body-map">
                <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ23cSxsHAVTcRWS4OcziI0cc&key=AIzaSyB0sRwwrD5geUNiLvx19Omsc1xNBQMtV28" allowfullscreen></iframe>
            </div>
        </div>
    </section>
    
</section>

@stop