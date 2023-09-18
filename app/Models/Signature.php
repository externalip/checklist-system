<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Signature extends Model
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
        return LogOptions::defaults('Signature')
            ->logOnly([
                'user_id',
                'response_id',
                'required_sign_role',
                'status',
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logFillable()
            ->useLogName('Signature log');
    }

    /**
     * Get event description.
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        if ($eventName == 'created') {
            return "Signature $this->id was Created";
        } elseif ($eventName == 'updated') {
            if ($this->status == 'OK') {
                return "Signature $this->id was Approved by $this->required_sign_role";
            } elseif ($this->status == 'Rejected') {
                return "Signature $this->id was Rejected by $this->required_sign_role";
            }

            return "Signature $this->id was Updated";
        } elseif ($eventName == 'deleted') {
            return 'Signature was Deleted';
        }

        return 'Signature was Created';
    }

    protected $fillable = [
        'user_id',
        'response_id',
        'required_sign_role',
        'status',
    ];
}
