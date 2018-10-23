<div class="row replies">
    @if(\App\Offer::replyOf($offer->id)->count() > 0)
    <a class="btn btn-block" role="button" data-toggle="collapse" href="#reply{{$offer->id}}" aria-expanded="false" aria-controls="reply{{$offer->id}}">
      <i class="fa fa-caret-down green-text"></i> View logs and replies
    </a>
    <div class="col-xs-12 no-padding collapse" id="reply{{$offer->id}}">
    @foreach(\App\Offer::replyOf($offer->id)->get() as $reply)
        
        @if($reply->is_deleted == 1)
        <p class="alert">{{$reply->created_at->format('M d h:i')}} - Offer Rejected by @if($reply->is_offer_from_buyer == 1){{$reply->buyer->name}} @else {{$reply->traveller->name}} @endif . {{$reply->note}}</p>
        @else
        
        @if($reply->is_offer_from_traveller == 1)
        <p class="alert">{{$reply->created_at->format('M d h:i')}} - {{$reply->traveller->name}}: I will get this product for you for USD {{$reply->total_price}}.{{$reply->note}} @if($reply->is_agreed == 1)<span class="badge badge-success white-text pull-right">Offer accepted by buyer</span>@endif</p>
        @elseif($reply->is_offer_from_buyer == 1)
        <p class="alert">{{$reply->created_at->format('M d h:i')}} - {{$reply->buyer->name}}: Please bring me this product for USD {{$reply->total_price}}.{{$reply->note}} @if($agreed) @if($reply->is_agreed == 1)<span class="badge badge-info white-text pull-right">Offer accepted by me</span>@endif  @endif</p>
        @endif
        
        @endif

    @endforeach
    </div>
    @endif
</div>