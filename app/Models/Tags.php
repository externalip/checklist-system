<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Tags extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'model_id',
    ];

    public function model()
    {
        return $this->belongsTo(Model::class, 'model_id');
    }

    public function form()
    {
        return $this->belongsTo(Form::class, 'form_id');
    }
}
