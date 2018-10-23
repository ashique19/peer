<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class order_productsStoreRequest extends Request
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
			 'order_id'     => '',
			 'source'     => '',
			 'product_url'     => '',
			 'category_id'     => '',
			 'price'     => '',
			 'height'     => '',
			 'width'     => '',
			 'length'     => '',
			 'weight'     => '',
			 'dimension_unit'     => '',
			 'weight_unit'     => '',
			 'product_image'     => '',
			 'quantity'     => '',
			 'note'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        