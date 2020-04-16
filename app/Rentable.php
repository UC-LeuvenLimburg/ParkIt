<?php

namespace App;

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
          'postal_code', 'address','date_of_hire', 'start_time_rp','end_time_rp','price/h','bankaccount_nr','description'
    ];

    /**
    * Get the user that owns the place
    */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    /**
     * Get the lease for the place.
     */
    public function lease()
    {
        return $this->hasMany('App\Lease');
    }

}
