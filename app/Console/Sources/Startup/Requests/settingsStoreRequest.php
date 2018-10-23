<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class settingsStoreRequest extends Request
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
			 'application_name'     => '',
			 'application_slogan'     => '',
			 'business_name'     => '',
			 'owners_name'     => '',
			 'address'     => '',
			 'city'     => '',
			 'country'     => '',
			 'postcode'     => '',
			 'contact'     => '',
			 'helpline'     => '',
			 'helpmail'     => '',
			 'email'     => '',
			 'logo_photo'     => '',
			 'icon_photo'     => '',
			 'google_plus'     => '',
			 'facebook'     => '',
			 'twitter'     => '',
			 'is_controlled_access'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        