@if( count( $messages ) > 0 )

@foreach( $messages as $message )
<li @if($message->message_from == auth()->user()->id) class="item right" @else class="item left" @if($message->is_read_by_to == 0) unread @endif @endif at="{{$message->created_at}}" >
    <p class="bubble">
        @if( strlen( $message->chat_image ) > 5 ) <img src="{{$message->chat_image}}" alt="Image" /> @endif
        {{$message->name}}
        <span class="arrow"></span>
    </p>
    <p class="time">{{$message->created_at->format('M d H:i a')}}</p>
</li>
@endforeach

@endif