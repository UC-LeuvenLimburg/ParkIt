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
        $todayDate = date('Y-m-d');

        return [
            'user_id' => 'required|integer|min:1|exists:App\Models\User,id',
            'adress' => 'required|string|min:3|max:150',
            'postal_code' => 'required|numeric|digits:4|min:1|max:9999',
            'date_of_hire' => 'required|date_format:Y-m-d|after_or_equal:' . $todayDate,
            'start_time' => 'required',
            'end_time' => 'required',
            'price' => 'required|numeric|min:0.01|max:1000',
            'bankaccount_nr' => 'required|string|regex:/^[A-Z]{2}(?:[ ]?[0-9]){14,20}$/', // Regex for IBAN numbers
            'description' => 'required|string|max:150',
        ];
    }

    /**
     * Validate request
     * @return Illuminate\Foundation\Http\FormRequest::getValidatorInstance
     */
    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function () {
            // convert to unix timestamps
            $start_time = $this->input('start_time');
            $end_time = $this->input('end_time');
            $rentable_start_time = strtotime($start_time);
            $rentable_end_time = strtotime($end_time);

            // Check if start_time is before end_time
            if ($rentable_start_time >= $rentable_end_time) {
                $this->validator->errors()->add('end_time', 'End time cannot be before start time');
            }

            // Check if minimum rented time is greater then 30 minutes
            if ($this->timeDiffInMinutes($rentable_start_time, $rentable_end_time) < 30) {
                $this->validator->errors()->add('rented_time', 'At least 30 minutes have to be available for rent');
            }
        });
    }

    /**
     * Calculates the time difference between two unix timestamps in minutes
     *
     * @param $firstTime
     * @param $lastTime
     */
    protected function timeDiffInMinutes($firstTime, $lastTime)
    {
        // perform subtraction to get the difference (in seconds) between times
        $timeDiff = ($lastTime - $firstTime) / 60;

        // return the difference
        return $timeDiff;
    }
}
