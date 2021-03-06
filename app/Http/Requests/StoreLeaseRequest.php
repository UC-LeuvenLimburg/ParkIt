<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Interfaces\IRentableRepository;

class StoreLeaseRequest extends FormRequest
{
    protected $rentableRepo;

    public function __construct(IRentableRepository $rentableRepo)
    {
        $this->rentableRepo = $rentableRepo;
    }

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
            'phone_nr' => 'required|string|min:8|max:12|regex:/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/', // Regex for phone number
            'license_plate' => 'required|string|min:1|max:9|regex:/^[a-zA-Z0-9_.-]*$/' // Regex for license plate
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

            // Check if we are not trying to rent our own property
            if ($this->input('user_id') == $rentable->user_id) {
                $this->validator->errors()->add('rented_time', 'You cannot rent your own property');
            }

            // Check if lease time is available on rentable:

            // Check if start_time lease is before start_time rentable
            if ($lease_start_time < $rentable_start_time) {
                $this->validator->errors()->add('available_time', 'Your current start time is before the available start time: ' . $rentable->start_time);
            }

            // Check if end_time lease is after end_time rentable
            if ($lease_end_time > $rentable_end_time) {
                $this->validator->errors()->add('available_time', 'Your current end time is after the available end time: ' . $rentable->end_time);
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

            // Check if there are leases on the same rentable with overlapping time
            if (count($overLappingLeases) > 0) {
                $errorMessage = 'Your current selected time is no longer available, please selsect a time outside of ';
                foreach ($overLappingLeases as $overLappingLease) {
                    $errorMessage .= '(' . $overLappingLease->start_time . ' -> ' . $overLappingLease->end_time . ') ';
                }
                $this->validator->errors()->add('available_time', $errorMessage);
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
