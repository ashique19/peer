<li class="item" offer-id="offer-list-{{$offer->id}}" at="{{$offer->updated_at}}">
    <p class="small">{{$offer->updated_at->format('M d H:i a')}}</p>
    <div class="details">
        <p>
            <a href="{{$offer->link}}" target="_blank">
                <b class="blue-text">
                    @if(strlen($offer->name) > 15){{substr($offer->name, 0, 16)}}... @else {{$offer->name}} @endif
                </b>
            </a>
        </p>
        <p>Traveler Fee</p>
        <p>Airposted Fee</p>
        <p>Paypal Fee</p>
        <p>
            <b>Total USD</b>
        </p>
    </div>
    <div class="costs">
        <p><b>${{$offer->product_price}}</b></p>
        <p>${{$offer->offer_price - $offer->product_price}} </p>
        <p>${{$offer->airposted_commission}} </p>
        <p>${{$offer->transaction_charge}}</p>
        <p><b>${{$offer->total_price}}</b></p>
    </div>
    <div class="actions">
        @include('user.partials.traveler-offer-actions')
    </div>
</li>