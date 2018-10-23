<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class categoriesStoreRequest extends Request
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
			 'search_index'     => '',
			 'is_active'     => '',
			 'is_at_homepage'     => '',
			 'amazon_node'     => '',
			 'category_photo'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        