<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class label_productsStoreRequest extends Request
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
			 'label_id'     => '',
			 'name'     => '',
			 'quantity'     => '',
			 'weight'     => '',
			 'value'     => '',
			 'country_id'     => '',
			 'hs_tarrif'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        