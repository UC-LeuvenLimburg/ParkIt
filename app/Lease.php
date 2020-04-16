<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time', 'end_time',
    ];

    /**
     * Get the user record associated with this lease.
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * Get the rentable record associated with this lease.
     */
    public function rentable()
    {
        return $this->hasOne('App\Rentable');
    }
}
