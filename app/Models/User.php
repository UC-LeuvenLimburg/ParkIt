<?php

namespace App\Models;

use App\Filters\UserFilter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;

class User extends Authenticatable
{
    use SoftDeletes, CascadeSoftDeletes, Filterable, UserFilter, EloquentJoin;

    protected $cascadeDeletes = ['rentables', 'leases'];

    use Notifiable;

    /**
     * The attribute that masks our joined tables
     *
     * @var bool
     */
    protected $useTableAlias = True;

    /**
     * The attributes that can be filterd
     *
     * @var array
     */
    protected static $whiteListFilter = [
        'name', 'email', 'role',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relation with Rentables
    public function rentables()
    {
        return $this->hasMany('App\Models\Rentable');
    }

    //Relation with Leases
    public function leases()
    {
        return $this->hasMany('App\Models\Lease');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
