<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'priority',
        'is_completed'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'is_completed' => 'boolean'
    ];
}
