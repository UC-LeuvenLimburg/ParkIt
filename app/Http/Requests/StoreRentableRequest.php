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
            'user_id' => 'required|integer|exists:App\Models\User,id',
            'postal_code' => 'required|digits:4|min:0001',
            'adress' => 'required|string|min:2',
            'date_of_hire' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'price' => 'required|numeric',
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
