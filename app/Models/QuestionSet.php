<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSet extends Model
{
    use HasFactory;

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
