<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionSet extends Model
{
    protected $fillable = ['user_id', 'title', 'key_code'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
