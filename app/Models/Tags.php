<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable  = [
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
