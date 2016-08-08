<?php

namespace App\Http\Requests\Issue;

use App\Http\Requests\Request;

class CreateRequest extends Request
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
            'title' => 'string|required',
            'service' => 'string|required',
            'issue_type' => 'string|required',
            'detail' => 'string|required'
        ];
    }
}
