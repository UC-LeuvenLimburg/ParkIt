<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Sanitize before rules()
     */
    protected function sanitizeInput()
    {
        $input = $this->all();
        $input['name'] = preg_replace("~[\p{M}]~uis", "", $this->input('name'));
        $this->replace($input);
    }

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
            'role' => 'string|min:1|max:150|regex:/^[a-zA-Z]+$/', // Regex for ASCII letters
        ];
    }

    /**
     * Validate request
     *
     * @return Illuminate\Foundation\Http\FormRequest::getValidatorInstance
     */
    protected function getValidatorInstance()
    {
        $this->sanitizeInput();

        return parent::getValidatorInstance();
    }
}
