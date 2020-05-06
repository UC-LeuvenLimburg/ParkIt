<?php

namespace App\Models;

use App\Filters\RentableFilter;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rentable extends Model
{
    use SoftDeletes, CascadeSoftDeletes, Filterable, RentableFilter;

    protected $cascadeDeletes = ['leases'];

    public $timestamps = false;

    /**
     * The attributes that can be filterd
     *
     * @var array
     */
    protected static $whiteListFilter = [
        'adress', 'postal_code', 'date_of_hire', 'start_time', 'end_time', 'price', 'bankaccount_nr', 'description'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'adress', 'postal_code', 'lat', 'long', 'date_of_hire', 'start_time', 'end_time', 'price', 'bankaccount_nr', 'description'
    ];

    /**
     * Get the user that owns the place
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    /**
     * Get the lease for the place.
     */
    public function leases()
    {
        return $this->hasMany('App\Models\Lease');
    }
}
