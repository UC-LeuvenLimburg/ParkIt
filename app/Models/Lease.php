<?php

namespace App\Models;

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
        'user_id', 'rentable_id', 'start_time', 'end_time',
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
}
