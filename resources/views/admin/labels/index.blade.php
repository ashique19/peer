
@extends('admin.layout')

@section('title') Label @stop

@section('main')

<h1><center>Labels @if($labels) : {{$labels->total()}} @endif</center></h1>

<section class="col-sm-10 col-sm-offset-1">
    
    {!! Form::open(['class'=>'form form-inline', 'method' =>'post', 'url'=> action('Labels@searchIndex')]) !!} 
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('is_paid', 'Is paid: ') !!}
            {!! Form::select('is_paid', [ ''=>'-Select-','1'=>'Yes', '0'=>'No'], old('is_paid') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_name', 'Buyer name: ') !!}
            {!! Form::text('buyer_name', old('buyer_name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_email', 'Buyer email: ') !!}
            {!! Form::text('buyer_email', old('buyer_email') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_phone', 'Buyer phone: ') !!}
            {!! Form::text('buyer_phone', old('buyer_phone') , ['class'=>'form-control']) !!}
        </div>
            
            
        <div class="form-group">
            {!! Form::label('buyer_stateProvince', 'Buyer stateProvince: ') !!}
            {!! Form::text('buyer_stateProvince', old('buyer_stateProvince') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('receiver_name', 'Receiver name: ') !!}
            {!! Form::text('receiver_name', old('receiver_name') , ['class'=>'form-control']) !!}
        </div>
            
            
        <div class="form-group">
            {!! Form::label('receiver_email', 'Receiver email: ') !!}
            {!! Form::text('receiver_email', old('receiver_email') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('receiver_phone', 'Receiver phone: ') !!}
            {!! Form::text('receiver_phone', old('receiver_phone') , ['class'=>'form-control']) !!}
        </div>
            
            
        <div class="form-group">
            {!! Form::label('receiver_countryCode', 'Receiver countryCode: ') !!}
            {!! Form::text('receiver_countryCode', old('receiver_countryCode') , ['class'=>'form-control']) !!}
        </div>
            
            
        <div class="form-group">
            {!! Form::label('shipperId', 'ShipperId: ') !!}
            {!! Form::text('shipperId', old('shipperId') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('shipmentId', 'ShipmentId: ') !!}
            {!! Form::text('shipmentId', old('shipmentId') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('parcelTrackingNumber', 'ParcelTrackingNumber: ') !!}
            {!! Form::text('parcelTrackingNumber', old('parcelTrackingNumber') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('from', 'From: ') !!}
            {!! Form::text('from', old('from') , ['class'=>'form-control datepicker']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('to', 'To: ') !!}
            {!! Form::text('to', old('to') , ['class'=>'form-control datepicker']) !!}
        </div>

        {!! Form::submit('search', ['class'=>'btn btn-info']) !!}
        
    {!! Form::close() !!}
    
    <hr>
</section>

{!! errors($errors) !!}

<section class="col-sm-10 col-sm-offset-1 scrollable">
    
    <table class="table table-responsive">
        <thead>
            <tr>
				<th class="blue-bg white-text">Id</th>
				<th class="blue-bg white-text">Name</th>
				<th class="blue-bg white-text">User</th>
				<th class="blue-bg white-text">Payment</th>
				<th class="blue-bg white-text">Is paid</th>
				<th class="blue-bg white-text">Buyer name</th>
				<th class="blue-bg white-text">Buyer company</th>
				<th class="blue-bg white-text">Buyer email</th>
				<th class="blue-bg white-text">Buyer phone</th>
				<th class="blue-bg white-text">Buyer residential</th>
				<th class="blue-bg white-text">Buyer addressLines</th>
				<th class="blue-bg white-text">Buyer cityTown</th>
				<th class="blue-bg white-text">Buyer stateProvince</th>
				<th class="blue-bg white-text">Buyer postalCode</th>
				<th class="blue-bg white-text">Buyer countryCode</th>
				<th class="blue-bg white-text">Receiver name</th>
				<th class="blue-bg white-text">Receiver company</th>
				<th class="blue-bg white-text">Receiver email</th>
				<th class="blue-bg white-text">Receiver phone</th>
				<th class="blue-bg white-text">Receiver residential</th>
				<th class="blue-bg white-text">Receiver addressLines</th>
				<th class="blue-bg white-text">Receiver cityTown</th>
				<th class="blue-bg white-text">Receiver stateProvince</th>
				<th class="blue-bg white-text">Receiver postalCode</th>
				<th class="blue-bg white-text">Receiver countryCode</th>
				<th class="blue-bg white-text">Parcel weight amount</th>
				<th class="blue-bg white-text">Parcel weight unitOfMeasurement</th>
				<th class="blue-bg white-text">Parcel dimension unitOfMeasurement</th>
				<th class="blue-bg white-text">Parcel dimension length</th>
				<th class="blue-bg white-text">Parcel dimension width</th>
				<th class="blue-bg white-text">Parcel dimension height</th>
				<th class="blue-bg white-text">Parcel dimension irregularParcelGirth</th>
				<th class="blue-bg white-text">Rates carrier</th>
				<th class="blue-bg white-text">Rates parcelType</th>
				<th class="blue-bg white-text">Rates serviceId</th>
				<th class="blue-bg white-text">Rates rateTypeId</th>
				<th class="blue-bg white-text">Rates deliveryCommitment minEstimatedNumberOfDays</th>
				<th class="blue-bg white-text">Rates deliveryCommitment maxEstimatedNumberOfDays</th>
				<th class="blue-bg white-text">Rates deliveryCommitment estimatedDeliveryDateTime</th>
				<th class="blue-bg white-text">Rates deliveryCommitment guarantee</th>
				<th class="blue-bg white-text">Rates deliveryCommitment additionalDetails</th>
				<th class="blue-bg white-text">Rates dimensionalWeight weight</th>
				<th class="blue-bg white-text">Rates dimensionalWeight unitOfMeasurement</th>
				<th class="blue-bg white-text">Rates baseCharge</th>
				<th class="blue-bg white-text">Rates totalCarrierCharge</th>
				<th class="blue-bg white-text">Rates alternateBaseCharge</th>
				<th class="blue-bg white-text">Rates currencyCode</th>
				<th class="blue-bg white-text">Rates destinationZone</th>
				<th class="blue-bg white-text">Rates alternateTotalCharge</th>
				<th class="blue-bg white-text">Documents type</th>
				<th class="blue-bg white-text">Documents contentType</th>
				<th class="blue-bg white-text">Documents fileFormat</th>
				<th class="blue-bg white-text">Documents contents</th>
				<th class="blue-bg white-text">ShipperId</th>
				<th class="blue-bg white-text">ShipmentId</th>
				<th class="blue-bg white-text">ParcelTrackingNumber</th>
				<th class="blue-bg white-text">Created at</th>
				<th class="blue-bg white-text">Updated at</th>
                <th class="blue-bg white-text" width="50">Show</th>
                <th class="blue-bg white-text" width="50">Modify</th>
                <th class="blue-bg white-text" width="50">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($labels)
                @foreach($labels as $label)
                    <tr>
						<td>{{$label->id}}</td>
						<td>{{$label->name}}</td>
						<td>@if($label->user) {{$label->user->name}} @endif</td>
						<td>@if($label->payment) {{$label->payment->name}} @endif</td>
						<td>{{yn($label->is_paid)}}</td>
						<td>{{$label->buyer_name}}</td>
						<td>{{$label->buyer_company}}</td>
						<td>{{$label->buyer_email}}</td>
						<td>{{$label->buyer_phone}}</td>
						<td>{{$label->buyer_residential}}</td>
						<td>{{$label->buyer_addressLines}}</td>
						<td>{{$label->buyer_cityTown}}</td>
						<td>{{$label->buyer_stateProvince}}</td>
						<td>{{$label->buyer_postalCode}}</td>
						<td>{{$label->buyer_countryCode}}</td>
						<td>{{$label->receiver_name}}</td>
						<td>{{$label->receiver_company}}</td>
						<td>{{$label->receiver_email}}</td>
						<td>{{$label->receiver_phone}}</td>
						<td>{{$label->receiver_residential}}</td>
						<td>{{$label->receiver_addressLines}}</td>
						<td>{{$label->receiver_cityTown}}</td>
						<td>{{$label->receiver_stateProvince}}</td>
						<td>{{$label->receiver_postalCode}}</td>
						<td>{{$label->receiver_countryCode}}</td>
						<td>{{$label->parcel_weight_amount}}</td>
						<td>{{$label->parcel_weight_unitOfMeasurement}}</td>
						<td>{{$label->parcel_dimension_unitOfMeasurement}}</td>
						<td>{{$label->parcel_dimension_length}}</td>
						<td>{{$label->parcel_dimension_width}}</td>
						<td>{{$label->parcel_dimension_height}}</td>
						<td>{{$label->parcel_dimension_irregularParcelGirth}}</td>
						<td>{{$label->rates_carrier}}</td>
						<td>{{$label->rates_parcelType}}</td>
						<td>{{$label->rates_serviceId}}</td>
						<td>{{$label->rates_rateTypeId}}</td>
						<td>{{$label->rates_deliveryCommitment_minEstimatedNumberOfDays}}</td>
						<td>{{$label->rates_deliveryCommitment_maxEstimatedNumberOfDays}}</td>
						<td>{{$label->rates_deliveryCommitment_estimatedDeliveryDateTime}}</td>
						<td>{{$label->rates_deliveryCommitment_guarantee}}</td>
						<td>{{$label->rates_deliveryCommitment_additionalDetails}}</td>
						<td>{{$label->rates_dimensionalWeight_weight}}</td>
						<td>{{$label->rates_dimensionalWeight_unitOfMeasurement}}</td>
						<td>{{$label->rates_baseCharge}}</td>
						<td>{{$label->rates_totalCarrierCharge}}</td>
						<td>{{$label->rates_alternateBaseCharge}}</td>
						<td>{{$label->rates_currencyCode}}</td>
						<td>{{$label->rates_destinationZone}}</td>
						<td>{{$label->rates_alternateTotalCharge}}</td>
						<td>{{$label->documents_type}}</td>
						<td>{{$label->documents_contentType}}</td>
						<td>{{$label->documents_fileFormat}}</td>
						<td>{{$label->documents_contents}}</td>
						<td>{{$label->shipperId}}</td>
						<td>{{$label->shipmentId}}</td>
						<td>{{$label->parcelTrackingNumber}}</td>
						<td>{{$label->created_at}}</td>
						<td>{{$label->updated_at}}</td>
                        <td>
                            {!! views('Labels', $label->id, '<span class=\'fa fa-expand\'></span>', ['class'=>'btn btn-success btn-rounded']) !!}
                        </td>
                        <td>
                            {!! edits('Labels', $label['id'], '<span class=\'fa fa-pencil\'></span>', ['class'=>'btn btn-warning btn-rounded']) !!}
                        </td>
                        <td>
                            {!! deletes('Labels', $label['id'], '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {!! $labels->render() !!}
</section>


@stop
        