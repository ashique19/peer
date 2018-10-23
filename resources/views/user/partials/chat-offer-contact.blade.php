<p class="small hidden-sm hidden-md hidden-lg">Tap to show inbox/offer</p>
@if( count($contacts) > 0)
@foreach($contacts as $contact)
<li>
    <a  href="#" 
        
        @if( session('user_type') == 'buyer' )
        
            @if( $contact['chat'] > 0 || $contact['offer'] > 0 )
            
            class="contact unread"
            
            @else
            
            class="contact"
            
            @endif
            
        @else
        
            @if( $contact['chat'] > 0 || $contact['offer'] > 0 )
            
            class="contact unread"
            
            @else
            
            class="contact"
            
            @endif
        
        @endif
        
        id="contact-id-{{$contact['id']}}" 
        message="chat-list-{{$contact['id']}}" 
        offer="offer-list-{{$contact['id']}}" >
        <img @if(strlen(trim($contact['user_photo'])) > 0) data-src="{{xs_fb(xs_link($contact['user_photo']))}}" @endif alt="View Profile">
        <p>
            @if( session('user_type') == 'buyer' )
            <b traveler-href="{{action('Travels@travellerDetails', $contact['id'])}}">{{$contact['firstname']}}</b>
            <span>Traveler</span>
            @else
            <b traveler-href="{{action('Buyers@details', $contact['id'])}}">{{$contact['firstname']}}</b>
            <span>Buyer</span>
            @endif
            <span class="chat-offer-counter">
                <i class="count-chat fa fa-comment">{{$contact['chat']}}</i>&nbsp;|&nbsp;<i class="count-offer fa fa-usd">{{$contact['offer']}}</i>
            </span>
        </p>
    </a>
</li>
@endforeach
@endif