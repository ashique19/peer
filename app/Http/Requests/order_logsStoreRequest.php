<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class order_logsStoreRequest extends Request
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
			 'user_id'     => '',
			 'created_by'     => '',
			 'updated_by'     => '',
			 'log_detail'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        