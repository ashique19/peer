<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserCreateRequest extends Request
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
            'username'          => 'unique:users',
            'email'             => 'required|email|unique:users',
            'password'          => 'required|min:4|alpha_num',
            'role'              => 'numeric',
            'firstname'         => 'min:1',
            'lastname'          => 'min:1',
            'contact'           => 'numeric',
            'address'           => 'min:3',
            'city'              => 'min:2',
            'state'             => 'min:2',
            'postcode'          => 'min:1',
            'country'           => 'min:2',
            'parmanent_address' => 'min:5',
            'active'            => 'numeric',
            'picture'           => 'mimes:jpeg,jpg,png,gif,svg',
        ];
    }
}
