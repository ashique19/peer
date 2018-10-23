<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class travelsStoreRequest extends Request
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
			 'arrival_date'     => 'required|date',
			 'departure_date'   => 'required|date',
			 'country_from'     => 'required|integer',
			 'country_to'       => 'required|integer',
			 'airport_from'     => 'required',
			 'airport_to'       => 'required',
			 'phone_no'         => 'integer|min:5'
        ];
    }
}

        