<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;

class Employee extends User implements Auditable
{
    use HasRoles;
    use \OwenIt\Auditing\Auditable;
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
