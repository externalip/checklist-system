<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Models extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $fillable = ['model_name'];

    public function tags()
    {
        return $this->hasMany(Tags::class, 'model_id', 'model_id');
    }
}
