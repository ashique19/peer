<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class commentsStoreRequest extends Request
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
			 'user_id'     => '',
			 'blog_id'     => '',
			 'is_published'     => '',
			 'is_reply'     => '',
			 'comment_id'     => '',
			 'commenter_name'     => '',
			 'commenter_email'     => '',
			 'created_at'     => '',
			 'updated_at'      => ''
        ];
    }
}

        