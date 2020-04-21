<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaseRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'rentable_id' => 'required|integer',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }

    /**
     * Validate request
     * @return
     */
    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function () {
            if ($this->input('start_time') > $this->input('end_time')) {
                $this->validator->errors()->add('end_time', 'End Time cannot be before Start Time!');
            }
        });
    }
}
