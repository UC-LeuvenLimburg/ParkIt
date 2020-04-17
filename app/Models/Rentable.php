<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rentable extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'postal_code', 'address', 'date_of_hire', 'start_time_rp', 'end_time_rp', 'price/h', 'bankaccount_nr', 'description'
    ];

    /**
     * Get the user that owns the place
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    /**
     * Get the lease for the place.
     */
    public function leases()
    {
        return $this->hasMany('App\Models\Lease');
    }
}
