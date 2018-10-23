
@extends('admin.layout')

@section('title') Buy @stop

@section('main')

<h1><center>All Product Request @if($buyers) : {{$buyers->total()}} @endif</center></h1>

{!! errors($errors) !!}

<section class="col-sm-12">
    

    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Name</th>
				<th class="blue-bg white-text">description</th>
				<th class="blue-bg white-text">Url</th>
                <th class="blue-bg white-text">Image</th>
                <th class="blue-bg white-text">Price</th>
				<th class="blue-bg white-text">Quantity</th>
				<th class="blue-bg white-text">From</th>
				<th class="blue-bg white-text">To</th>
				<th class="blue-bg white-text">Request by</th>
				<th class="blue-bg white-text">Created at</th>
                <th class="blue-bg white-text" width="50">Received</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($buyers)
                @foreach($buyers as $buyer)
                    <tr>
						<td>{{$buyer->id}}</td>
						<td>{{$buyer->title}}</td>
                        <td>{{$buyer->description}}</td>
						<td><a href="{{$buyer->url}}" class="btn btn-default btn-rounded btn-xs" target="_blank">open in new window</a></td>
                        <td>@if($buyer->image) <img src="{{$buyer->image}}" /> @endif</td>
                        <td>{{$buyer->price}}</td>
                        <td>{{$buyer->quantity}}</td>
                        <td>{{$buyer->from_country_id}}</td>
                        <td>{{$buyer->to_country_id}}</td>
						<td>@if($buyer->user) {{$buyer->user->name}} @endif</td>
						<td>{{$buyer->created_at->format('g:i a F j, y')}}</td>
                        <td>
                            <button class="btn btn-warning"><a href="{{route('update-product-status', ['id' => $buyer->id])}}">Received</a></button>
                        </td>
                        <td><button class="btn btn-danger"> x </button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $buyers->render() !!}
</section>


@stop
        