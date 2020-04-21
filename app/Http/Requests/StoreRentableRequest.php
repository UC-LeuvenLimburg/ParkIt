<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentableRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer|min:1|exists:App\Models\User,id',
            'adress' => 'required|string|min:3|max:255',
            'postal_code' => 'required|numeric|digits:4|min:1|max:9999',
            'date_of_hire' => 'required|date_format:Y-m-d',
            'start_time' => 'required',
            'end_time' => 'required',
            'price' => 'required|numeric|min:0.01|max:1000',
            'bankaccount_nr' => 'required',
            'description' => 'required',
        ];
    }

    /**
     * Validate request
     * @return Illuminate\Foundation\Http\FormRequest::getValidatorInstance
     */
    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function () {
            // todo custom validation for rentable
        });
    }
}
