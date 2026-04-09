<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    protected $fillable = [
        'day',
        'subject',
        'room',
        'period_start',
        'period_end',
    ];
}
