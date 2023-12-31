<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Models extends Model
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
        return LogOptions::defaults('Models')
            ->logOnly(['model_name'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logFillable()
            ->useLogName('Models log');
    }

    /**
     * Get event description.
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            return 'Models was Created';
        } elseif ($eventName == 'updated') {
            return 'Models was Updated';
        } elseif ($eventName == 'deleted') {
            return 'Models was Deleted';
        }

        return 'Models was Created';
    }

    public $timestamps = false;

    protected $fillable = ['model_name'];

    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }
}
