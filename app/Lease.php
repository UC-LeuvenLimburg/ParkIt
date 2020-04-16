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
        'startTime', 'endTime',
    ];
}
