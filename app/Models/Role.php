<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as SpatieRole;
class Role extends SpatieRole
{
    use HasFactory, LogsActivity;

    /**
     * Get activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults('Role')
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logFillable()
            ->useLogName('Role log');
    }

    /**
     * Get event description.
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            return "Role $this->id was Created";
        } elseif ($eventName == 'updated') {
            return "Role $this->id was Updated";
        } elseif ($eventName == 'deleted') {
            return "Role $this->id was Deleted";
        }

        return "Role $this->id was Created";
    }

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'guard_name',
    ];
}
