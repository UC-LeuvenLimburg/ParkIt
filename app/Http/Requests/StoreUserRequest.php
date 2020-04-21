<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string|min:8|max:128',
            'role' => 'required|string|min:1|max:150',
        ];
    }

    /**
     * Validate request
     * @return Illuminate\Foundation\Http\FormRequest::getValidatorInstance
     */
    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function () {
            // todo custom validation for user
        });
    }
}
