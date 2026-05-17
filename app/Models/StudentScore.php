<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentScore extends Model
{
    protected $fillable = [
        'student_id',
        'question_set_id',
        'score',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function questionSet()
    {
        return $this->belongsTo(QuestionSet::class);
    }
}
