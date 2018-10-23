<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class buyersStoreRequest extends Request
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
			 'amazon_url'     => '',
			 'other_url'     => '',
			 'price'     => '',
			 'country_id'     => '',
			 'user_id'     => '',
			 'category_id'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        