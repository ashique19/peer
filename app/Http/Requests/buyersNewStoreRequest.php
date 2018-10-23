<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class buyersNewStoreRequest extends Request
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
			 'title'     => '',
			 'price'     => '',
			 'url'     => '',
			 'image'     => '',
			 'quantity'     => '',
			 'description'     => '',
			 'from_country_id'     => '',
			 'from_address' => '',
			 'from_state' => '',
			 'from_zip' => '',
			 'to_country_id'     => '',
			 'to_address' => '',
			 'to_state' => '',
			 'to_zip' => '',
			 'user_id'     => ''
        ];
    }
}

        