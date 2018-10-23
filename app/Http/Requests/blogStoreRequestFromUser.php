<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class blogStoreRequestFromUser extends Request
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
            
            'name'              => 'required|min:4',
            'category_id'       => 'required|integer',
            'banner_photos'     => 'required',
            'short_description' => 'required',
            'details'           => 'required',
            
        ];
    }
}
