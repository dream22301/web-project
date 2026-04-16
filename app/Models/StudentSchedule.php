<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    protected $fillable = [
        'day',
        'subject',
        'room',
        'class_major',
        'period_start',
        'period_end',
    ];
}
