<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['model_name'];
    public function tags()
    {
        return $this->hasMany(Tags::class, 'model_id', 'model_id');
    }
}
