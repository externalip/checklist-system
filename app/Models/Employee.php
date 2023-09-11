<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends User
{

    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard_name = 'web';
    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'contact',
        'shift',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
