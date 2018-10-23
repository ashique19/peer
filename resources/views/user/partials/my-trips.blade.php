<section class="row white-bg scrollable">
                    
    <h2 class=" push-up-30">My Trips</h2>
    
    <table class="table table-responsive table-theme-1">
        <thead>
            <tr>
                <th>Edit</th>
                <th>From</th>
                <th>To</th>
                <th>Arrival date</th>
                <th>Departure date</th>
            </tr>
        </thead>
        <tbody>
            
            @if( auth()->user()->tripPosts()->count() > 0 )
            @foreach(auth()->user()->tripPosts()->latest()->take(50)->get() as $myTravel)
            
            <tr>
                <td>
                    @if($myTravel->departure_date < \Carbon::now()->addDay(1))Date Expired 
                    @else 
                        @if($myTravel->is_active == 1)
                        {!! Form::open(['url'=> action('Travels@deactivateTravel', $myTravel->id), 'method'=> 'POST']) !!}
                        {!! Form::hidden('id', $myTravel->id) !!}
                        <button class="btn transparent-bg orange-border btn-rounded btn-xs" role="button" type="submit">Deactivate</button>
                        {!! Form::close() !!}
                        @else
                        {!! Form::open(['url'=> action('Travels@activateTravel', $myTravel->id), 'method'=> 'POST']) !!}
                        {!! Form::hidden('id', $myTravel->id) !!}
                        <button class="btn transparent-bg green-border btn-rounded btn-xs" role="button" type="submit">Activate</button>
                        {!! Form::close() !!}
                        @endif 
                    @endif
                </td>
                <td>
                    @if($myTravel->airportFrom){{$myTravel->airportFrom->name}}@endif
                </td>
                <td>
                    @if($myTravel->airportTo){{$myTravel->airportTo->name}}@endif
                </td>
                <td>{{$myTravel->arrival_date->format('Y-m-d')}}</td>
                <td>{{$myTravel->departure_date->format('Y-m-d')}}</td>
            </tr>
            
            @endforeach
            @endif
            
        </tbody>
    </table>
    
</section>
