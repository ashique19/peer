<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class myProfileUpdateRequest extends Request
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
            'email'         => 'email',
            'firstname'     => 'required',
            'lastname'      => 'required',
            'picture'       => 'image',
            'country_code'  => 'required',
            'phone_no'      => 'required|min:5'
        ];
    }
}
