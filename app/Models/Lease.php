<?php

namespace App\Models;

use App\Filters\LeaseFilter;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lease extends Model
{
    use SoftDeletes, Filterable, LeaseFilter;

    /**
     * The attributes that can be filterd
     *
     * @var array
     */
    protected static $whiteListFilter = [
        'start_time', 'end_time', 'phone_nr', 'license_plate'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'rentable_id', 'start_time', 'end_time', 'phone_nr', 'license_plate', 'payed_at'
    ];

    /**
     * Get the user record associated with this lease.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Get the rentable record associated with this lease.
     */
    public function rentable()
    {
        return $this->belongsTo('App\Models\Rentable', 'rentable_id');
    }

    /**
     * Calculate the total rent time in minutes
     */
    public function rentTimeInMinutes()
    {
        //change the format to timestamps
        $start_time = strtotime($this->start_time);
        $end_time = strtotime($this->end_time);
        // perform subtraction to get the difference (in seconds) between times
        $rentTime = ($end_time - $start_time) / 60;
        // return the difference
        return $rentTime;
    }

    /**
     * Calculate the total price
     */
    public function totalPrice()
    {
        //change the format to timestamps
        $start_time = strtotime($this->start_time);
        $end_time = strtotime($this->end_time);
        // perform subtraction to get the difference (in seconds) between times
        $rentTime = ($end_time - $start_time) / 60;
        // administrative fee
        $totalTax = 0.50;
        //get the time in hours
        $totalTimeInHours = $rentTime / 60;
        //calculate the price
        $totalPrice = ($totalTimeInHours * $this->rentable->price) + $totalTax;
        //return the price
        return $totalPrice;
    }
}
