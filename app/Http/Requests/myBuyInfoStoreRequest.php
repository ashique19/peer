<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class myBuyInfoStoreRequest extends Request
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
            'country_id'    => 'required',
            'name'          => 'required',
            'amazon_url'    => 'url',
            'other_url'     => 'url',
            'category_id'   => 'required|integer',
            'phone_no'      => 'integer|min:5'
        ];
    }
}
