<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class offersStoreRequest extends Request
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
			 'link'     => '',
			 'image_url'     => '',
			 'product_price'     => '',
			 'offer_price'     => '',
			 'is_reply'     => '',
			 'reply_of'     => '',
			 'is_agreed'     => '',
			 'is_offer_from_buyer'     => '',
			 'is_offer_from_traveller'     => '',
			 'traveller_id'     => '',
			 'buyer_id'     => '',
			 'note'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        