<?php

namespace NanokaWeb\AsyncGame\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'email|max:255',
            'facebook_user_id' => 'required|int',
            'picture'          => 'required|string|max:255',
        ];
    }
}
