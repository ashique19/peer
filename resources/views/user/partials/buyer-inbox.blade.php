@if( count( $messages ) > 0 )

@foreach( $messages as $message )
<li @if($message->message_from == auth()->user()->id) class="item left" @else class="item right" @endif at="{{$message->created_at}}" >
    <p class="bubble">
        @if( strlen( $message->chat_image ) > 5 ) <img src="{{$message->chat_image}}" alt="Image" /> @endif
        {{$message->name}}
        <span class="arrow"></span>
    </p>
    <p class="time">{{$message->created_at->format('M d H:i a')}}</p>
</li>
@endforeach

@else
<span class="no-message text-center">
    <img src="/public/img/settings/no-message.png" alt="No Messages yet">
    <h3>You haven't said Hi yet!</h3>
    <p>Start a conversation below.</p>
</span>
@endif