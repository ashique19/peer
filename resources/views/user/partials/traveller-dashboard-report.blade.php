<section class="row user-dashboard user-panel">
    <div class="col-sm-10 col-sm-offset-1">
        
        <div class="row">
            <div class="col-sm-3 col-md-2">
                <ul class="user-action-ul">
                    <li class="user-actions active"><a href="{{route('userDashboard')}}" >Post</a></li>
                    <li class="user-actions"><a href="{{action('Travels@myActiveTravels')}}" >Active</a></li>
                    <li class="user-actions"><a href="{{action('Travels@myTravels')}}" >History</a></li>
                </ul>
            </div>
            
            <div class="col-sm-9 col-md-10">
                
                <div class="row">
                
                    <h1 class="section-heading blue-text">Welcome to Airposted {{auth()->user()->firstname}}!</h1>
                    <h2 class="section-heading black-text small-heading">Post a Trip</h2>
                    
                    @if( $errors->any() && ! $errors->has('user_type') )
                    <div class="row">
                    @foreach( $errors->all() as $error )
                    <p class="alert alert-info">{{ $error }}</p>
                    @endforeach
                    </div>
                    @endif
                    
                    {!! Form::open(['url'=> action('Travels@storeMyTravel'), 'class'=> 'travel-info-post blue-label']) !!}
                    <section class="row">
                        <div class="col-xs-6 col-sm-3">
                            {!! Form::label('departure_date', 'Departure date:') !!}
                            {!! Form::text('departure_date', old('departure_date'), ['class'=> 'form-control datepicker push-up-10', 'placeholder'=> 'Departure date', 'title'=> 'Departure date', 'required'=> 'required']) !!}
                        </div>
                        <div class="col-xs-6 col-sm-5">
                            {!! Form::label('country_from', 'Traveling from:') !!}
                            {!! Form::select('country_from', \App\Country::orderBy('name')->lists('name', 'id'), old('country_from'), ['class'=> 'form-control select2', 'placeholder'=> '- Please select -', 'required'=> 'required']) !!}
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            {!! Form::label('airport_from', 'Airport from:') !!}
                            {!! Form::select('airport_from', [], old('airport_from'), ['class'=> 'form-control airport-search', 'placeholder'=> '- Please select -', 'required'=> 'required']) !!}
                        </div>
                    </section>
                    <section class="row">
                        <div class="col-xs-6 col-sm-3">
                            {!! Form::label('arrival_date', 'Arrival date:') !!}
                            {!! Form::text('arrival_date', old('arrival_date'), ['class'=> 'form-control datepicker push-up-10', 'placeholder'=> 'Arrival date', 'title'=> 'Arrival date', 'required'=> 'required']) !!}
                        </div>
                        <div class="col-xs-6 col-sm-5">
                            {!! Form::label('country_to', 'Traveling to:') !!}
                            {!! Form::select('country_to', \App\Country::orderBy('name')->lists('name', 'id'), old('country_to'), ['class'=> 'form-control select2', 'placeholder'=> '- Please select -', 'required'=> 'required'    ]) !!}
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            {!! Form::label('airport_to', 'Airport to:') !!}
                            {!! Form::select('airport_to', [], old('airport_to'), ['class'=> 'form-control airport-search', 'placeholder'=> '- Please select -', 'required'=> 'required']) !!}
                        </div>
                    </section>
                    
                    <section class="row">
                    
                    @if( !auth()->user()->country_id )
                        <div class="col-xs-12 col-sm-8">
                            {!! Form::label('country', 'Your location:') !!}
                            {!! Form::select('country', \App\Country::lists('name', 'id'), auth()->user()->country_id, ['class'=> 'form-control select2', 'required'=> '', 'placeholder'=>'Please select']) !!}
                        </div>
                    @endif
                    
                        <div class="col-xs-12 col-sm-8">
                    @if( strlen( \App\User::find(auth()->user()->id)->contact ) < 5 )
                        {!! Form::label('contact', 'Your contact no. (mobile/landline) starting with country code:') !!}
                        
                        <div class="row inline">
                                
                        @if(auth()->user()->country)
                        {!! Form::select('country_code', \App\Country::orderBy('phone_code')->lists('phone_code','phone_code') , auth()->user()->country->phone_code, ['class'=> 'form-control push-up-10 country_code', 'placeholder'=> '-Country code-', 'required'=> 'required']) !!}
                        @else
                        {!! Form::select('country_code', \App\Country::orderBy('phone_code')->lists('phone_code','phone_code') , null, ['class'=> 'form-control push-up-10 country_code', 'placeholder'=> '-Country code-', 'required'=> 'required']) !!}
                        @endif
                        {!! Form::text('phone_no', null, ['class'=> 'form-control push-up-10 phone_no', 'placeholder'=> 'Phone number after country code', 'required'=> 'required']) !!}
                        
                        </div>
                        
                        <small class="help-block">For verification purpose only. Will not be visible to public.</small>
                    @endif
                        </div>
                    
                        <div class="col-xs-12 text-center">{!! Form::submit('Post Trip', ['class'=>'btn btn-lg orange-bg white-text']) !!}</div>

                    </section>
                    {!! Form::close() !!}
                    
                </div>
                
            </div>
            
        </div>
        
        
    </div>
</section>