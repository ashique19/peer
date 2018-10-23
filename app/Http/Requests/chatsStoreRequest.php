<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class chatsStoreRequest extends Request
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
			 'chat_image'     => '',
			 'message_from'     => '',
			 'message_to'     => '',
			 'is_read_by_from'     => '',
			 'is_read_by_to'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        