@if($offer->is_agreed == 1)

    @if($offer->payment)
        
        @if($offer->payment->status > 1)
            <a href="{{action('Payments@traveller')}}" class="btn btn-sm gray-border gray-text">Paid (view)</a>
        @else
            <a href="{{action('Payments@traveller')}}" class="btn btn-sm green-border green-text">Accepted</a>
            <a href="{{action('Payments@traveller')}}" class="btn btn-sm orange-border orange-text">Unpaid</a>
        @endif
        
    @endif
    
@elseif($offer->is_deleted == 1)

    <a href="#" class="btn btn-sm blue-border blue-text">Rejected</a>

@else
    
    <!--
    <a  type="button" 
        class="btn btn-sm orange-border orange-text" 
        tabindex="0" 
        data-toggle="popover" 
        data-placement="bottom" 
        title='<h4 class="text-center">Make an offer</h4>' 
        data-content='
            {!! Form::open(["url"=> action("TravelerOffers@storeCounter", [$offer->buyer_id, $offer->id] ), "class"=> "counter-offer-popover text-center", "offer"=> "offer-list-".$offer->id ]) !!} 
            <p>
                ${!! Form::text("traveller_commission", null, ["placeholder"=> "New Offer"]) !!} 
            </p>
            {!! Form::submit("Send", ["class"=> "btn btn-xs orange-border orange-bg white-text"]) !!} 
            {!! Form::close() !!} ' 
    >Counter</a>
    -->
    
    
    @if($offer->is_offer_from_buyer == 1)
        
        <a href="{{action('TravelerOffers@accept', $offer->buyer_id)}}" class="btn btn-sm green-border green-text accept-offer" offer="offer-list-{{$offer->buyer_id}}">Accept</a>
        <a  typr="button" 
            class="btn btn-sm blue-border blue-text" 
            tabindex="0" 
            data-toggle="popover" 
            data-placement="top" 
            data-content='
                {!! Form::open(["url"=> action("TravelerOffers@reject", $offer->buyer_id ), "class"=> "reject-offer-popover text-center", "offer"=> "offer-list-".$offer->buyer_id ]) !!} 
                <p>Reason for rejecting</p>
                <p>
                    {!! Form::text("note", null, ["placeholder"=> "Type in..", "required"=> "required" ]) !!} 
                </p>
                {!! Form::submit("Reject", ["class"=> "btn btn-xs orange-border orange-bg white-text"]) !!} 
                {!! Form::close() !!} ' 
        >Reject</a>
        
    @endif

@endif

@if(strlen($offer->note) > 0)
<p class="small">Note: {{$offer->note}}</p>
@endif