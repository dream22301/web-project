<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'subject',
        'class',
        'day',
        'start_time',
        'end_time',
    ];
}
