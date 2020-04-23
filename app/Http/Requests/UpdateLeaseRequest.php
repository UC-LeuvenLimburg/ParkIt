<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaseRequest extends FormRequest
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
            'rentable_id' => 'required|integer|min:1|exists:App\Models\Rentable,id',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
    }

    /**
     * Validate request
     *
     * @return Illuminate\Foundation\Http\FormRequest::getValidatorInstance
     */
    protected function getValidatorInstance()
    {
        return parent::getValidatorInstance()->after(function () {
            // Get the asociated rentable
            $rentable = $this->rentableRepo->getRentable($this->input('rentable_id'));
            // convert to unix timestamps
            $start_time = $this->input('start_time');
            $end_time = $this->input('end_time');
            $lease_start_time = strtotime($start_time);
            $lease_end_time = strtotime($end_time);
            $rentable_start_time = strtotime($rentable->start_time);
            $rentable_end_time = strtotime($rentable->end_time);

            // Check if start_time is before end_time
            if ($lease_start_time >= $lease_end_time) {
                $this->validator->errors()->add('end_time', 'End time cannot be before start time');
            }

            // Check if minimum rented time is greater then 30 minutes
            if ($this->timeDiffInMinutes($lease_start_time, $lease_end_time) < 30) {
                $this->validator->errors()->add('rented_time', 'At least 30 minutes have to be rented');
            }

            // Check if lease time is available on rentable

            // Check if start_time lease is before start_time rentable
            if ($lease_start_time < $rentable_start_time) {
                $this->validator->errors()->add('available_time', 'Your current start time is before the available start time');
            }

            // Check if end_time lease is after end_time rentable
            if ($lease_end_time > $rentable_end_time) {
                $this->validator->errors()->add('available_time', 'Your current end time is after the available end time');
            }

            // Get the leases on same rentable with overlapping time
            $overLappingLeases = $rentable->leases()
                ->where([
                    ['rentable_id', '=', $this->input('rentable_id')],
                    [function ($query) use ($start_time, $end_time) {
                        $query->where([
                            ['start_time', '<', $end_time],
                            ['end_time', '>', $start_time],
                        ]);
                    }],
                ])->get();
            if (count($overLappingLeases) > 0) {
                $this->validator->errors()->add('available_time', 'Your current selected time is no longer available');
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
