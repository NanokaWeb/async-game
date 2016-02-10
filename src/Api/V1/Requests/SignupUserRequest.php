<?php

namespace NanokaWeb\AsyncGame\Api\V1\Requests;

use Dingo\Api\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class SignupUserRequest extends FormRequest
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
        return Config::get('async-game.signup_fields_rules');
    }
}
