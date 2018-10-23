<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class notificationsStoreRequest extends Request
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
			 'notification_from'    => 'integer',
			 'notification_to'      => 'required|integer',
			 'name'                 => 'required|min:2',
			 'link'                 => 'min:2',
        ];
    }
}

        