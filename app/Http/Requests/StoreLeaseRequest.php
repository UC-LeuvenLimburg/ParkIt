<?php

namespace App\Http\Requests;

use App\Models\Rentable;
use Illuminate\Foundation\Http\FormRequest;

class StoreLeaseRequest extends FormRequest
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
            'rentable_id' => 'required|integer|exists:App\Models\Rentable,id',
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
            // Check if start_time is before end_time
            if ($this->input('start_time') >= $this->input('end_time')) {
                $this->validator->errors()->add('end_time', 'End Time cannot be before Start Time!');
            }

            // Check if minimum rented time is greater then 30 minutes
            if ($this->timeDiffInMinutes($this->input('start_time'), $this->input('end_time')) < 30) {
                $this->validator->errors()->add('end_time', 'At least 30 minutes have to be rented!');
            }
        });
    }

    protected function timeDiffInMinutes($firstTime, $lastTime)
    {
        // convert to unix timestamps
        $firstTime = strtotime($firstTime);
        $lastTime = strtotime($lastTime);

        // perform subtraction to get the difference (in seconds) between times
        $timeDiff = ($lastTime - $firstTime) / 60;

        // return the difference
        return $timeDiff;
    }
}
