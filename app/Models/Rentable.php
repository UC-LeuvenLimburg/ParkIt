<?php

namespace App\Models;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rentable extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['leases'];

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'postal_code', 'adress', 'date_of_hire', 'start_time', 'end_time', 'price', 'bankaccount_nr', 'description'
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
