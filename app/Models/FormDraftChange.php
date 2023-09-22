<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDraftChange extends Model
{
    use HasFactory;
    protected $table = 'form_draft_changes';

    protected $fillable = [
        'form_id',
        'form_data',
        'form_name',
    ];
}
