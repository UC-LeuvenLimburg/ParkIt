<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:150',
            'email' => 'email:rfc,dns',
            'password' => 'string|min:8|max:128',
            'role' => 'string|min:1|max:150',
        ];
    }
}
