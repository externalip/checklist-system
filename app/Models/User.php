<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use LogsActivity;

    //only grab the changes
    protected static $logOnlyDirty = true;

    //log all except the password
    protected static $ignoreChangedAttributes = ['password'];

    /**
     * Get activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults('User')
            ->logOnly(['role_id', 'username', 'active'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logFillable()
            ->logExcept(['password'])
            ->useLogName('User log');
    }

    /**
     * Get event description.
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            return "User $this->id was Created";
        } elseif ($eventName == 'updated') {
            // Check if 'active' attribute changed to false
            if ($this->active === 0) {
                return "User $this->id was deactivated";
            } elseif ($this->active === 1) {
                return "User $this->id was activated";
            }
            return "User $this->id was Updated";
        } elseif ($eventName == 'deleted') {
            return "User $this->id was Deleted";
        }
        return "User $this->id was Created";
    }

    protected $guard_name = 'web';

    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'role_id',
        'username',
        'password',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
