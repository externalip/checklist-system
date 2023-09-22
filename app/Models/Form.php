<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Form extends Model
{
    use HasFactory;
    use LogsActivity;
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
