
@extends('admin.layout')

@section('title') Create new Label @stop

@section('main')

<h1 class="page-title blue-bg white-text"><center>Labels</center></h1>

{!! errors($errors) !!}

<section class="col-sm-6 col-sm-offset-3">

<h3>Create Label</h3>


{!! Form::open( ['url'=> action('Labels@store'), 'enctype'=>'multipart/form-data' ]) !!}

    
        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', old('name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('user_id', 'User: ') !!}
            {!! Form::select('user_id', \App\User::lists('name', 'id'), old('user_id') , ['class'=>'form-control select2']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('payment_id', 'Payment: ') !!}
            {!! Form::select('payment_id', \App\Payment::lists('name', 'id'), old('payment_id') , ['class'=>'form-control select2']) !!}
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
            {!! Form::label('buyer_company', 'Buyer company: ') !!}
            {!! Form::text('buyer_company', old('buyer_company') , ['class'=>'form-control']) !!}
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
            {!! Form::label('buyer_residential', 'Buyer residential: ') !!}
            {!! Form::text('buyer_residential', old('buyer_residential') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_addressLines', 'Buyer addressLines: ') !!}
            {!! Form::text('buyer_addressLines', old('buyer_addressLines') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_cityTown', 'Buyer cityTown: ') !!}
            {!! Form::text('buyer_cityTown', old('buyer_cityTown') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_stateProvince', 'Buyer stateProvince: ') !!}
            {!! Form::text('buyer_stateProvince', old('buyer_stateProvince') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_postalCode', 'Buyer postalCode: ') !!}
            {!! Form::text('buyer_postalCode', old('buyer_postalCode') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('buyer_countryCode', 'Buyer countryCode: ') !!}
            {!! Form::text('buyer_countryCode', old('buyer_countryCode') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('receiver_name', 'Receiver name: ') !!}
            {!! Form::text('receiver_name', old('receiver_name') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('receiver_company', 'Receiver company: ') !!}
            {!! Form::text('receiver_company', old('receiver_company') , ['class'=>'form-control']) !!}
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
            {!! Form::label('receiver_residential', 'Receiver residential: ') !!}
            {!! Form::text('receiver_residential', old('receiver_residential') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('receiver_addressLines', 'Receiver addressLines: ') !!}
            {!! Form::text('receiver_addressLines', old('receiver_addressLines') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('receiver_cityTown', 'Receiver cityTown: ') !!}
            {!! Form::text('receiver_cityTown', old('receiver_cityTown') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('receiver_stateProvince', 'Receiver stateProvince: ') !!}
            {!! Form::text('receiver_stateProvince', old('receiver_stateProvince') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('receiver_postalCode', 'Receiver postalCode: ') !!}
            {!! Form::text('receiver_postalCode', old('receiver_postalCode') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('receiver_countryCode', 'Receiver countryCode: ') !!}
            {!! Form::text('receiver_countryCode', old('receiver_countryCode') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('parcel_weight_amount', 'Parcel weight amount: ') !!}
            {!! Form::text('parcel_weight_amount', old('parcel_weight_amount') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('parcel_weight_unitOfMeasurement', 'Parcel weight unitOfMeasurement: ') !!}
            {!! Form::text('parcel_weight_unitOfMeasurement', old('parcel_weight_unitOfMeasurement') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('parcel_dimension_unitOfMeasurement', 'Parcel dimension unitOfMeasurement: ') !!}
            {!! Form::text('parcel_dimension_unitOfMeasurement', old('parcel_dimension_unitOfMeasurement') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('parcel_dimension_length', 'Parcel dimension length: ') !!}
            {!! Form::text('parcel_dimension_length', old('parcel_dimension_length') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('parcel_dimension_width', 'Parcel dimension width: ') !!}
            {!! Form::text('parcel_dimension_width', old('parcel_dimension_width') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('parcel_dimension_height', 'Parcel dimension height: ') !!}
            {!! Form::text('parcel_dimension_height', old('parcel_dimension_height') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('parcel_dimension_irregularParcelGirth', 'Parcel dimension irregularParcelGirth: ') !!}
            {!! Form::text('parcel_dimension_irregularParcelGirth', old('parcel_dimension_irregularParcelGirth') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_carrier', 'Rates carrier: ') !!}
            {!! Form::text('rates_carrier', old('rates_carrier') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_parcelType', 'Rates parcelType: ') !!}
            {!! Form::text('rates_parcelType', old('rates_parcelType') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_serviceId', 'Rates serviceId: ') !!}
            {!! Form::text('rates_serviceId', old('rates_serviceId') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_rateTypeId', 'Rates rateTypeId: ') !!}
            {!! Form::text('rates_rateTypeId', old('rates_rateTypeId') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_deliveryCommitment_minEstimatedNumberOfDays', 'Rates deliveryCommitment minEstimatedNumberOfDays: ') !!}
            {!! Form::text('rates_deliveryCommitment_minEstimatedNumberOfDays', old('rates_deliveryCommitment_minEstimatedNumberOfDays') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_deliveryCommitment_maxEstimatedNumberOfDays', 'Rates deliveryCommitment maxEstimatedNumberOfDays: ') !!}
            {!! Form::text('rates_deliveryCommitment_maxEstimatedNumberOfDays', old('rates_deliveryCommitment_maxEstimatedNumberOfDays') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_deliveryCommitment_estimatedDeliveryDateTime', 'Rates deliveryCommitment estimatedDeliveryDateTime: ') !!}
            {!! Form::text('rates_deliveryCommitment_estimatedDeliveryDateTime', old('rates_deliveryCommitment_estimatedDeliveryDateTime') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_deliveryCommitment_guarantee', 'Rates deliveryCommitment guarantee: ') !!}
            {!! Form::text('rates_deliveryCommitment_guarantee', old('rates_deliveryCommitment_guarantee') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_deliveryCommitment_additionalDetails', 'Rates deliveryCommitment additionalDetails: ') !!}
            {!! Form::text('rates_deliveryCommitment_additionalDetails', old('rates_deliveryCommitment_additionalDetails') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_dimensionalWeight_weight', 'Rates dimensionalWeight weight: ') !!}
            {!! Form::text('rates_dimensionalWeight_weight', old('rates_dimensionalWeight_weight') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_dimensionalWeight_unitOfMeasurement', 'Rates dimensionalWeight unitOfMeasurement: ') !!}
            {!! Form::text('rates_dimensionalWeight_unitOfMeasurement', old('rates_dimensionalWeight_unitOfMeasurement') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_baseCharge', 'Rates baseCharge: ') !!}
            {!! Form::text('rates_baseCharge', old('rates_baseCharge') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_totalCarrierCharge', 'Rates totalCarrierCharge: ') !!}
            {!! Form::text('rates_totalCarrierCharge', old('rates_totalCarrierCharge') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_alternateBaseCharge', 'Rates alternateBaseCharge: ') !!}
            {!! Form::text('rates_alternateBaseCharge', old('rates_alternateBaseCharge') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_currencyCode', 'Rates currencyCode: ') !!}
            {!! Form::text('rates_currencyCode', old('rates_currencyCode') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_destinationZone', 'Rates destinationZone: ') !!}
            {!! Form::text('rates_destinationZone', old('rates_destinationZone') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('rates_alternateTotalCharge', 'Rates alternateTotalCharge: ') !!}
            {!! Form::text('rates_alternateTotalCharge', old('rates_alternateTotalCharge') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('documents_type', 'Documents type: ') !!}
            {!! Form::text('documents_type', old('documents_type') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('documents_contentType', 'Documents contentType: ') !!}
            {!! Form::text('documents_contentType', old('documents_contentType') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('documents_fileFormat', 'Documents fileFormat: ') !!}
            {!! Form::text('documents_fileFormat', old('documents_fileFormat') , ['class'=>'form-control']) !!}
        </div>
            
        <div class="form-group">
            {!! Form::label('documents_contents', 'Documents contents: ') !!}
            {!! Form::text('documents_contents', old('documents_contents') , ['class'=>'form-control']) !!}
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
        {!! Form::submit('Save Label', ['class'=>'form-control btn btn-info']) !!}
    </div>

{!! Form::close() !!}


</section>

@stop
        