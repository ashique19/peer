<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ordersStoreRequest extends Request
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
			 'status'     => '',
			 'no_of_products'     => '',
			 'product_cost'     => '',
			 'shipping_cost'     => '',
			 'airposted_margin'     => '',
			 'order_total'     => '',
			 'label_id'     => '',
			 'payment_id'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        