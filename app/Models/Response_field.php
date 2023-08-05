<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response_field extends Model
{
    use HasFactory;
    protected $table = 'response_fields';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'response_id',
        'field_id',
        'response',
    ];
}
