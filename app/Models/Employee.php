<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Employee extends User
{
    use HasRoles;
    use LogsActivity;
    //

    /**
     * Get activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults('Employee')
            ->logOnly(['first_name', 'last_name', 'contact', 'shift', 'gender'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logFillable()
            ->useLogName('Employee log');
    }


    // Only grab the changes
    protected static $logOnlyDirty = true;

    /**
     * Get event description.
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            return "Employee $this->id was Created";
        } elseif ($eventName == 'updated') {
            return "Employee  $this->id was Updated";
        } elseif ($eventName == 'deleted') {
            return "Employee  $this->id was Deleted";
        }
        return "Employee  $this->id was Created";
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard_name = 'web';

    protected $fillable = [
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
