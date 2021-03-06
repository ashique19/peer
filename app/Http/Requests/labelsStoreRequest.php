<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class labelsStoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'     => '',
			 'name'     => '',
			 'user_id'     => '',
			 'payment_id'     => '',
			 'is_paid'     => '',
			 'buyer_name'     => '',
			 'buyer_company'     => '',
			 'buyer_email'     => '',
			 'buyer_phone'     => '',
			 'buyer_residential'     => '',
			 'buyer_addressLines'     => '',
			 'buyer_cityTown'     => '',
			 'buyer_stateProvince'     => '',
			 'buyer_postalCode'     => '',
			 'buyer_countryCode'     => '',
			 'receiver_name'     => '',
			 'receiver_company'     => '',
			 'receiver_email'     => '',
			 'receiver_phone'     => '',
			 'receiver_residential'     => '',
			 'receiver_addressLines'     => '',
			 'receiver_cityTown'     => '',
			 'receiver_stateProvince'     => '',
			 'receiver_postalCode'     => '',
			 'receiver_countryCode'     => '',
			 'parcel_weight_amount'     => '',
			 'parcel_weight_unitOfMeasurement'     => '',
			 'parcel_dimension_unitOfMeasurement'     => '',
			 'parcel_dimension_length'     => '',
			 'parcel_dimension_width'     => '',
			 'parcel_dimension_height'     => '',
			 'parcel_dimension_irregularParcelGirth'     => '',
			 'rates_carrier'     => '',
			 'rates_parcelType'     => '',
			 'rates_serviceId'     => '',
			 'rates_rateTypeId'     => '',
			 'rates_deliveryCommitment_minEstimatedNumberOfDays'     => '',
			 'rates_deliveryCommitment_maxEstimatedNumberOfDays'     => '',
			 'rates_deliveryCommitment_estimatedDeliveryDateTime'     => '',
			 'rates_deliveryCommitment_guarantee'     => '',
			 'rates_deliveryCommitment_additionalDetails'     => '',
			 'rates_dimensionalWeight_weight'     => '',
			 'rates_dimensionalWeight_unitOfMeasurement'     => '',
			 'rates_baseCharge'     => '',
			 'rates_totalCarrierCharge'     => '',
			 'rates_alternateBaseCharge'     => '',
			 'rates_currencyCode'     => '',
			 'rates_destinationZone'     => '',
			 'rates_alternateTotalCharge'     => '',
			 'documents_type'     => '',
			 'documents_contentType'     => '',
			 'documents_fileFormat'     => '',
			 'documents_contents'     => '',
			 'shipperId'     => '',
			 'shipmentId'     => '',
			 'parcelTrackingNumber'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        