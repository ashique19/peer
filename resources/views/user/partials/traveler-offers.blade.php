@if( count($offers->where('buyer_id', $contact['id'])) > 0 )
@foreach( $offers->where('buyer_id', $contact['id']) as $offer )

@include('user.partials.traveler-offer')

@endforeach
@endif