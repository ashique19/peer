@if( count($offers->where('traveller_id', $contact['id'])) > 0 )
@foreach( $offers->where('traveller_id', $contact['id']) as $offer )

@include('user.partials.buyer-offer')

@endforeach
@endif