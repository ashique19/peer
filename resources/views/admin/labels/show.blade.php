
@extends('admin.layout')

@section('title') Label @stop

@section('main')

<h1 class="page-title"><center>Label</center></h1>

{!! errors($errors) !!}

@if($label)
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
                    <td>{{$label->id}}</td>
                </tr>
                
                <tr>
                    <td>Name</td>
                    <td>{{$label->name}}</td>
                </tr>
                
                <tr>
                    <td>User</td>
                    <td>@if($label->user) {{$label->user->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Payment</td>
                    <td>@if($label->payment) {{$label->payment->name}} @endif</td>
                </tr>
                
                <tr>
                    <td>Is paid</td>
                    <td>{{$label->is_paid}}</td>
                </tr>
                
                <tr>
                    <td>Buyer name</td>
                    <td>{{$label->buyer_name}}</td>
                </tr>
                
                <tr>
                    <td>Buyer company</td>
                    <td>{{$label->buyer_company}}</td>
                </tr>
                
                <tr>
                    <td>Buyer email</td>
                    <td>{{$label->buyer_email}}</td>
                </tr>
                
                <tr>
                    <td>Buyer phone</td>
                    <td>{{$label->buyer_phone}}</td>
                </tr>
                
                <tr>
                    <td>Buyer residential</td>
                    <td>{{$label->buyer_residential}}</td>
                </tr>
                
                <tr>
                    <td>Buyer addressLines</td>
                    <td>{{$label->buyer_addressLines}}</td>
                </tr>
                
                <tr>
                    <td>Buyer cityTown</td>
                    <td>{{$label->buyer_cityTown}}</td>
                </tr>
                
                <tr>
                    <td>Buyer stateProvince</td>
                    <td>{{$label->buyer_stateProvince}}</td>
                </tr>
                
                <tr>
                    <td>Buyer postalCode</td>
                    <td>{{$label->buyer_postalCode}}</td>
                </tr>
                
                <tr>
                    <td>Buyer countryCode</td>
                    <td>{{$label->buyer_countryCode}}</td>
                </tr>
                
                <tr>
                    <td>Receiver name</td>
                    <td>{{$label->receiver_name}}</td>
                </tr>
                
                <tr>
                    <td>Receiver company</td>
                    <td>{{$label->receiver_company}}</td>
                </tr>
                
                <tr>
                    <td>Receiver email</td>
                    <td>{{$label->receiver_email}}</td>
                </tr>
                
                <tr>
                    <td>Receiver phone</td>
                    <td>{{$label->receiver_phone}}</td>
                </tr>
                
                <tr>
                    <td>Receiver residential</td>
                    <td>{{$label->receiver_residential}}</td>
                </tr>
                
                <tr>
                    <td>Receiver addressLines</td>
                    <td>{{$label->receiver_addressLines}}</td>
                </tr>
                
                <tr>
                    <td>Receiver cityTown</td>
                    <td>{{$label->receiver_cityTown}}</td>
                </tr>
                
                <tr>
                    <td>Receiver stateProvince</td>
                    <td>{{$label->receiver_stateProvince}}</td>
                </tr>
                
                <tr>
                    <td>Receiver postalCode</td>
                    <td>{{$label->receiver_postalCode}}</td>
                </tr>
                
                <tr>
                    <td>Receiver countryCode</td>
                    <td>{{$label->receiver_countryCode}}</td>
                </tr>
                
                <tr>
                    <td>Parcel weight amount</td>
                    <td>{{$label->parcel_weight_amount}}</td>
                </tr>
                
                <tr>
                    <td>Parcel weight unitOfMeasurement</td>
                    <td>{{$label->parcel_weight_unitOfMeasurement}}</td>
                </tr>
                
                <tr>
                    <td>Parcel dimension unitOfMeasurement</td>
                    <td>{{$label->parcel_dimension_unitOfMeasurement}}</td>
                </tr>
                
                <tr>
                    <td>Parcel dimension length</td>
                    <td>{{$label->parcel_dimension_length}}</td>
                </tr>
                
                <tr>
                    <td>Parcel dimension width</td>
                    <td>{{$label->parcel_dimension_width}}</td>
                </tr>
                
                <tr>
                    <td>Parcel dimension height</td>
                    <td>{{$label->parcel_dimension_height}}</td>
                </tr>
                
                <tr>
                    <td>Parcel dimension irregularParcelGirth</td>
                    <td>{{$label->parcel_dimension_irregularParcelGirth}}</td>
                </tr>
                
                <tr>
                    <td>Rates carrier</td>
                    <td>{{$label->rates_carrier}}</td>
                </tr>
                
                <tr>
                    <td>Rates parcelType</td>
                    <td>{{$label->rates_parcelType}}</td>
                </tr>
                
                <tr>
                    <td>Rates serviceId</td>
                    <td>{{$label->rates_serviceId}}</td>
                </tr>
                
                <tr>
                    <td>Rates rateTypeId</td>
                    <td>{{$label->rates_rateTypeId}}</td>
                </tr>
                
                <tr>
                    <td>Rates deliveryCommitment minEstimatedNumberOfDays</td>
                    <td>{{$label->rates_deliveryCommitment_minEstimatedNumberOfDays}}</td>
                </tr>
                
                <tr>
                    <td>Rates deliveryCommitment maxEstimatedNumberOfDays</td>
                    <td>{{$label->rates_deliveryCommitment_maxEstimatedNumberOfDays}}</td>
                </tr>
                
                <tr>
                    <td>Rates deliveryCommitment estimatedDeliveryDateTime</td>
                    <td>{{$label->rates_deliveryCommitment_estimatedDeliveryDateTime}}</td>
                </tr>
                
                <tr>
                    <td>Rates deliveryCommitment guarantee</td>
                    <td>{{$label->rates_deliveryCommitment_guarantee}}</td>
                </tr>
                
                <tr>
                    <td>Rates deliveryCommitment additionalDetails</td>
                    <td>{{$label->rates_deliveryCommitment_additionalDetails}}</td>
                </tr>
                
                <tr>
                    <td>Rates dimensionalWeight weight</td>
                    <td>{{$label->rates_dimensionalWeight_weight}}</td>
                </tr>
                
                <tr>
                    <td>Rates dimensionalWeight unitOfMeasurement</td>
                    <td>{{$label->rates_dimensionalWeight_unitOfMeasurement}}</td>
                </tr>
                
                <tr>
                    <td>Rates baseCharge</td>
                    <td>{{$label->rates_baseCharge}}</td>
                </tr>
                
                <tr>
                    <td>Rates totalCarrierCharge</td>
                    <td>{{$label->rates_totalCarrierCharge}}</td>
                </tr>
                
                <tr>
                    <td>Rates alternateBaseCharge</td>
                    <td>{{$label->rates_alternateBaseCharge}}</td>
                </tr>
                
                <tr>
                    <td>Rates currencyCode</td>
                    <td>{{$label->rates_currencyCode}}</td>
                </tr>
                
                <tr>
                    <td>Rates destinationZone</td>
                    <td>{{$label->rates_destinationZone}}</td>
                </tr>
                
                <tr>
                    <td>Rates alternateTotalCharge</td>
                    <td>{{$label->rates_alternateTotalCharge}}</td>
                </tr>
                
                <tr>
                    <td>Documents type</td>
                    <td>{{$label->documents_type}}</td>
                </tr>
                
                <tr>
                    <td>Documents contentType</td>
                    <td>{{$label->documents_contentType}}</td>
                </tr>
                
                <tr>
                    <td>Documents fileFormat</td>
                    <td>{{$label->documents_fileFormat}}</td>
                </tr>
                
                <tr>
                    <td>Documents contents</td>
                    <td>{{$label->documents_contents}}</td>
                </tr>
                
                <tr>
                    <td>ShipperId</td>
                    <td>{{$label->shipperId}}</td>
                </tr>
                
                <tr>
                    <td>ShipmentId</td>
                    <td>{{$label->shipmentId}}</td>
                </tr>
                
                <tr>
                    <td>ParcelTrackingNumber</td>
                    <td>{{$label->parcelTrackingNumber}}</td>
                </tr>
                
                <tr>
                    <td>Created at</td>
                    <td>{{$label->created_at}}</td>
                </tr>
                
                <tr>
                    <td>Updated at</td>
                    <td>{{$label->updated_at}}</td>
                </tr>
                
            <tr>
                <td>
                    {!! edits('Labels', $label->id, 'edit', ['class'=>'btn btn-warning btn-rounded']) !!}
                            
                </td>
                <td>
                    {!! deletes('Labels', $label->id, '<span class=\'fa fa-times\'></span>', ['class'=>'btn btn-danger btn-rounded']) !!}
                </td>
            </tr>
        </tbody>
    </table>
</section>

@else

    <h3>No data found.</h3>

@endif

@stop
        