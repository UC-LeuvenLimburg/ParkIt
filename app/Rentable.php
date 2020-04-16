<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rentable extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rent_place_id', 'owner_id', 'postal_code', 'address','date_of_hire', 'start_time_rp','end_time_rp','price/h','bankaccount_nr','description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'bankaccount_nr',
    ];


}