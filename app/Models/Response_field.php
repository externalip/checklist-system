<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Response_field extends User
{
    use HasFactory;

    protected $table = 'response_fields';
    use LogsActivity;

    //only grab the changes
    protected static $logOnlyDirty = true;

    /**
     * Get activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults('Response')
            ->logOnly([
                'response_id',
                'field_id',
                'response',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logFillable()
            ->useLogName('Response log');
    }

    /**
     * Get event description.
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            return "Response was Created";
        } elseif ($eventName == 'updated') {
            return "Response was Updated";
        } elseif ($eventName == 'deleted') {
            return "Response was Deleted";
        }
        return "Response was Created";
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'response_no',
        'form_id',
        'submitted_by',
        'response',
        'status',
    ];
}
