<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    // Disable timestamps
    public $timestamps = false;

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
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the rentable record associated with this lease.
     */
    public function rentable()
    {
        return $this->belongsTo('App\Rentable', 'rentable_id');
    }
}
