<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string|min:8|max:128',
            'role' => 'required|string|min:1|max:150|regex:/^[a-zA-Z]+$/', // Regex for ASCII letters
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

        return parent::getValidatorInstance()->after(function () {
            // Check if password and confirm password match
            if ($this->input('password') != $this->input('confirm_password')) {
                $this->validator->errors()->add('password', 'Your confirmed password does not match your password');
            }
        });
    }
}
