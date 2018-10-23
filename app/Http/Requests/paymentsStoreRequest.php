<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class paymentsStoreRequest extends Request
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
			 'offer_id'     => '',
			 'buyer_id'     => '',
			 'traveller_id'     => '',
			 'from_country_id'     => '',
			 'to_country_id'     => '',
			 'product_price'     => '',
			 'agreed_price'     => '',
			 'airposted_commission'     => '',
			 'payment'     => '',
			 'gateway_id'     => '',
			 'status'     => '',
			 'is_delivered'     => '',
			 'gateway_payment_id'     => '',
			 'gateway_payer_id'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        