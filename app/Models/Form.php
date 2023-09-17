<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Form extends User
{
    use HasFactory;
    //only grab the changes
    protected static $logOnlyDirty = true;

    /**
     * Get activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults('Form')
            ->logOnly([
                'created_by',
                'form_name',
                'completed',
                'form_data',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logFillable()
            ->useLogName('Form Log');
    }

    /**
     * Get event description.
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            return "Form $this->id was Created ";
        } elseif ($eventName == 'updated') {
            return "Form $this->id was Updated ";
        } elseif ($eventName == 'deleted') {
            return "Form $this->id was Deleted ";
        }

        return "Form $this->id was Created";
    }

    protected $fillable = [
        'created_by',
        'form_name',
        'completed',
        'form_data',
    ];
}
