
@extends('admin.layout')

@section('title') Offer @stop

@section('main')

<h1 class="page-title"><center>Offer</center></h1>

{!! errors($errors) !!}

@if($offer)
<section class="row panel-body">
    <table class="table table-bordered table-striped table-actions">
        <tdead>
            <tr>
                <td width="200">Title</td>
                <td>Details</td>
            </tr>
        </tdead>
        <tbody>
                <tr>
                    <td>Id</td>
                    <td>{{$offer->id}}</td>
                </tr>
                
                <tr>
                    <td>Product</td>
                    <td>{{$offer->name}}</td>
                </tr>
                
                <tr>
                    <td>Link</td>
                    <td>{{$offer->link}}</td>
                </tr>
                
                <tr>
                    <td>Image url</td>
                    <td><img src="{{$offer->image_url}}" alt="{{$offer->name}} Image" width="200" class="img-thumbnail"></td>
                </tr>
                
                <tr>
                    <td>Product price</td>
                    <td>{{$offer->product_price}}</td>
                </tr>
                
                <tr>
                    <td>Offer price</td>
                    <td>{{$offer->offer_price}}</td>
                </tr>
                
                <tr>
                    <td>Is reply</td>
                    <td>@if($offer->is_reply == 1)Yes @else No @endif</td>
                </tr>
                
                <tr>
                    <td>Reply of</td>
                    <td>{{$offer->reply_of}}</td>
                </tr>
                
                <tr>
                    <td>Is agreed</td>
                    <td>@if($offer->is_agreed == 1) Yes @else No @endif</td>
                </tr>
                
                <tr>
                    <td>Is offer from buyer</td>
                    <td>@if($offer->is_offer_from_buyer == 1) Yes @else No @endif</td>
                </tr>
                
                <tr>
                    <td>Is offer from traveller</td>
                    <td>@if($offer->is_offer_from_traveller == 1) Yes @else No @endif</td>
                </tr>
                
                <tr>
                    <td>Traveller</td>
                    <td>@if($offer->traveller) {{$offer->traveller->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Buyer</td>
                    <td>@if($offer->buyer) {{$offer->buyer->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Note</td>
                    <td>{{$offer->note}}</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$offer->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$offer->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Offers', $offer->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Offers', $offer->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@if($replies)
<section class="col-sm-10 col-sm-offset-1">
    
    <h2>Replies</h2>
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Buyer</th>
				<th class="blue-bg white-text">Traveler</th>
				<th class="blue-bg white-text">Agreed</th>
				<th class="blue-bg white-text">Price</th>
				<th class="blue-bg white-text">Trav</th>
				<th class="blue-bg white-text">Trans</th>
				<th class="blue-bg white-text">Airp</th>
				<th class="blue-bg white-text">Total</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($replies as $reply)

            <tr>
				<td>{{$reply->id}}</td>
                <td>@if($reply->buyer){{$reply->buyer->name}} @endif</td>
                <td>@if($reply->traveller){{$reply->traveller->name}} @endif</td>
                <td>{{yn($reply->is_agreed)}}</td>
                <td>{{$reply->product_price}}</td>
                <td>{{$reply->offer_price - $reply->product_price}}</td>
                <td>{{$reply->transaction_charge}}</td>
                <td>{{$reply->airposted_commission}}</td>
                <td>{{$reply->total_price}}</td>
                <td>
                    {!! views('Offers', $reply->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                </td>
                <td>
                    {!! edits('Offers', $reply['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                </td>
                <td>
                    {!! deletes('Offers', $reply['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
</section>
@endif

@else

    <h3>No data found.</h3>

@endif

@stop
        