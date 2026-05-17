<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'day',
        'subject',
        'room',
        'class_major',
        'period_start',
        'period_end',
    ];

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
